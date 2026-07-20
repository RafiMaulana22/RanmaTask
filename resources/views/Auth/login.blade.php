@extends('Layouts.template-auth') {{-- Disesuaikan dengan nama file layout Anda --}}

@section('title', 'Login')

@section('content')

    <div class="login-wrapper">

        <!-- Header -->
        <h2 class="fw-bold text-dark tracking-tight mb-2">
            Selamat Datang Kembali
        </h2>

        <p class="text-secondary small mb-4">
            Masukkan data Anda untuk mengakses akun Anda.
        </p>

        {{-- Success --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Error --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-x-circle-fill me-2"></i>
                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Validation Error --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <strong>Oops!</strong>

                <ul class="mb-0 mt-2">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        <!-- Form -->
        <form action="{{ route('login.submit') }}" method="POST">
            @csrf

            <div class="mb-3">

                <label class="form-label text-dark small fw-medium mb-2">
                    Alamat Email
                </label>

                <input type="email" name="email" class="form-control minimal-input @error('email') is-invalid @enderror"
                    placeholder="name@example.com" value="{{ old('email') }}" required autofocus>

                @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="mb-4">

                <div class="d-flex justify-content-between align-items-center mb-2">

                    <label class="form-label text-dark small fw-medium mb-0">
                        Kata Sandi
                    </label>

                    <a href="{{ route('forgot-password') }}" class="text-decoration-none small text-muted hover-dark">

                        Lupa?

                    </a>

                </div>

                <div class="position-relative">

                    <input type="password" id="password" name="password"
                        class="form-control minimal-input pe-5 @error('password') is-invalid @enderror"
                        placeholder="••••••••" required>

                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0"
                        id="togglePassword">

                        <i class="bi bi-eye"></i>

                    </button>

                </div>

                @error('password')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <div class="form-check mb-4">

                <input class="form-check-input" type="checkbox" name="remember" id="remember">

                <label class="form-check-label small" for="remember">

                    Ingat Aku

                </label>

            </div>

            <button type="submit" class="btn btn-dark w-100 py-2 fw-semibold minimal-btn mb-4">

                <i class="bi bi-box-arrow-in-right me-2"></i>

                Masuk

            </button>

        </form>

        <!-- Footer / Link ke Register -->
        <p class="text-center text-secondary small mb-0">

            Belum punya akun?

            <a href="{{ route('register') }}" class="text-dark fw-semibold text-decoration-none">

                Buat akun

            </a>

        </p>

    </div>

@endsection

@push('styles')
    <style>
        /* Mengatur jarak antar huruf agar lebih clean */
        .tracking-tight {
            letter-spacing: -0.025em;
            font-size: 1.75rem;
        }

        /* Style Input Minimalis Modern */
        .minimal-input {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 0.625rem 0.875rem;
            font-size: 0.925rem;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        .minimal-input:focus {
            background-color: #ffffff;
            border-color: #0f172a;
            box-shadow: none;
        }

        .minimal-input::placeholder {
            color: #94a3b8;
        }

        /* Tombol Hitam Solid Minimalis */
        .minimal-btn {
            background-color: #0f172a;
            border: none;
            border-radius: 8px;
            font-size: 0.925rem;
            transition: background-color 0.2s ease;
        }

        .minimal-btn:hover,
        .minimal-btn:focus {
            background-color: #1e293b;
        }

        /* Efek hover teks halus */
        .hover-dark:hover {
            color: #0f172a !important;
        }

        #togglePassword {

            width: 45px;
            height: 45px;

            color: #64748b;

            box-shadow: none !important;

        }

        #togglePassword:hover {

            color: #0f172a;

        }
    </style>
@endpush

@push('scripts')
    <script>
        const password = document.getElementById('password');
        const togglePassword = document.getElementById('togglePassword');
        const icon = togglePassword.querySelector('i');

        togglePassword.addEventListener('click', function() {

            if (password.type === 'password') {

                password.type = 'text';

                icon.classList.remove('bi-eye');
                icon.classList.add('bi-eye-slash');

            } else {

                password.type = 'password';

                icon.classList.remove('bi-eye-slash');
                icon.classList.add('bi-eye');

            }

        });
    </script>
@endpush
