<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function create()
    {
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Корзина пуста');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('orders.create', compact('cart', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'delivery_address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'comment' => ['nullable', 'string'],
        ]);

        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('success', 'Корзина пуста');
        }

        return DB::transaction(function () use ($request, $cart) {
            $productIds = array_map('intval', array_column($cart, 'id'));
            $products = Product::whereIn('id', $productIds)
                ->lockForUpdate()
                ->get()
                ->keyBy('id');

            $total = 0;

            foreach ($cart as $item) {
                $product = $products->get((int) $item['id']);
                $quantity = (int) $item['quantity'];

                if (! $product || ! $product->is_active) {
                    return redirect()->route('cart.index')->with('error', 'Товар из корзины больше недоступен.');
                }

                if ($quantity < 1) {
                    return redirect()->route('cart.index')->with('error', 'Некорректное количество товара в корзине.');
                }

                if ($product->stock < $quantity) {
                    return redirect()
                        ->route('cart.index')
                        ->with('error', "Недостаточно товара \"{$product->name}\" на складе. Доступно: {$product->stock}.");
                }

                $total += $product->price * $quantity;
            }

            $order = Order::create([
                'user_id' => auth()->id(),
                'total_amount' => $total,
                'status' => 'new',
                'delivery_address' => $request->delivery_address,
                'phone' => $request->phone,
                'comment' => $request->comment,
            ]);

            foreach ($cart as $item) {
                $product = $products->get((int) $item['id']);
                $quantity = (int) $item['quantity'];
                $price = $product->price;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $price,
                    'subtotal' => $price * $quantity,
                ]);

                $product->decrement('stock', $quantity);
            }

            session()->forget('cart');

            return redirect()->route('orders.index')->with('success', 'Заказ успешно оформлен');
        });
    }

    public function index()
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->get();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id() && auth()->user()->role !== 'admin') {
            abort(403);
        }

        $order->load('items.product', 'user');

        return view('orders.show', compact('order'));
    }
}
