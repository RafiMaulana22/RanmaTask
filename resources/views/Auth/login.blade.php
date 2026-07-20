@extends('layouts.template-auth')

@section('title', 'Login')

@section('content')

    <div class="card shadow border-0">

        <div class="card-body p-5">

            <h2 class="fw-bold mb-2">
                Welcome Back 👋
            </h2>

            <p class="text-muted mb-4">
                Login to continue using RanmaTask.
            </p>

            <form>

                <div class="mb-3">

                    <label>Email</label>

                    <input type="email" class="form-control">

                </div>

                <div class="mb-4">

                    <label>Password</label>

                    <input type="password" class="form-control">

                </div>

                <button class="btn btn-primary w-100">

                    Login

                </button>

            </form>

        </div>

    </div>

@endsection
