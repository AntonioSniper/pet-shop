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
            --shop-orange-dark: #ea580c;
            --shop-bg: #f4f7fb;
            --shop-text: #111827;
            --shop-muted: #6b7280;
            --shop-border: #d9e1ec;
            --shop-card: #ffffff;
            --shop-danger: #dc2626;
            --shop-danger-dark: #b91c1c;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Figtree, Arial, sans-serif;
            background: var(--shop-bg);
            color: var(--shop-text);
        }

        main {
            min-height: calc(100vh - 74px);
        }

        a,
        button,
        input[type="submit"] {
            cursor: pointer;
        }

        a {
            color: var(--shop-primary);
            text-decoration: none;
        }

        a:hover {
            color: var(--shop-primary-dark);
        }

        h1,
        h2,
        h3,
        p {
            margin-top: 0;
        }

        .shop-header {
            background: #ffffff;
            border-bottom: 1px solid var(--shop-border);
        }

        .shop-header-inner {
            max-width: 1180px;
            margin: 0 auto;
            padding: 22px 24px;
        }

        .shop-header h1,
        .shop-header h2 {
            margin: 0;
            color: var(--shop-text);
            font-size: 28px;
            line-height: 1.2;
            font-weight: 700;
        }

        .shop-page {
            padding: 32px 24px 48px;
        }

        .shop-container {
            width: min(1180px, 100%);
            margin: 0 auto;
        }

        .shop-section {
            margin-top: 24px;
        }

        .shop-section-title {
            margin-bottom: 14px;
            font-size: 22px;
            line-height: 1.25;
            font-weight: 700;
            color: var(--shop-text);
        }

        .shop-lead {
            max-width: 720px;
            margin-bottom: 0;
            color: #4b5563;
            font-size: 18px;
            line-height: 1.55;
        }

        .shop-hero {
            padding: 30px;
            border: 1px solid var(--shop-border);
            border-radius: 8px;
            background: #ffffff;
        }

        .shop-hero h1 {
            margin-bottom: 10px;
            font-size: clamp(30px, 4vw, 44px);
            line-height: 1.1;
            font-weight: 700;
            color: var(--shop-text);
            letter-spacing: 0;
        }

        .shop-card {
            border: 1px solid var(--shop-border);
            border-radius: 8px;
            background: var(--shop-card);
            box-shadow: 0 10px 28px rgba(17, 24, 39, 0.07);
        }

        .shop-card-pad {
            padding: 24px;
        }

        .shop-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 22px;
        }

        .shop-product-card {
            display: flex;
            min-height: 100%;
            overflow: hidden;
            flex-direction: column;
        }

        .shop-product-image {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
            background: #e8eef7;
        }

        .shop-product-body {
            display: flex;
            flex: 1;
            flex-direction: column;
            padding: 18px;
        }

        .shop-product-title {
            margin-bottom: 8px;
            font-size: 20px;
            line-height: 1.25;
            font-weight: 700;
            color: var(--shop-text);
        }

        .shop-product-meta {
            margin-bottom: 10px;
            color: var(--shop-muted);
            font-size: 14px;
        }

        .shop-product-description {
            margin-bottom: 16px;
            color: #374151;
            line-height: 1.5;
        }

        .shop-price {
            margin-bottom: 14px;
            color: var(--shop-text);
            font-size: 22px;
            font-weight: 700;
        }

        .shop-spacer {
            flex: 1;
        }

        .shop-btn {
            display: inline-flex;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 8px;
            border: 1px solid transparent;
            border-radius: 8px;
            padding: 11px 18px;
            color: #ffffff;
            font-size: 15px;
            font-weight: 700;
            line-height: 1.2;
            text-decoration: none;
            transition: background-color 0.16s ease, border-color 0.16s ease, color 0.16s ease, box-shadow 0.16s ease;
            white-space: nowrap;
        }

        .shop-btn:hover {
            color: #ffffff;
            box-shadow: 0 8px 18px rgba(17, 24, 39, 0.14);
        }

        .shop-btn:disabled {
            cursor: not-allowed;
            opacity: 0.55;
            box-shadow: none;
        }

        .shop-btn-primary {
            background: var(--shop-primary);
            border-color: var(--shop-primary);
        }

        .shop-btn-primary:hover {
            background: var(--shop-primary-dark);
            border-color: var(--shop-primary-dark);
        }

        .shop-btn-orange {
            background: var(--shop-orange);
            border-color: var(--shop-orange);
        }

        .shop-btn-orange:hover {
            background: var(--shop-orange-dark);
            border-color: var(--shop-orange-dark);
        }

        .shop-btn-danger {
            background: var(--shop-danger);
            border-color: var(--shop-danger);
        }

        .shop-btn-danger:hover {
            background: var(--shop-danger-dark);
            border-color: var(--shop-danger-dark);
        }

        .shop-btn-secondary {
            background: #ffffff;
            border-color: var(--shop-border);
            color: var(--shop-text);
        }

        .shop-btn-secondary:hover {
            background: #eef4ff;
            border-color: #b8caf0;
            color: var(--shop-primary-dark);
        }

        .shop-btn-block {
            width: 100%;
        }

        .shop-input,
        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        textarea,
        select {
            width: 100%;
            min-height: 44px;
            border: 1px solid var(--shop-border);
            border-radius: 8px;
            background: #ffffff;
            padding: 10px 12px;
            color: var(--shop-text);
            font-size: 15px;
        }

        .shop-input:focus,
        input:focus,
        textarea:focus,
        select:focus {
            outline: none;
            border-color: var(--shop-primary);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.16);
        }

        .shop-label,
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

        .shop-search {
            margin-top: 22px;
            padding: 20px;
            border: 1px solid var(--shop-border);
            border-radius: 8px;
            background: #ffffff;
        }

        .shop-search-row,
        .shop-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
        }

        .shop-actions form {
            margin: 0;
        }

        .shop-search-row .shop-input {
            flex: 1 1 280px;
        }

        .shop-category-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .shop-category-link {
            display: inline-flex;
            min-height: 42px;
            align-items: center;
            border: 1px solid var(--shop-border);
            border-radius: 8px;
            background: #ffffff;
            padding: 9px 14px;
            color: var(--shop-text);
            font-weight: 700;
            text-decoration: none;
        }

        .shop-category-link:hover,
        .shop-category-link.is-active {
            border-color: var(--shop-primary);
            background: var(--shop-primary);
            color: #ffffff;
        }

        .shop-badge {
            display: inline-flex;
            min-height: 28px;
            align-items: center;
            border-radius: 999px;
            padding: 5px 10px;
            background: #eaf2ff;
            color: var(--shop-primary-dark);
            font-size: 13px;
            font-weight: 700;
        }

        .shop-badge-success {
            background: #dcfce7;
            color: #166534;
        }

        .shop-badge-warning {
            background: #ffedd5;
            color: #9a3412;
        }

        .shop-badge-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .shop-badge-muted {
            background: #eef2f7;
            color: #475569;
        }

        .shop-alert {
            margin-bottom: 18px;
            border-radius: 8px;
            padding: 14px 16px;
            font-weight: 700;
        }

        .shop-alert-success {
            background: #dcfce7;
            color: #166534;
        }

        .shop-alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .shop-table-wrap {
            width: 100%;
            overflow-x: auto;
            border: 1px solid var(--shop-border);
            border-radius: 8px;
            background: #ffffff;
        }

        .shop-table {
            width: 100%;
            min-width: 720px;
            border-collapse: collapse;
        }

        .shop-table th,
        .shop-table td {
            padding: 14px 16px;
            border-bottom: 1px solid var(--shop-border);
            text-align: left;
            vertical-align: middle;
        }

        .shop-table th {
            background: #eef4ff;
            color: var(--shop-text);
            font-weight: 700;
        }

        .shop-table tr:last-child td {
            border-bottom: 0;
        }

        .shop-total {
            display: flex;
            flex-wrap: wrap;
            gap: 14px;
            align-items: center;
            justify-content: space-between;
            margin-top: 18px;
            padding: 18px;
            border: 2px solid var(--shop-orange);
            border-radius: 8px;
            background: #fff7ed;
        }

        .shop-total strong {
            font-size: 24px;
        }

        .shop-order-grid,
        .shop-admin-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 18px;
        }

        .shop-order-card {
            padding: 22px;
        }

        .shop-order-head {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: flex-start;
            justify-content: space-between;
            margin-bottom: 16px;
        }

        .shop-order-title {
            margin-bottom: 4px;
            font-size: 22px;
            font-weight: 700;
        }

        .shop-info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(190px, 1fr));
            gap: 12px;
            margin-bottom: 18px;
        }

        .shop-info-cell {
            border-left: 4px solid var(--shop-primary);
            padding: 10px 12px;
            background: #f8fbff;
        }

        .shop-info-label {
            margin-bottom: 4px;
            color: var(--shop-muted);
            font-size: 13px;
            font-weight: 700;
        }

        .shop-info-value {
            color: var(--shop-text);
            font-weight: 700;
        }

        .shop-detail {
            display: grid;
            grid-template-columns: minmax(280px, 44%) 1fr;
            gap: 28px;
            padding: 24px;
        }

        .shop-detail-image {
            width: 100%;
            aspect-ratio: 4 / 3;
            border-radius: 8px;
            object-fit: cover;
            background: #e8eef7;
        }

        .shop-muted {
            color: var(--shop-muted);
        }

        .shop-error,
        .text-red-600 {
            color: var(--shop-danger) !important;
            font-weight: 700;
        }

        .shop-admin-card {
            display: flex;
            min-height: 210px;
            flex-direction: column;
            padding: 24px;
        }

        .shop-admin-card h3 {
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: 700;
        }

        .shop-admin-card p {
            color: #4b5563;
            line-height: 1.5;
        }

        .shop-form {
            display: grid;
            gap: 18px;
        }

        .shop-empty {
            padding: 28px;
            text-align: center;
        }

        .shop-empty h3 {
            margin-bottom: 10px;
            font-size: 24px;
            font-weight: 700;
        }

        @media (max-width: 760px) {
            .shop-page {
                padding: 24px 16px 36px;
            }

            .shop-hero,
            .shop-card-pad,
            .shop-detail {
                padding: 20px;
            }

            .shop-detail {
                grid-template-columns: 1fr;
            }

            .shop-btn {
                width: 100%;
                white-space: normal;
            }

            .shop-search-row {
                align-items: stretch;
            }

            .shop-actions form {
                width: 100%;
            }
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen">
        @include('layouts.navigation')

        @isset($header)
            <header class="shop-header">
                <div class="shop-header-inner">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <main>
            {{ $slot }}
        </main>
    </div>
</body>
</html>
