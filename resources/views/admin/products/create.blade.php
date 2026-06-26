<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить товар') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                        <ul class="list-disc pl-5">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1 font-medium">Категория</label>
                        <select name="category_id" class="w-full border rounded p-2">
                            <option value="">Выберите категорию</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Название</label>
                        <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Описание</label>
                        <textarea name="description" class="w-full border rounded p-2" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Цена</label>
                        <input type="number" step="0.01" name="price" class="w-full border rounded p-2" value="{{ old('price') }}">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Количество на складе</label>
                        <input type="number" name="stock" class="w-full border rounded p-2" value="{{ old('stock', 0) }}">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Изображение (ссылка или имя файла)</label>
                        <input type="text" name="image" class="w-full border rounded p-2" value="{{ old('image') }}">
                    </div>

                    <div class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" checked>
                        <label>Активный товар</label>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Сохранить
                        </button>

                        <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>