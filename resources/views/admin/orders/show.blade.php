<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Заказ №{{ $order->id }}
        </h2>
    </x-slot>

    @php
        $statuses = [
            'new' => 'Новый',
            'processing' => 'В обработке',
            'sent' => 'Отправлен',
            'delivered' => 'Доставлен',
            'cancelled' => 'Отменён',
        ];
    @endphp

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6 mb-6">
                <h3 class="text-lg font-semibold mb-4">Информация о заказе</h3>

                <p class="mb-2"><strong>Пользователь:</strong> {{ $order->user->name ?? '—' }}</p>
                <p class="mb-2"><strong>Email:</strong> {{ $order->user->email ?? '—' }}</p>
                <p class="mb-2"><strong>Адрес доставки:</strong> {{ $order->delivery_address }}</p>
                <p class="mb-2"><strong>Телефон:</strong> {{ $order->phone }}</p>
                <p class="mb-2"><strong>Комментарий:</strong> {{ $order->comment }}</p>
                <p class="mb-2"><strong>Сумма:</strong> {{ $order->total_amount }} ₽</p>

                <p class="mb-4">
                    <strong>Текущий статус:</strong>
                    {{ $statuses[$order->status] ?? $order->status }}
                </p>

                <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="flex gap-3 items-center flex-wrap">
                    @csrf
                    @method('PUT')

                    <label for="status" class="font-medium">Изменить статус:</label>

                    <select name="status" id="status" class="border rounded p-2">
                        @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>

                    <button type="submit"
                            style="background:#2563eb; color:#ffffff; padding:10px 16px; border:none; border-radius:10px; cursor:pointer; font-weight:700;">
                        Сохранить статус
                    </button>
                </form>
            </div>

            <div class="bg-white shadow rounded p-6">
                <h3 class="text-lg font-semibold mb-4">Состав заказа</h3>

                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">Товар</th>
                            <th class="border p-2">Цена</th>
                            <th class="border p-2">Количество</th>
                            <th class="border p-2">Сумма</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td class="border p-2">{{ $item->product->name ?? 'Товар удалён' }}</td>
                                <td class="border p-2">{{ $item->price }} ₽</td>
                                <td class="border p-2">{{ $item->quantity }}</td>
                                <td class="border p-2">{{ $item->subtotal }} ₽</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</x-app-layout>
