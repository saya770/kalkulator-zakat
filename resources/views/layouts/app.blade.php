<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kalkulator Zakat')</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
        }

        header {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        header h1 {
            color: #333;
            margin-bottom: 10px;
        }

        header p {
            color: #666;
            font-size: 14px;
        }

        nav {
            background: white;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        nav a {
            display: inline-block;
            padding: 10px 20px;
            margin-right: 10px;
            text-decoration: none;
            background: #667eea;
            color: white;
            border-radius: 5px;
            transition: background 0.3s;
        }

        nav a:hover {
            background: #764ba2;
        }

        nav a.active {
            background: #764ba2;
        }

        main {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 14px;
        }

        .alert-success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #333;
            font-size: 14px;
        }

        input, select, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            transition: border-color 0.3s;
        }

        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 5px rgba(102, 126, 234, 0.3);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 768px) {
            .form-row {
                grid-template-columns: 1fr;
            }
        }

        button {
            padding: 12px 30px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: 600;
            transition: background 0.3s;
        }

        button:hover {
            background: #764ba2;
        }

        button.btn-secondary {
            background: #6c757d;
        }

        button.btn-secondary:hover {
            background: #5a6268;
        }

        button.btn-danger {
            background: #dc3545;
        }

        button.btn-danger:hover {
            background: #c82333;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th {
            background: #f8f9fa;
            padding: 15px;
            text-align: left;
            font-weight: 600;
            border-bottom: 2px solid #ddd;
            color: #333;
        }

        table td {
            padding: 15px;
            border-bottom: 1px solid #ddd;
        }

        table tr:hover {
            background: #f8f9fa;
        }

        .result-box {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }

        .result-box h3 {
            color: #333;
            margin-bottom: 15px;
        }

        .result-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #ddd;
        }

        .result-item:last-child {
            border-bottom: none;
        }

        .result-item strong {
            color: #333;
        }

        .result-item span {
            color: #666;
        }

        .zakat-total {
            background: #d4edda;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border-left: 4px solid #28a745;
        }

        .zakat-total h4 {
            color: #155724;
            margin-bottom: 10px;
        }

        .zakat-amount {
            font-size: 24px;
            font-weight: bold;
            color: #155724;
        }

        .table-actions {
            display: flex;
            gap: 10px;
        }

        .table-actions a, .table-actions button {
            padding: 8px 15px;
            font-size: 14px;
            text-decoration: none;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .btn-edit {
            background: #17a2b8;
            color: white;
        }

        .btn-edit:hover {
            background: #138496;
        }

        .btn-view {
            background: #667eea;
            color: white;
        }

        .btn-view:hover {
            background: #5568d3;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
        }

        .btn-delete:hover {
            background: #c82333;
        }

        .pagination {
            margin-top: 30px;
            display: flex;
            gap: 5px;
            justify-content: center;
        }

        .pagination a, .pagination span {
            padding: 8px 12px;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-decoration: none;
            color: #667eea;
        }

        .pagination a:hover {
            background: #667eea;
            color: white;
        }

        .pagination span.active {
            background: #667eea;
            color: white;
        }

        .empty-state {
            text-align: center;
            padding: 40px 20px;
            color: #999;
        }

        .empty-state h3 {
            margin-bottom: 15px;
            color: #666;
        }

        footer {
            text-align: center;
            margin-top: 40px;
            color: white;
            font-size: 14px;
        }

        .info-box {
            background: #e7f3ff;
            border-left: 4px solid #2196F3;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 3px;
            color: #31708f;
        }
    </style>
    @yield('styles')
</head>
<body>
    <div class="container">
        <header>
            <h1>📱 Kalkulator Zakat</h1>
            <p>Hitung zakat Anda dengan mudah dan akurat</p>
        </header>

        <nav>
            <a href="{{ route('zakat.index') }}" class="@if(Route::currentRouteName() == 'zakat.index') active @endif">Daftar Perhitungan</a>
            <a href="{{ route('zakat.create') }}" class="@if(Route::currentRouteName() == 'zakat.create') active @endif">Hitung Zakat Baru</a>
        </nav>

        <main>
            @if($errors->any())
                <div class="alert alert-error">
                    <strong>Terjadi kesalahan:</strong>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </main>

        <footer>
            <p>&copy; 2025 Kalkulator Zakat. Semoga zakat kita diterima. Amin 🤲</p>
        </footer>
    </div>

    @yield('scripts')
</body>
</html>
