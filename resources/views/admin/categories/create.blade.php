<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Добавить категорию') }}
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

                <form action="{{ route('admin.categories.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label class="block mb-1 font-medium">Название категории</label>
                        <input type="text" name="name" class="w-full border rounded p-2" value="{{ old('name') }}">
                    </div>

                    <div>
                        <label class="block mb-1 font-medium">Описание</label>
                        <textarea name="description" class="w-full border rounded p-2" rows="4">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-3">
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
                            Сохранить
                        </button>

                        <a href="{{ route('admin.categories.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded">
                            Назад
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>