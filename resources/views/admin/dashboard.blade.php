<x-app-layout>
    <x-slot name="header">
        <h2>Админка</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            <section class="shop-hero">
                <h1>Админка</h1>
                <p class="shop-lead">Управляйте каталогом, категориями и заказами интернет-магазина товаров для животных.</p>
            </section>

            <section class="shop-section shop-admin-grid">
                <article class="shop-card shop-admin-card">
                    <h3>Товары</h3>
                    <p>Добавляйте новые позиции, обновляйте цены, остатки и видимость товаров.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('admin.products.index') }}" class="shop-btn shop-btn-primary">Перейти</a>
                </article>

                <article class="shop-card shop-admin-card">
                    <h3>Категории</h3>
                    <p>Настраивайте разделы каталога, чтобы покупателям было проще находить товары.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('admin.categories.index') }}" class="shop-btn shop-btn-primary">Перейти</a>
                </article>

                <article class="shop-card shop-admin-card">
                    <h3>Заказы</h3>
                    <p>Просматривайте заказы клиентов и меняйте статусы обработки.</p>
                    <div class="shop-spacer"></div>
                    <a href="{{ route('admin.orders.index') }}" class="shop-btn shop-btn-orange">Перейти</a>
                </article>
            </section>
        </div>
    </div>
</x-app-layout>
