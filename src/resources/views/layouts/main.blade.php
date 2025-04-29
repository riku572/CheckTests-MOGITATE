<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            background-color: white;
            box-shadow: 0 1px 3px rgba(0,0,0,0.1);
            padding: 1rem;
            display: flex;
            align-items: center;
        }

        header .logo {
            color: #F59E0B;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            padding: 1rem;
            background-color: #f9fafb;
            border-right: 1px solid #e5e7eb;
        }

        .main-content {
            flex: 1;
            padding: 2rem;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
            background-color: #fff;
            box-shadow: 0 1px 2px rgba(0,0,0,0.05);
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 0.5rem;
        }

        .card-text {
            color: #555;
        }

        .tag {
            display: inline-block;
            background-color: #f0f0f0;
            padding: 0.3rem 0.6rem;
            border-radius: 9999px;
            margin-bottom: 1rem;
        }

        .tag a {
            margin-left: 0.5rem;
            color: #888;
            text-decoration: none;
        }

        form input, form select, form button {
            display: block;
            width: 100%;
            margin-bottom: 1rem;
            padding: 0.5rem;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        form button {
            background-color: #F59E0B;
            color: white;
            font-weight: bold;
            border: none;
            cursor: pointer;
        }

        form button:hover {
            background-color: #d97706;
        }

        .product-image {
            width: 100%;
            height: auto;
            max-width: 200px; /* 任意の最大幅 */
            object-fit: cover; /* 画像をカード内にフィットさせる */
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">mogitate</div>
    </header>

    <div class="wrapper">
        <aside class="sidebar">
            @include('components.sidebar')
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>
</body>
</html>
