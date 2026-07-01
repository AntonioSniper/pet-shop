<x-app-layout>
    <x-slot name="header">
        <h2>Каталог</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            @if(session('success'))
                <div class="shop-alert shop-alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="shop-alert shop-alert-danger">{{ session('error') }}</div>
            @endif

            <section class="shop-card shop-detail">
                <div>
                    <img
                        src="{{ $product->image ? (\Illuminate\Support\Str::startsWith($product->image, ['http://', 'https://', '/']) ? $product->image : asset($product->image)) : asset('images/dogtoy.jpg') }}"
                        alt="{{ $product->name }}"
                        class="shop-detail-image"
                    >
                </div>

                <div>
                    <span class="shop-badge">{{ $product->category->name ?? 'Без категории' }}</span>
                    <h1 style="margin:14px 0 10px; font-size:34px; line-height:1.15; font-weight:700;">
                        {{ $product->name }}
                    </h1>

                    <p class="shop-price">{{ number_format($product->price, 2, ',', ' ') }} ₽</p>

                    @if($product->stock > 0)
                        <p><span class="shop-badge shop-badge-success">В наличии: {{ $product->stock }}</span></p>
                    @else
                        <p><span class="shop-badge shop-badge-danger">Нет в наличии</span></p>
                    @endif

                    <h2 class="shop-section-title" style="margin-top:24px;">Описание</h2>
                    <p style="color:#374151; line-height:1.65;">
                        {{ $product->description ?: 'Описание товара скоро появится.' }}
                    </p>

                    <div class="shop-actions" style="margin-top:26px;">
                        <form action="{{ route('cart.add', $product) }}" method="POST">
                            @csrf
                            <button
                                type="submit"
                                class="shop-btn shop-btn-orange"
                                @disabled($product->stock < 1 || ! $product->is_active)
                            >
                                Добавить в корзину
                            </button>
                        </form>

                        <a href="{{ route('home') }}" class="shop-btn shop-btn-secondary">Назад в каталог</a>
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
