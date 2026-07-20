<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | RanmaTask</title>

    <!-- Google Font (Modern & Clean Geometrics) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #fafafa;
            /* Latar belakang ultra-clean */
            color: #0f172a;
            overflow-x: hidden;
            letter-spacing: -0.01em;
        }

        .wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Area Konten Utama */
        .main-content {
            width: calc(100% - 260px);
            margin-left: 260px;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            background-color: #ffffff;
            /* Memisahkan warna dasar sidebar/latar belakang */
            transition: all 0.25s ease;
        }

        /* Halaman Konten dengan Whitespace yang Optimal */
        .page-content {
            flex: 1;
            padding: 2rem 2.5rem;
        }

        /* Gaya Alert Minimalis */
        .alert-minimal {
            border: none;
            border-radius: 8px;
            padding: 0.875rem 2.5rem 0.875rem 1.25rem;
            margin-bottom: 1.5rem;
            box-shadow: none;
        }

        .alert-success-minimal {
            background-color: #f0fdf4;
            color: #166534;
        }

        .alert-danger-minimal {
            background-color: #fef2f2;
            color: #991b1b;
        }

        .btn-close-minimal {
            position: absolute;
            top: 50% !important;
            right: 0.75rem !important;
            transform: translateY(-50%);
            padding: 0.5rem !important;
            box-shadow: none !important;
            font-size: 0.75rem;
            opacity: 0.5;
            transition: opacity 0.2s;
        }

        .btn-close-minimal:hover {
            opacity: 0.8;
        }

        /* Responsif untuk Tablet dan Mobile */
        @media (max-width: 991px) {
            .main-content {
                width: 100%;
                margin-left: 0;
            }

            .page-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="wrapper">

        {{-- Sidebar --}}
        @include('Components.sidebar')

        <div class="main-content">

            {{-- Navbar --}}
            @include('Components.navbar')

            <main class="page-content">

                <!-- Containers for Feedback Notification -->
                @if (session('success'))
                    <div class="alert alert-minimal alert-success-minimal alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check2-circle fs-5 me-2.5"></i>
                            <span class="small fw-medium">{{ session('success') }}</span>
                        </div>
                        <button type="button" class="btn-close btn-close-minimal" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-minimal alert-danger-minimal alert-dismissible fade show" role="alert">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-circle fs-5 me-2.5"></i>
                            <span class="small fw-medium">{{ session('error') }}</span>
                        </div>
                        <button type="button" class="btn-close btn-close-minimal" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endif

                {{-- Main View Yield --}}
                @yield('content')

            </main>

            {{-- Footer --}}
            @include('Components.footer')

        </div>

    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>
