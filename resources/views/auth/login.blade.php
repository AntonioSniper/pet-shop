<x-guest-layout>
    <div class="shop-auth-head">
        <h1>Войти</h1>
        <p>Введите email и пароль, чтобы перейти к заказам и оформлению покупок.</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="shop-form">
        @csrf

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="shop-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 shop-error" />
        </div>

        <div>
            <x-input-label for="password" value="Пароль" />
            <x-text-input id="password" class="shop-input" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 shop-error" />
        </div>

        <div class="shop-checkbox">
            <input id="remember_me" type="checkbox" name="remember">
            <label for="remember_me">Запомнить меня</label>
        </div>

        <button type="submit" class="shop-btn shop-btn-primary shop-btn-block">Войти</button>

        <div class="shop-auth-links">
            @if (Route::has('password.request'))
                <a class="shop-inline-link" href="{{ route('password.request') }}">Забыли пароль?</a>
            @endif

            <a href="{{ route('register') }}" class="shop-inline-link">Создать аккаунт</a>
        </div>
    </form>
</x-guest-layout>
