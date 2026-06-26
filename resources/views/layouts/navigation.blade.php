<nav x-data="{ open: false }" class="shop-nav">
    <style>
        .shop-nav {
            position: sticky;
            top: 0;
            z-index: 30;
            border-bottom: 1px solid #d9e1ec;
            background: #ffffff;
            box-shadow: 0 8px 22px rgba(17, 24, 39, 0.06);
        }

        .shop-nav-inner {
            max-width: 1180px;
            margin: 0 auto;
            padding: 0 24px;
        }

        .shop-nav-row {
            display: flex;
            min-height: 72px;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
        }

        .shop-brand {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            color: #111827;
            font-weight: 700;
            text-decoration: none;
        }

        .shop-brand-mark {
            display: inline-flex;
            width: 42px;
            height: 42px;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            background: #2563eb;
            color: #ffffff;
            font-weight: 700;
        }

        .shop-brand-text span {
            display: block;
            color: #6b7280;
            font-size: 12px;
            font-weight: 600;
        }

        .shop-nav-links,
        .shop-nav-user {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .shop-nav-link {
            display: inline-flex;
            min-height: 42px;
            align-items: center;
            border-radius: 8px;
            padding: 9px 13px;
            color: #374151;
            font-weight: 700;
            text-decoration: none;
        }

        .shop-nav-link:hover,
        .shop-nav-link.is-active {
            background: #eef4ff;
            color: #1d4ed8;
        }

        .shop-nav-link.is-active {
            box-shadow: inset 0 0 0 1px #bfdbfe;
        }

        .shop-nav-logout {
            border: 0;
            border-radius: 8px;
            background: #dc2626;
            color: #ffffff;
            padding: 10px 14px;
            font-weight: 700;
        }

        .shop-nav-logout:hover {
            background: #b91c1c;
        }

        .shop-nav-toggle {
            display: none;
            width: 44px;
            height: 44px;
            align-items: center;
            justify-content: center;
            border: 1px solid #d9e1ec;
            border-radius: 8px;
            background: #ffffff;
            color: #111827;
        }

        .shop-mobile-menu {
            display: none;
            border-top: 1px solid #d9e1ec;
            padding: 14px 24px 18px;
        }

        .shop-mobile-menu.is-open {
            display: block;
        }

        .shop-mobile-menu .shop-nav-link,
        .shop-mobile-menu .shop-nav-logout {
            width: 100%;
            justify-content: flex-start;
            margin-bottom: 8px;
        }

        .shop-user-name {
            color: #6b7280;
            font-size: 14px;
            font-weight: 700;
        }

        @media (max-width: 980px) {
            .shop-nav-links,
            .shop-nav-user {
                display: none;
            }

            .shop-nav-toggle {
                display: inline-flex;
            }
        }
    </style>

    @php
        $isCatalog = request()->routeIs('home') || request()->routeIs('products.*');
        $isCart = request()->routeIs('cart.*') || request()->routeIs('checkout');
        $isOrders = request()->routeIs('orders.*');
        $isProfile = request()->routeIs('profile.*') || request()->routeIs('dashboard');
        $isAdmin = request()->routeIs('admin.*');
    @endphp

    <div class="shop-nav-inner">
        <div class="shop-nav-row">
            <a href="{{ route('home') }}" class="shop-brand">
                <span class="shop-brand-mark">PS</span>
                <span class="shop-brand-text">
                    Pet Shop
                    <span>товары для животных</span>
                </span>
            </a>

            <div class="shop-nav-links">
                <a href="{{ route('home') }}" class="shop-nav-link {{ $isCatalog ? 'is-active' : '' }}">Каталог</a>
                <a href="{{ route('cart.index') }}" class="shop-nav-link {{ $isCart ? 'is-active' : '' }}">Корзина</a>

                @auth
                    <a href="{{ route('orders.index') }}" class="shop-nav-link {{ $isOrders ? 'is-active' : '' }}">Мои заказы</a>
                    <a href="{{ route('profile.edit') }}" class="shop-nav-link {{ $isProfile ? 'is-active' : '' }}">Профиль</a>

                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="shop-nav-link {{ $isAdmin ? 'is-active' : '' }}">Админка</a>
                    @endif
                @endauth
            </div>

            <div class="shop-nav-user">
                @auth
                    <span class="shop-user-name">{{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                        @csrf
                        <button type="submit" class="shop-nav-logout">Выйти</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="shop-nav-link {{ request()->routeIs('login') ? 'is-active' : '' }}">Войти</a>
                    <a href="{{ route('register') }}" class="shop-btn shop-btn-primary">Регистрация</a>
                @endauth
            </div>

            <button type="button" @click="open = ! open" class="shop-nav-toggle" aria-label="Открыть меню">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path :class="{ 'hidden': open }" d="M4 6h16M4 12h16M4 18h16" stroke-linecap="round" />
                    <path :class="{ 'hidden': !open }" class="hidden" d="M6 6l12 12M18 6L6 18" stroke-linecap="round" />
                </svg>
            </button>
        </div>
    </div>

    <div :class="{ 'is-open': open }" class="shop-mobile-menu">
        <a href="{{ route('home') }}" class="shop-nav-link {{ $isCatalog ? 'is-active' : '' }}">Каталог</a>
        <a href="{{ route('cart.index') }}" class="shop-nav-link {{ $isCart ? 'is-active' : '' }}">Корзина</a>

        @auth
            <a href="{{ route('orders.index') }}" class="shop-nav-link {{ $isOrders ? 'is-active' : '' }}">Мои заказы</a>
            <a href="{{ route('profile.edit') }}" class="shop-nav-link {{ $isProfile ? 'is-active' : '' }}">Профиль</a>

            @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="shop-nav-link {{ $isAdmin ? 'is-active' : '' }}">Админка</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" style="margin:8px 0 0;">
                @csrf
                <button type="submit" class="shop-nav-logout">Выйти</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="shop-nav-link {{ request()->routeIs('login') ? 'is-active' : '' }}">Войти</a>
            <a href="{{ route('register') }}" class="shop-nav-link {{ request()->routeIs('register') ? 'is-active' : '' }}">Регистрация</a>
        @endauth
    </div>
</nav>
