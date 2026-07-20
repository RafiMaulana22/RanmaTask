<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') | RanmaTask</title>

    <!-- Google Font (Inter & Plus Jakarta Sans sangat cocok untuk konsep Minimalis) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    @stack('styles')

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #ffffff;
            color: #0f172a;
            letter-spacing: -0.01em;
        }

        /* Sisi Kiri: Bersih, banyak ruang kosong, warna latar belakang pudar/lembut */
        .auth-left {
            background-color: #f8fafc;
            border-right: 1px solid #f1f5f9;
        }

        .auth-left h1 {
            font-weight: 700;
            color: #0f172a;
            letter-spacing: -0.03em;
        }

        .auth-left p {
            color: #475569;
            font-size: 1.05rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .brand-icon {
            color: #4f46e5;
            background-color: #eeebff;
            padding: 1rem;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        /* Sisi Kanan: Fokus penuh pada Form */
        .auth-card {
            width: 100%;
            max-width: 400px;
            padding: 2rem 1rem;
        }
    </style>

</head>

<body>

    <div class="container-fluid p-0">

        <div class="row g-0 min-vh-100">

            <!-- Left Side (Visual Branding Minimalis) -->
            <div class="col-lg-6 d-none d-lg-flex align-items-center justify-content-center auth-left">

                <div class="text-center px-5">

                    <div class="brand-icon mb-4">
                        <i class="bi bi-check2-square fs-2"></i>
                    </div>

                    <h1 class="display-5 mb-3">RanmaTask</h1>

                    <p class="fw-normal lh-base">
                        Atur tugas dengan mudah. Tetap produktif tanpa gangguan. Selesaikan lebih banyak hal setiap hari.
                    </p>

                </div>

            </div>

            <!-- Right Side (Tempat Form Login/Register) -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center bg-white">

                <div class="auth-card">

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')

</body>

</html>
