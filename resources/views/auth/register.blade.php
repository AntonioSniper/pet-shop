<x-guest-layout>
    <div class="shop-auth-head">
        <h1>Регистрация</h1>
        <p>Создайте аккаунт, чтобы быстрее оформлять заказы и отслеживать доставку.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="shop-form">
        @csrf

        <div>
            <x-input-label for="name" value="Имя" />
            <x-text-input id="name" class="shop-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2 shop-error" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" class="shop-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2 shop-error" />
        </div>

        <div>
            <x-input-label for="password" value="Пароль" />
            <x-text-input id="password" class="shop-input" type="password" name="password" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2 shop-error" />
        </div>

        <div>
            <x-input-label for="password_confirmation" value="Подтвердите пароль" />
            <x-text-input id="password_confirmation" class="shop-input" type="password" name="password_confirmation" required autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 shop-error" />
        </div>

        <button type="submit" class="shop-btn shop-btn-primary shop-btn-block">Зарегистрироваться</button>

        <div class="shop-auth-links">
            <span class="shop-muted">Уже есть аккаунт?</span>
            <a href="{{ route('login') }}" class="shop-inline-link">Войти</a>
        </div>
    </form>
</x-guest-layout>
