<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px; font-weight:700; color:#111827;">
            Редактировать товар
        </h2>
    </x-slot>

    <div style="padding:30px;">
        <div style="max-width:800px; background:white; padding:28px; border-radius:16px; box-shadow:0 8px 24px rgba(0,0,0,0.08);">

            @if($errors->any())
                <div style="margin-bottom:16px; padding:14px; background:#fee2e2; color:#991b1b; border-radius:10px;">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.products.update', $product) }}" method="POST">
                @csrf
                @method('PUT')

                <label style="font-weight:600;">Категория</label>
                <select name="category_id" style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>

                <label style="font-weight:600;">Название</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}"
                       style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                <label style="font-weight:600;">Описание</label>
                <textarea name="description" rows="5"
                          style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">{{ old('description', $product->description) }}</textarea>

                <label style="font-weight:600;">Цена</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}"
                       style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                <label style="font-weight:600;">Количество на складе</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}"
                       style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                <label style="font-weight:600;">Изображение</label>
                <input type="text" name="image" value="{{ old('image', $product->image) }}"
                       style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                <div style="margin-bottom:20px;">
                    <label>
                        <input type="checkbox" name="is_active" value="1" {{ $product->is_active ? 'checked' : '' }}>
                        Активный товар
                    </label>
                </div>

                <button type="submit"
                        style="background:#2563eb; color:white; padding:10px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
                    Обновить
                </button>

                <a href="{{ route('admin.products.index') }}"
                   style="background:#6b7280; color:white; padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600; margin-left:10px;">
                    Назад
                </a>
            </form>
        </div>
    </div>
</x-app-layout>