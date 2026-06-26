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
                        <h1 class="shop-order-title">Категории</h1>
                        <p class="shop-muted">Разделы каталога, по которым покупатели находят товары.</p>
                    </div>
                    <a href="{{ route('admin.categories.create') }}" class="shop-btn shop-btn-orange">Добавить категорию</a>
                </div>

                <div class="shop-table-wrap">
                    <table class="shop-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Название</th>
                                <th>Slug</th>
                                <th>Описание</th>
                                <th>Действия</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->id }}</td>
                                    <td><strong>{{ $category->name }}</strong></td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->description ?: 'Без описания' }}</td>
                                    <td>
                                        <div class="shop-actions">
                                            <a href="{{ route('admin.categories.edit', $category) }}" class="shop-btn shop-btn-primary">
                                                Редактировать
                                            </a>

                                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                    type="submit"
                                                    class="shop-btn shop-btn-danger"
                                                    onclick="return confirm('Удалить категорию?')"
                                                >
                                                    Удалить
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">Категорий пока нет.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
