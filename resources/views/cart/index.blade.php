<x-app-layout>
    <x-slot name="header">
        <h2>Корзина</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            @if(session('success'))
                <div class="shop-alert shop-alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="shop-alert shop-alert-danger">{{ session('error') }}</div>
            @endif

            @if(!empty($cart))
                <section class="shop-card shop-card-pad">
                    <h1 class="shop-section-title">Товары в корзине</h1>

                    <div class="shop-table-wrap">
                        <table class="shop-table">
                            <thead>
                                <tr>
                                    <th>Товар</th>
                                    <th>Цена</th>
                                    <th>Количество</th>
                                    <th>Сумма</th>
                                    <th>Действие</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cart as $item)
                                    <tr>
                                        <td><strong>{{ $item['name'] }}</strong></td>
                                        <td>{{ number_format($item['price'], 2, ',', ' ') }} ₽</td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td><strong>{{ number_format($item['price'] * $item['quantity'], 2, ',', ' ') }} ₽</strong></td>
                                        <td>
                                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="shop-btn shop-btn-danger">
                                                    Удалить
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="shop-total">
                        <div>
                            <div class="shop-info-label">Итоговая сумма</div>
                            <strong>{{ number_format($total, 2, ',', ' ') }} ₽</strong>
                        </div>

                        @auth
                            <a href="{{ route('checkout') }}" class="shop-btn shop-btn-orange">
                                Оформить заказ
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="shop-btn shop-btn-primary">
                                Войти для оформления
                            </a>
                        @endauth
                    </div>
                </section>
            @else
                <section class="shop-card shop-empty">
                    <h1>Корзина пуста</h1>
                    <p class="shop-muted">Добавьте товары из каталога, чтобы оформить заказ.</p>
                    <a href="{{ route('home') }}" class="shop-btn shop-btn-primary">Перейти в каталог</a>
                </section>
            @endif
        </div>
    </div>
</x-app-layout>
