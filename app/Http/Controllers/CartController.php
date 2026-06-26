<?php

namespace App\Http\Controllers;

use App\Models\Product;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        $total = 0;

        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        return view('cart.index', compact('cart', 'total'));
    }

    public function add(Product $product)
    {
        if (! $product->is_active || $product->stock < 1) {
            return redirect()->back()->with('error', 'Товара нет в наличии.');
        }

        $cart = session()->get('cart', []);
        $currentQuantity = $cart[$product->id]['quantity'] ?? 0;

        if ($currentQuantity >= $product->stock) {
            return redirect()
                ->back()
                ->with('error', "На складе доступно только {$product->stock} шт. товара \"{$product->name}\".");
        }

        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity']++;
            $cart[$product->id]['price'] = $product->price;
        } else {
            $cart[$product->id] = [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Товар удалён из корзины');
    }
}
