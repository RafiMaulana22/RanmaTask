@extends('Layouts.template-auth')

@section('title', 'Register')

@section('content')

    <div class="login-wrapper">

        <!-- Header -->
        <h2 class="fw-bold text-dark tracking-tight mb-2">
            Buat Akun
        </h2>

        <p class="text-secondary small mb-4">
            Buat akun Anda untuk mulai mengelola tugas-tugas harian Anda.
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

        {{-- Validation --}}
        @if ($errors->any())

            <div class="alert alert-danger alert-dismissible fade show">

                <strong>Oops!</strong>

                <ul class="mt-2 mb-0">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>

        @endif

        <form action="{{ route('register.submit') }}" method="POST">

            @csrf

            <!-- Full Name -->
            <div class="mb-3">

                <label class="form-label fw-medium small">
                    Nama Lengkap
                </label>

                <input type="text" name="name" value="{{ old('name') }}"
                    class="form-control minimal-input @error('name') is-invalid @enderror"
                    placeholder="Enter your full name" required>

                @error('name')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <!-- Email -->
            <div class="mb-3">

                <label class="form-label fw-medium small">
                    Alamat Email
                </label>

                <input type="email" name="email" value="{{ old('email') }}"
                    class="form-control minimal-input @error('email') is-invalid @enderror" placeholder="name@example.com"
                    required>

                @error('email')
                    <small class="text-danger">
                        {{ $message }}
                    </small>
                @enderror

            </div>

            <!-- Password -->
            <div class="mb-3">

                <label class="form-label fw-medium small">
                    Kata sandi
                </label>

                <div class="position-relative">

                    <input type="password" id="password" name="password"
                        class="form-control minimal-input pe-5 @error('password') is-invalid @enderror"
                        placeholder="Enter password" required>

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

            <!-- Confirm Password -->
            <div class="mb-4">

                <label class="form-label fw-medium small">
                    Konfirmasi Kata Sandi
                </label>

                <div class="position-relative">

                    <input type="password" id="confirmPassword" name="password_confirmation"
                        class="form-control minimal-input pe-5" placeholder="Confirm password" required>

                    <button type="button" class="btn position-absolute top-50 end-0 translate-middle-y border-0"
                        id="toggleConfirmPassword">

                        <i class="bi bi-eye"></i>

                    </button>

                </div>

            </div>

            <button type="submit" class="btn btn-dark w-100 minimal-btn mb-4">

                <i class="bi bi-person-plus me-2"></i>

                Buat Akun

            </button>

        </form>

        <div class="text-center">

            <span class="text-secondary small">
                Sudah memiliki akun?
            </span>

            <a href="{{ route('login') }}" class="text-dark fw-medium text-decoration-none">

                Masuk

            </a>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .tracking-tight {
            letter-spacing: -0.025em;
            font-size: 1.75rem;
        }

        .minimal-input {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: .7rem .9rem;
            transition: .2s;
        }

        .minimal-input:focus {
            background: #fff;
            border-color: #0f172a;
            box-shadow: none;
        }

        .minimal-btn {
            background: #0f172a;
            border: none;
            border-radius: 8px;
            padding: .7rem;
            transition: .2s;
        }

        .minimal-btn:hover {
            background: #1e293b;
        }

        #togglePassword,
        #toggleConfirmPassword {

            width: 45px;
            height: 45px;
            color: #64748b;
            box-shadow: none !important;

        }

        #togglePassword:hover,
        #toggleConfirmPassword:hover {

            color: #0f172a;

        }
    </style>
@endpush

@push('scripts')
    <script>
        function togglePassword(inputId, buttonId) {

            const input = document.getElementById(inputId);
            const button = document.getElementById(buttonId);
            const icon = button.querySelector('i');

            button.addEventListener('click', function() {

                if (input.type === 'password') {

                    input.type = 'text';

                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');

                } else {

                    input.type = 'password';

                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');

                }

            });

        }

        togglePassword('password', 'togglePassword');
        togglePassword('confirmPassword', 'toggleConfirmPassword');
    </script>
@endpush
