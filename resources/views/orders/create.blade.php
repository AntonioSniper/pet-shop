<x-app-layout>
    <x-slot name="header">
        <h2 style="font-size:22px; font-weight:700; color:#111827;">
            Оформление заказа
        </h2>
    </x-slot>

    <div style="padding:32px 0;">
        <div style="max-width:800px; margin:0 auto; padding:0 24px;">
            <div style="background:white; border-radius:16px; padding:28px; box-shadow:0 8px 24px rgba(0,0,0,0.08);">

                <h3 style="font-size:20px; font-weight:700; margin-bottom:20px;">Ваш заказ</h3>

                @if(session('error'))
                    <div class="shop-alert shop-alert-danger">{{ session('error') }}</div>
                @endif

                @if($errors->any())
                    <div class="shop-alert shop-alert-danger">
                        @foreach($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                @foreach($cart as $item)
                    <div style="display:flex; justify-content:space-between; border-bottom:1px solid #e5e7eb; padding:10px 0;">
                        <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                        <span>{{ $item['price'] * $item['quantity'] }} ₽</span>
                    </div>
                @endforeach

                <p style="font-size:20px; font-weight:700; margin:22px 0;">
                    Итого: {{ $total }} ₽
                </p>

                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf

                    <label>Адрес доставки</label>
                    <input type="text" name="delivery_address" value="{{ old('delivery_address') }}" style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                    <label>Телефон</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" style="width:100%; margin:6px 0 14px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">

                    <label>Комментарий</label>
                    <textarea name="comment" rows="4" style="width:100%; margin:6px 0 18px; padding:10px; border:1px solid #d1d5db; border-radius:8px;">{{ old('comment') }}</textarea>

                    <button type="submit" style="background:#16a34a; color:white; padding:10px 16px; border:none; border-radius:8px; cursor:pointer; font-weight:600;">
                        Подтвердить заказ
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
