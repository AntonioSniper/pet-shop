<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px; font-weight:700; color:#111827;">
            Редактировать категорию
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

            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')

                <label style="font-weight:600;">Название категории</label>
                <input type="text" name="name" value="{{ old('name', $category->name) }}"
                       style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                <label style="font-weight:600;">Описание</label>
                <textarea name="description" rows="5"
                          style="width:100%; margin:6px 0 20px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">{{ old('description', $category->description) }}</textarea>

                <button type="submit"
                        style="background:#2563eb; color:white; padding:10px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
                    Обновить
                </button>

                <a href="{{ route('admin.categories.index') }}"
                   style="background:#6b7280; color:white; padding:10px 16px; border-radius:8px; text-decoration:none; font-weight:600; margin-left:10px;">
                    Назад
                </a>
            </form>
        </div>
    </div>
</x-app-layout>