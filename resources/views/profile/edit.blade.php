<x-app-layout>
    <x-slot name="header">
        <h2>Профиль</h2>
    </x-slot>

    <div class="shop-page">
        <div class="shop-container">
            <section class="shop-hero">
                <h1>Профиль</h1>
                <p class="shop-lead">Обновите контактные данные, пароль и настройки аккаунта.</p>
            </section>

            <div class="shop-section" style="display:grid; gap:20px;">
                <section class="shop-card shop-card-pad">
                    @include('profile.partials.update-profile-information-form')
                </section>

                <section class="shop-card shop-card-pad">
                    @include('profile.partials.update-password-form')
                </section>

                <section class="shop-card shop-card-pad">
                    @include('profile.partials.delete-user-form')
                </section>
            </div>
        </div>
    </div>
</x-app-layout>
