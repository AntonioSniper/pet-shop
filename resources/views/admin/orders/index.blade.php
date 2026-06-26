<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Заказы
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow rounded p-6">
                <table class="w-full border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border p-2">№</th>
                            <th class="border p-2">Пользователь</th>
                            <th class="border p-2">Email</th>
                            <th class="border p-2">Сумма</th>
                            <th class="border p-2">Статус</th>
                            <th class="border p-2">Дата</th>
                            <th class="border p-2">Действие</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                            <tr>
                                <td class="border p-2">{{ $order->id }}</td>
                                <td class="border p-2">{{ $order->user->name ?? '—' }}</td>
                                <td class="border p-2">{{ $order->user->email ?? '—' }}</td>
                                <td class="border p-2">{{ $order->total_amount }} ₽</td>
                                <td class="border p-2">{{ $order->status }}</td>
                                <td class="border p-2">{{ $order->created_at->format('d.m.Y H:i') }}</td>
                                <td class="border p-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 underline">
                                        Открыть
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="border p-4 text-center">
                                    Заказов пока нет
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>