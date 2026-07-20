@extends('Layouts.template-auth')

@section('title', 'Forgot Password')

@section('content')

    <div class="login-wrapper">

        <!-- Header -->
        <h2 class="fw-bold text-dark tracking-tight mb-2">
            Lupa Kata Sandi?
        </h2>

        <p class="text-secondary small mb-4">
            Tenang saja. Masukkan alamat email Anda, dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi kepada Anda.
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

        <form action="{{ route('forgot-password.submit') }}" method="POST">

            @csrf

            <div class="mb-4">

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

            <button type="submit" class="btn btn-dark w-100 minimal-btn mb-4">

                <i class="bi bi-envelope-paper me-2"></i>

                Kirim Tautan Reset

            </button>

        </form>

        <div class="text-center">

            <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-medium">

                <i class="bi bi-arrow-left me-1"></i>

                Kembali ke Login

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
    </style>
@endpush
