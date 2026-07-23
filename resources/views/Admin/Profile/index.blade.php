@extends('Layouts.template-admin') {{-- Disesuaikan dengan nama file layout utama admin Anda --}}

@section('title', 'Profile')

@section('content')

    <!-- Header Section -->
    <div class="mb-5 animate-fade-in">
        <h3 class="fw-bold text-dark tracking-tight mb-1">Account Settings</h3>
        <p class="text-secondary mb-0 text-sm">Manage your personal info, account preferences, and credentials.</p>
    </div>

    <!-- Systems Notifications Container -->
    <div class="alert-container">
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

        @if ($errors->any())
            <div class="alert alert-minimal alert-danger-minimal alert-dismissible fade show" role="alert">
                <div class="d-flex align-items-start">
                    <i class="bi bi-exclamation-circle fs-5 me-2.5 mt-0.5"></i>
                    <div class="small">
                        <span class="fw-semibold">Please fix the following validation issues:</span>
                        <ul class="mb-0 ps-3 mt-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-minimal" data-bs-dismiss="alert"
                    aria-label="Close"></button>
            </div>
        @endif
    </div>

    <div class="row g-4">

        <!-- Left Column: User Card & Quick Metrics -->
        <div class="col-lg-4">

            <!-- Profile Summary Card -->
            <div class="card border-0 content-card-minimal mb-4">
                <div class="card-body text-center p-4">

                    <div class="position-relative d-inline-block mb-3">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=0F172A&color=fff&size=150"
                            class="rounded-circle avatar-img" width="100" height="100" alt="Profile Picture">
                    </div>

                    <h5 class="fw-bold text-dark tracking-tight mb-1">
                        {{ $user->name }}
                    </h5>

                    <p class="text-secondary small mb-3">
                        {{ $user->email }}
                    </p>

                    <span class="badge-minimal bg-success-minimal text-success-text mb-4">
                        Active Account
                    </span>

                    <div class="border-top pt-3 text-start">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted extra-small fw-semibold text-uppercase tracking-wider">Member
                                Since</span>
                            <span
                                class="text-dark small fw-medium">{{ $user->created_at->translatedFormat('d M Y') }}</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted extra-small fw-semibold text-uppercase tracking-wider">Last
                                Activity</span>
                            <span class="text-dark small fw-medium">Today</span>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Task Performance Summary -->
            <div class="card border-0 content-card-minimal">
                <div class="card-body p-4">
                    <span class="text-muted extra-small fw-semibold text-uppercase tracking-wider d-block mb-3">Workspace
                        Overview</span>
                    <div class="row g-2 text-center">
                        <div class="col-4">
                            <div class="p-2.5 rounded-2 bg-light">
                                <h5 class="fw-bold text-dark tracking-tight mb-0">{{ $totalTasks ?? 0 }}</h5>
                                <span class="text-muted extra-small">Total</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2.5 rounded-2 bg-success-minimal">
                                <h5 class="fw-bold text-success-text tracking-tight mb-0">{{ $completedTasks ?? 0 }}</h5>
                                <span class="text-success-text extra-small opacity-75">Done</span>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="p-2.5 rounded-2 bg-warning-minimal">
                                <h5 class="fw-bold text-warning-text tracking-tight mb-0">{{ $pendingTasks ?? 0 }}</h5>
                                <span class="text-warning-text extra-small opacity-75">Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Right Column: Settings Forms -->
        <div class="col-lg-8">

            <!-- Profile Information Form -->
            <div class="card border-0 content-card-minimal mb-4">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold text-dark tracking-tight mb-0">Personal Information</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-medium mb-2">Full Name</label>
                            <input type="text" class="form-control form-input-minimal" name="name"
                                value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-medium mb-2">Email Address</label>
                            <input type="email" class="form-control form-input-minimal" name="email"
                                value="{{ old('email', $user->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-dark py-2 px-3 fw-medium minimal-btn">
                            Save Changes
                        </button>
                    </form>
                </div>
            </div>

            <!-- Security & Password Form -->
            <div class="card border-0 content-card-minimal">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold text-dark tracking-tight mb-0">Update Security Password</h5>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('profile.password') }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-medium mb-2">Current Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-input-minimal pe-5" id="currentPassword"
                                    name="current_password" required>
                                <button type="button" class="btn password-toggle-btn toggle-password"
                                    data-target="currentPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label text-dark small fw-medium mb-2">New Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-input-minimal pe-5" id="newPassword"
                                    name="password" required>
                                <button type="button" class="btn password-toggle-btn toggle-password"
                                    data-target="newPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label text-dark small fw-medium mb-2">Confirm New Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control form-input-minimal pe-5" id="confirmPassword"
                                    name="password_confirmation" required>
                                <button type="button" class="btn password-toggle-btn toggle-password"
                                    data-target="confirmPassword">
                                    <i class="bi bi-eye"></i>
                                </button>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-dark py-2 px-3 fw-medium minimal-btn">
                            Update Credentials
                        </button>
                    </form>
                </div>
            </div>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        /* Core Utilities */
        .tracking-tight {
            letter-spacing: -0.025em;
        }

        .tracking-wider {
            letter-spacing: 0.05em;
        }

        .text-sm {
            font-size: 0.85rem;
        }

        .extra-small {
            font-size: 0.725rem;
        }

        /* General Card Minimal Structure */
        .content-card-minimal {
            background-color: #ffffff;
            border: 1px solid #f1f5f9 !important;
            border-radius: 12px;
        }

        /* Avatar border styling */
        .avatar-img {
            border: 1px solid #e2e8f0;
            padding: 2px;
            background-color: #ffffff;
        }

        /* Solid Black Button */
        .minimal-btn {
            background-color: #0f172a;
            border: none;
            border-radius: 6px;
            font-size: 0.875rem;
            transition: background-color 0.2s ease;
        }

        .minimal-btn:hover,
        .minimal-btn:focus {
            background-color: #1e293b;
        }

        /* Input Controls */
        .form-input-minimal {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.55rem 0.75rem;
            font-size: 0.875rem;
            color: #0f172a;
            transition: all 0.2s ease;
        }

        .form-input-minimal:focus {
            background-color: #ffffff;
            border-color: #0f172a;
            box-shadow: none;
        }

        /* Toggle Password Button */
        .password-toggle-btn {
            position: absolute;
            top: 50%;
            right: 0;
            transform: translateY(-50%);

            width: 45px;
            height: 100%;

            border: none;
            background: transparent;

            display: flex;
            align-items: center;
            justify-content: center;

            color: #64748b;
            box-shadow: none !important;
            z-index: 10;
        }

        .password-toggle-btn:hover {
            color: #0f172a;
        }

        /* Badge minimal configs */
        .badge-minimal {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.6rem;
            font-size: 0.725rem;
            font-weight: 600;
            border-radius: 4px;
        }

        .bg-success-minimal {
            background-color: #f0fdf4;
        }

        .text-success-text {
            color: #166534;
        }

        .bg-warning-minimal {
            background-color: #fffbeb;
        }

        .text-warning-text {
            color: #92400e;
        }

        /* Alert minimal configs */
        .alert-minimal {
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            margin-bottom: 1.25rem;
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
        }

        /* Animation */
        .animate-fade-in {
            animation: fIn 0.25s ease-out;
        }

        @keyframes fIn {
            from {
                opacity: 0;
                transform: translateY(4px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle visibility password
            document.querySelectorAll('.toggle-password').forEach(button => {
                button.addEventListener('click', function() {
                    const targetId = this.dataset.target;
                    const input = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.replace('bi-eye', 'bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.replace('bi-eye-slash', 'bi-eye');
                    }
                });
            });

            // Auto dismiss alert
            setTimeout(function() {
                const activeAlerts = document.querySelectorAll('.alert-minimal');
                activeAlerts.forEach(function(element) {
                    const closingInstance = bootstrap.Alert.getOrCreateInstance(element);
                    if (closingInstance) {
                        closingInstance.close();
                    }
                });
            }, 3000);
        });
    </script>
@endpush
