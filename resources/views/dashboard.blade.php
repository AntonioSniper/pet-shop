<x-app-layout>
    <x-slot name="header">
        <h2>Профиль</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            <section class="shop-hero">
                <h1>Профиль покупателя</h1>
                <p class="shop-lead">Здесь собраны основные действия: перейти в каталог, проверить корзину, посмотреть заказы или изменить данные профиля.</p>
            </section>

            <section class="shop-section shop-admin-grid">
                <article class="shop-card shop-admin-card">
                    <h3>Каталог</h3>
                    <p>Выберите товары для питомца и добавьте их в корзину.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('home') }}" class="shop-btn shop-btn-primary">Перейти</a>
                </article>

                <article class="shop-card shop-admin-card">
                    <h3>Корзина</h3>
                    <p>Проверьте выбранные товары и итоговую сумму заказа.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('cart.index') }}" class="shop-btn shop-btn-orange">Открыть корзину</a>
                </article>

                <article class="shop-card shop-admin-card">
                    <h3>Мои заказы</h3>
                    <p>Следите за статусами оформленных заказов.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('orders.index') }}" class="shop-btn shop-btn-primary">Посмотреть</a>
                </article>

                <article class="shop-card shop-admin-card">
                    <h3>Профиль</h3>
                    <p>Обновите имя, email или пароль аккаунта.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('profile.edit') }}" class="shop-btn shop-btn-secondary">Редактировать</a>
                </article>

                @if(auth()->user()->role === 'admin')
                    <article class="shop-card shop-admin-card">
                        <h3>Админка</h3>
                        <p>Управляйте товарами, категориями и заказами магазина.</p>
                        <div class="shop-spacer"></div>
                        <a href="{{ route('admin.dashboard') }}" class="shop-btn shop-btn-primary">Перейти</a>
                    </article>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
