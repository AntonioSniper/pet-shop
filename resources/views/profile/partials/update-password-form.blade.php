<section>
    <header>
        <h2 class="shop-section-title">Пароль</h2>
        <p class="shop-muted">Измените пароль, если хотите обновить доступ к аккаунту.</p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="shop-form" style="margin-top:20px;">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" value="Текущий пароль" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="shop-input" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 shop-error" />
        </div>

        <div>
            <x-input-label for="update_password_password" value="Новый пароль" />
            <x-text-input id="update_password_password" name="password" type="password" class="shop-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 shop-error" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" value="Подтвердите новый пароль" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="shop-input" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 shop-error" />
        </div>

        <div class="shop-actions">
            <button type="submit" class="shop-btn shop-btn-primary">Сохранить пароль</button>

            @if (session('status') === 'password-updated')
                <span
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="shop-badge shop-badge-success"
                >Сохранено</span>
            @endif
        </div>
    </form>
</section>
