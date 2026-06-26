<x-app-layout>
    <x-slot name="header">
        <h2>Мои заказы</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            @if(session('success'))
                <div class="shop-alert shop-alert-success">{{ session('success') }}</div>
            @endif

            <div class="shop-order-grid">
                @forelse($orders as $order)
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

                    <article class="shop-card shop-order-card">
                        <div class="shop-order-head">
                            <div>
                                <h1 class="shop-order-title">Заказ №{{ $order->id }}</h1>
                                <p class="shop-muted">{{ $order->created_at->format('d.m.Y H:i') }}</p>
                            </div>

                            <span class="shop-badge {{ $status[1] }}">{{ $status[0] }}</span>
                        </div>

                        <div class="shop-info-grid">
                            <div class="shop-info-cell">
                                <div class="shop-info-label">Сумма</div>
                                <div class="shop-info-value">{{ number_format($order->total_amount, 2, ',', ' ') }} ₽</div>
                            </div>
                            <div class="shop-info-cell">
                                <div class="shop-info-label">Адрес доставки</div>
                                <div class="shop-info-value">{{ $order->delivery_address }}</div>
                            </div>
                            <div class="shop-info-cell">
                                <div class="shop-info-label">Телефон</div>
                                <div class="shop-info-value">{{ $order->phone }}</div>
                            </div>
                        </div>

                        <a href="{{ route('orders.show', $order) }}" class="shop-btn shop-btn-primary">
                            Подробнее о заказе
                        </a>
                    </article>
                @empty
                    <section class="shop-card shop-empty" style="grid-column:1 / -1;">
                        <h1>Заказов пока нет</h1>
                        <p class="shop-muted">Перейдите в каталог и оформите первый заказ.</p>
                        <a href="{{ route('home') }}" class="shop-btn shop-btn-primary">Перейти в каталог</a>
                    </section>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>
