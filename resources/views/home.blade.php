<x-app-layout>
    <x-slot name="header">
        <h2>Каталог</h2>
    </x-slot>

    @php
        $search = trim((string) request('search', ''));
        $filteredProducts = $products->filter(function ($product) use ($search) {
            return $search === '' || mb_stripos($product->name, $search) !== false;
        });
    @endphp

    <div class="shop-page">
        <div class="shop-container">
            <section class="shop-hero">
                <h1>Каталог товаров для животных</h1>
                <p class="shop-lead">Выберите товары для питомца и оформите заказ онлайн</p>

                <form method="GET" action="{{ route('home') }}" class="shop-search">
                    @if($activeCategory)
                        <input type="hidden" name="category" value="{{ $activeCategory->slug }}">
                    @endif

                    <label for="search" class="shop-label">Поиск по названию товара</label>
                    <div class="shop-search-row">
                        <input
                            id="search"
                            name="search"
                            value="{{ $search }}"
                            class="shop-input"
                            type="text"
                            placeholder="Например, корм, поводок или игрушка"
                        >
                        <button type="submit" class="shop-btn shop-btn-primary">Найти</button>
                        <a href="{{ route('home') }}" class="shop-btn shop-btn-secondary">Сбросить</a>
                    </div>
                </form>
            </section>

            <section class="shop-section">
                <h2 class="shop-section-title">Категории</h2>
                <div class="shop-category-list">
                    <a href="{{ route('home') }}" class="shop-category-link {{ $activeCategory ? '' : 'is-active' }}">
                        Все товары
                    </a>

                    @forelse($categories as $category)
                        @php($isActive = $activeCategory?->is($category))
                        <a
                            href="{{ route('home', ['category' => $category->slug]) }}"
                            class="shop-category-link {{ $isActive ? 'is-active' : '' }}"
                        >
                            {{ $category->name }} · {{ $category->products_count }}
                        </a>
                    @empty
                        <span class="shop-muted">Категории пока не добавлены.</span>
                    @endforelse
                </div>
            </section>

            <section class="shop-section">
                <h2 class="shop-section-title">Товары</h2>

                <div class="shop-grid">
                    @forelse($filteredProducts as $product)
                        <article class="shop-card shop-product-card">
                            <img
                                src="{{ $product->image ? (\Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://', '/']) ? $product->image : asset('storage/' . $product->image)) : asset('images/dogtoy.jpg') }}"
                                alt="{{ $product->name }}"
                                class="shop-product-image"
                            >

                            <div class="shop-product-body">
                                <h3 class="shop-product-title">{{ $product->name }}</h3>
                                <p class="shop-product-meta">Категория: {{ $product->category->name ?? 'Без категории' }}</p>
                                <p class="shop-product-description">
                                    {{ \Illuminate\Support\Str::limit($product->description ?: 'Описание товара скоро появится.', 115) }}
                                </p>

                                <div class="shop-spacer"></div>

                                <p class="shop-price">{{ number_format($product->price, 2, ',', ' ') }} ₽</p>

                                @if($product->stock > 0)
                                    <span class="shop-badge shop-badge-success">В наличии: {{ $product->stock }}</span>
                                @else
                                    <span class="shop-badge shop-badge-danger">Нет в наличии</span>
                                @endif

                                <div class="shop-actions" style="margin-top:16px;">
                                    <a href="{{ route('products.show', $product) }}" class="shop-btn shop-btn-primary shop-btn-block">
                                        Подробнее
                                    </a>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="shop-card shop-empty">
                            <h3>Товары не найдены</h3>
                            <p class="shop-muted">Попробуйте изменить запрос или сбросить фильтр.</p>
                            <a href="{{ route('home') }}" class="shop-btn shop-btn-primary">Показать весь каталог</a>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
