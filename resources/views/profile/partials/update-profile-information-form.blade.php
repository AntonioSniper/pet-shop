<section>
    <header>
        <h2 class="shop-section-title">Данные профиля</h2>
        <p class="shop-muted">Имя и email используются для входа и связи по заказам.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="shop-form" style="margin-top:20px;">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" value="Имя" />
            <x-text-input id="name" name="name" type="text" class="shop-input" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 shop-error" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" value="Email" />
            <x-text-input id="email" name="email" type="email" class="shop-input" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2 shop-error" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="shop-alert shop-alert-danger" style="margin-top:14px; margin-bottom:0;">
                    Email пока не подтвержден.
                    <button form="send-verification" class="shop-btn shop-btn-secondary" style="margin-top:10px;">
                        Отправить письмо повторно
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                    <div class="shop-alert shop-alert-success" style="margin-top:14px; margin-bottom:0;">
                        Новая ссылка отправлена на ваш email.
                    </div>
                @endif
            @endif
        </div>

        <div class="shop-actions">
            <button type="submit" class="shop-btn shop-btn-primary">Сохранить профиль</button>

            @if (session('status') === 'profile-updated')
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
