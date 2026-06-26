<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Pet Shop') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <style>
            :root {
                --shop-primary: #2563eb;
                --shop-primary-dark: #1d4ed8;
                --shop-orange: #f97316;
                --shop-bg: #f4f7fb;
                --shop-text: #111827;
                --shop-muted: #6b7280;
                --shop-border: #d9e1ec;
                --shop-danger: #dc2626;
            }

            * {
                box-sizing: border-box;
            }

            body {
                margin: 0;
                background: var(--shop-bg);
                color: var(--shop-text);
                font-family: Figtree, Arial, sans-serif;
            }

            a,
            button {
                cursor: pointer;
            }

            .shop-btn {
                display: inline-flex;
                min-height: 44px;
                align-items: center;
                justify-content: center;
                border: 1px solid transparent;
                border-radius: 8px;
                padding: 11px 18px;
                color: #ffffff;
                font-size: 15px;
                font-weight: 700;
                text-decoration: none;
            }

            .shop-btn-primary {
                background: var(--shop-primary);
                border-color: var(--shop-primary);
            }

            .shop-btn-primary:hover {
                background: var(--shop-primary-dark);
                border-color: var(--shop-primary-dark);
                color: #ffffff;
            }

            .shop-btn-block {
                width: 100%;
            }

            .shop-auth-page {
                display: flex;
                min-height: calc(100vh - 73px);
                align-items: center;
                justify-content: center;
                padding: 36px 18px;
            }

            .shop-auth-card {
                width: min(460px, 100%);
                border: 1px solid var(--shop-border);
                border-radius: 8px;
                background: #ffffff;
                padding: 28px;
                box-shadow: 0 10px 28px rgba(17, 24, 39, 0.08);
            }

            .shop-auth-head {
                margin-bottom: 24px;
            }

            .shop-auth-head h1 {
                margin: 0 0 8px;
                font-size: 30px;
                line-height: 1.15;
                font-weight: 700;
            }

            .shop-auth-head p,
            .shop-muted {
                margin: 0;
                color: var(--shop-muted);
                line-height: 1.5;
            }

            .shop-form {
                display: grid;
                gap: 18px;
            }

            .shop-input,
            input[type="text"],
            input[type="email"],
            input[type="password"] {
                width: 100%;
                min-height: 46px;
                border: 1px solid var(--shop-border);
                border-radius: 8px;
                background: #ffffff;
                padding: 10px 12px;
                color: var(--shop-text);
                font-size: 15px;
            }

            input:focus {
                outline: none;
                border-color: var(--shop-primary);
                box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.16);
            }

            label {
                display: block;
                margin-bottom: 7px;
                color: var(--shop-text);
                font-weight: 700;
            }

            input[type="checkbox"] {
                width: 18px;
                height: 18px;
                accent-color: var(--shop-primary);
            }

            .shop-checkbox {
                display: inline-flex;
                align-items: center;
                gap: 9px;
            }

            .shop-checkbox label,
            .shop-checkbox span {
                margin: 0;
                color: #374151;
                font-weight: 600;
            }

            .shop-auth-links {
                display: flex;
                flex-wrap: wrap;
                gap: 12px;
                align-items: center;
                justify-content: space-between;
            }

            .shop-inline-link {
                color: var(--shop-primary);
                font-weight: 700;
                text-decoration: none;
            }

            .shop-inline-link:hover {
                color: var(--shop-primary-dark);
                text-decoration: underline;
            }

            .shop-error,
            .text-red-600 {
                color: var(--shop-danger) !important;
                font-weight: 700;
            }
        </style>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            <main class="shop-auth-page">
                <div class="shop-auth-card">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
