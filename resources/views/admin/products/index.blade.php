<x-app-layout>
    <x-slot name="header">
        <h2>Админка</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            @if(session('success'))
                <div class="shop-alert shop-alert-success">{{ session('success') }}</div>
            @endif

            <section class="shop-card shop-card-pad">
                <div class="shop-order-head">
                    <div>
                        <h1 class="shop-order-title">Товары</h1>
                        <p class="shop-muted">Список товаров каталога, цены, остатки и статус показа.</p>
                    </div>
                    <a href="{{ route('admin.products.create') }}" class="shop-btn shop-btn-orange">Добавить товар</a>
                </div>

                <div class="shop-table-wrap">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Категория</th>
                                <th>Цена</th>
                                <th>Остаток</th>
                                <th>Статус</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td><strong>{{ $product->name }}</strong></td>
                                    <td>{{ $product->category->name ?? 'Без категории' }}</td>
                                    <td>{{ number_format($product->price, 2, ',', ' ') }} ₽</td>
                                    <td>{{ $product->stock }}</td>
                                    <td>
                                        @if($product->is_active)
                                            <span class="shop-badge shop-badge-success">Активен</span>
                                        @else
                                            <span class="shop-badge shop-badge-muted">Скрыт</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="shop-actions">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="shop-btn shop-btn-primary">
                                                Редактировать
                                            </a>

                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="shop-btn shop-btn-danger"
                                                    onclick="return confirm('Удалить товар?')"
                                                >
                                                    Удалить
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7">Товаров пока нет.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
