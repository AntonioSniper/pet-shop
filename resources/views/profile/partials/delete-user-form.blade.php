<section>
    <header>
        <h2 class="shop-section-title">Удаление аккаунта</h2>
        <p class="shop-muted">Это действие удалит аккаунт и связанные с ним данные.</p>
    </header>

    <button
        type="button"
        class="shop-btn shop-btn-danger"
        style="margin-top:18px;"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Удалить аккаунт
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="shop-form" style="padding:24px;">
            @csrf
            @method('delete')

            <div>
                <h2 class="shop-section-title">Удалить аккаунт?</h2>
                <p class="shop-muted">Введите пароль, чтобы подтвердить удаление аккаунта.</p>
            </div>

            <div>
                <x-input-label for="password" value="Пароль" />
                <x-text-input id="password" name="password" type="password" class="shop-input" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 shop-error" />
            </div>

            <div class="shop-actions" style="justify-content:flex-end;">
                <button type="button" class="shop-btn shop-btn-secondary" x-on:click="$dispatch('close')">
                    Отмена
                </button>

                <button type="submit" class="shop-btn shop-btn-danger">
                    Удалить аккаунт
                </button>
            </div>
        </form>
    </x-modal>
</section>
