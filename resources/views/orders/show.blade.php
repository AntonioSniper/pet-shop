<x-app-layout>
    <x-slot name="header">
        <h2>Мои заказы</h2>
    </x-slot>

    @php
        $statuses = [
            'new' => ['Новый', ''],
            'processing' => ['В обработке', 'shop-badge-warning'],
            'sent' => ['Отправлен', ''],
            'delivered' => ['Доставлен', 'shop-badge-success'],
            'cancelled' => ['Отменен', 'shop-badge-danger'],
        ];

        $status = $statuses[$order->status] ?? [$order->status, 'shop-badge-muted'];
    @endphp

    <div class="shop-page">
        <div class="shop-container">
            <section class="shop-card shop-card-pad">
                <div class="shop-order-head">
                    <div>
                        <h1 class="shop-order-title">Заказ №{{ $order->id }}</h1>
                        <p class="shop-muted">Дата оформления: {{ $order->created_at->format('d.m.Y H:i') }}</p>
                    </div>
                    <span class="shop-badge {{ $status[1] }}">{{ $status[0] }}</span>
                </div>

                <div class="shop-info-grid">
                    <div class="shop-info-cell">
                        <div class="shop-info-label">Адрес доставки</div>
                        <div class="shop-info-value">{{ $order->delivery_address }}</div>
                    </div>
                    <div class="shop-info-cell">
                        <div class="shop-info-label">Телефон</div>
                        <div class="shop-info-value">{{ $order->phone }}</div>
                    </div>
                    <div class="shop-info-cell">
                        <div class="shop-info-label">Комментарий</div>
                        <div class="shop-info-value">{{ $order->comment ?: 'Без комментария' }}</div>
                    </div>
                </div>

                <h2 class="shop-section-title">Состав заказа</h2>

                <div class="shop-table-wrap">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <th>Товар</th>
                                <th>Цена</th>
                                <th>Количество</th>
                                <th>Сумма</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td><strong>{{ $item->product->name ?? 'Товар удален' }}</strong></td>
                                    <td>{{ number_format($item->price, 2, ',', ' ') }} ₽</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>{{ number_format($item->subtotal, 2, ',', ' ') }} ₽</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="shop-total">
                    <div>
                        <div class="shop-info-label">Итого к оплате</div>
                        <strong>{{ number_format($order->total_amount, 2, ',', ' ') }} ₽</strong>
                    </div>
                    <a href="{{ route('orders.index') }}" class="shop-btn shop-btn-secondary">Назад к заказам</a>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
