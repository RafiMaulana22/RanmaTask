@extends('Layouts.template-admin') {{-- Disesuaikan dengan nama file layout utama admin Anda --}}

@php
    use Carbon\Carbon;
@endphp

@section('title', 'Dashboard')

@section('content')

    <!-- Welcome Section (Clean Hero Space) -->
    <div class="welcome-hero mb-5 animate-fade-in">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h3 class="fw-bold text-dark tracking-tight mb-2">
                    Selamat datang kembali, {{ Auth::user()->name }}
                </h3>
                <p class="text-secondary mb-0 text-sm">
                    Pantau metrik harian dan produktivitas ruang kerja Anda dalam sekejap.
                </p>
            </div>
            <div class="d-none d-md-block">
                <div class="current-date-badge">
                    <i class="bi bi-calendar3 me-2 text-muted"></i>
                    <span class="fw-medium small text-dark">{{ Carbon::now()->locale('id')->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Grid -->
    <div class="row g-4 mb-5">

        <!-- Total Tasks -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Jumlah
                                Tugas</span>
                            <h2 class="fw-bold tracking-tight text-dark mt-2 mb-0">
                                {{ $totalTask ?? 0 }}
                            </h2>
                        </div>
                        <div class="stat-icon-minimal text-dark">
                            <i class="bi bi-list-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Selesai</span>
                            <h2 class="fw-bold tracking-tight text-dark mt-2 mb-0">
                                {{ $completedTask ?? 0 }}
                            </h2>
                        </div>
                        <div class="stat-icon-minimal text-success-minimal">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Sedang
                                diproses</span>
                            <h2 class="fw-bold tracking-tight text-dark mt-2 mb-0">
                                {{ $pendingTask ?? 0 }}
                            </h2>
                        </div>
                        <div class="stat-icon-minimal text-warning-minimal">
                            <i class="bi bi-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Overdue Tasks -->
        <div class="col-lg-3 col-md-6">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Tertunda</span>
                            <h2 class="fw-bold tracking-tight text-dark mt-2 mb-0">
                                {{ $overdueTask ?? 0 }}
                            </h2>
                        </div>
                        <div class="stat-icon-minimal text-danger-minimal">
                            <i class="bi bi-exclamation-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Sections -->
    <div class="row g-4">

        <!-- Recent Tasks Table -->
        <div class="col-lg-8">
            <div class="card border-0 content-card-minimal">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold text-dark tracking-tight mb-0">Tugas Terbaru</h5>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="table-responsive">
                        <table class="table table-minimal align-middle mb-0">
                            <thead>
                                <tr>
                                    <th scope="col">Nama Tugas</th>
                                    <th scope="col">Prioritas</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Batas waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentTasks ?? [] as $task)
                                    <tr>
                                        <td class="fw-medium text-dark">{{ $task->title }}</td>
                                        <td>
                                            <span class="badge-minimal bg-light text-dark text-capitalize">
                                                {{ $task->priority }}
                                            </span>
                                        </td>
                                        <td>
                                            @if ($task->status)
                                                <span class="badge-minimal bg-success-minimal text-success-text">
                                                    Completed
                                                </span>
                                            @else
                                                <span class="badge-minimal bg-warning-minimal text-warning-text">
                                                    Pending
                                                </span>
                                            @endif
                                        </td>
                                        <td class="text-secondary text-sm">{{ $task->deadline }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="text-center py-5 text-muted small">
                                            <i class="bi bi-inbox fs-4 d-block mb-2 text-secondary opacity-50"></i>
                                            Tidak ditemukan tugas aktif dalam proyek ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Workspace Progress Tracker -->
        <div class="col-lg-4">
            <div class="card border-0 content-card-minimal h-100">
                <div class="card-header bg-transparent border-0 pt-4 px-4 pb-2">
                    <h5 class="fw-bold text-dark tracking-tight mb-0">Kinerja Secara Keseluruhan</h5>
                </div>
                <div class="card-body p-4 d-flex flex-column justify-content-between">
                    <div>
                        <div class="d-flex align-items-baseline gap-2 mb-2">
                            <h1 class="display-4 fw-bold text-dark tracking-tight mb-0">
                                {{ $progress ?? 0 }}%
                            </h1>
                            <span class="text-secondary small fw-medium">Selesai</span>
                        </div>
                        <p class="text-muted text-sm mb-4">
                            Skor indikator kinerja individu global Anda yang dihitung berdasarkan item yang telah
                            diselesaikan.
                        </p>
                    </div>

                    <div class="progress progress-minimal">
                        <div class="progress-bar bg-dark" role="progressbar" style="width: {{ $progress ?? 0 }}%;"
                            aria-valuenow="{{ $progress ?? 0 }}" aria-valuemin="0" aria-valuemax="100">
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

@push('styles')
    <style>
        /* Utility styles untuk UI minimalis modern */
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
            font-size: 0.675rem;
        }

        /* Banner selamat datang tipis */
        .welcome-hero {
            padding: 0.5rem 0;
        }

        .current-date-badge {
            background-color: #ffffff;
            border: 1px solid #e2e8f0;
            padding: 0.5rem 0.875rem;
            border-radius: 6px;
        }

        /* Kartu metrik statistika minimalis */
        .stat-card-minimal {
            background-color: #ffffff;
            border: 1px solid #f1f5f9 !important;
            border-radius: 10px;
            transition: border-color 0.2s ease;
        }

        .stat-card-minimal:hover {
            border-color: #cbd5e1 !important;
        }

        .stat-icon-minimal {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            color: #64748b;
        }

        /* Variasi warna ikon minimalis (tidak mencolok) */
        .text-success-minimal {
            color: #16a34a;
            background-color: #f0fdf4;
        }

        .text-warning-minimal {
            color: #d97706;
            background-color: #fffbeb;
        }

        .text-danger-minimal {
            color: #dc2626;
            background-color: #fef2f2;
        }

        /* Container card konten utama */
        .content-card-minimal {
            background-color: #ffffff;
            border: 1px solid #f1f5f9 !important;
            border-radius: 12px;
        }

        /* Struktur tabel borderless modern */
        .table-minimal {
            width: 100%;
        }

        .table-minimal thead th {
            font-size: 0.75rem;
            font-weight: 600;
            text-uppercase: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            border-bottom: 1px solid #f1f5f9;
            padding: 0.75rem 0.5rem;
            background-color: transparent;
        }

        .table-minimal tbody td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.875rem;
        }

        .table-minimal tbody tr:last-child td {
            border-bottom: none;
        }

        /* Lencana (Badges) Minimalis Baru */
        .badge-minimal {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            font-weight: 600;
            border-radius: 4px;
            letter-spacing: -0.01em;
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

        /* Progress Bar Baru */
        .progress-minimal {
            height: 6px !important;
            background-color: #f1f5f9;
            border-radius: 100px;
            overflow: hidden;
        }

        .progress-minimal .progress-bar {
            border-radius: 100px;
            background-color: #0f172a !important;
            /* Progress bar hitam solid premium */
        }

        /* Animasi Transisi Halus */
        .animate-fade-in {
            animation: dashFadeIn 0.3s ease-out;
        }

        @keyframes dashFadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush
