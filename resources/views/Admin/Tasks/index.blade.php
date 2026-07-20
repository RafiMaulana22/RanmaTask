@extends('Layouts.template-admin') {{-- Disesuaikan dengan nama file layout utama admin Anda --}}

@section('title', 'My Tasks')

@section('content')

    <!-- Header Area -->
    <div
        class="d-flex flex-column flex-sm-row justify-content-between align-items-start align-items-sm-center mb-5 gap-3 animate-fade-in">
        <div>
            <h3 class="fw-bold text-dark tracking-tight mb-1">My Tasks</h3>
            <p class="text-secondary mb-0 text-sm">Kelola, buat, dan saring item ruang kerja aktif Anda secara efisien.</p>
        </div>
        <button class="btn btn-dark py-2 px-3 fw-medium minimal-btn" data-bs-toggle="modal" data-bs-target="#createTaskModal">
            <i class="bi bi-plus-lg me-1.5"></i>
            Tambahkan Tugas Baru
        </button>
    </div>

    <!-- Metrics Grid -->
    <div class="row g-4 mb-5">
        <!-- Total Tasks -->
        <div class="col-md-4">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Jumlah Tugas</span>
                            <h3 class="fw-bold tracking-tight text-dark mt-2 mb-0">{{ $tasks->count() }}</h3>
                        </div>
                        <div class="stat-icon-minimal">
                            <i class="bi bi-list-check"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Completed Tasks -->
        <div class="col-md-4">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Selesai</span>
                            <h3 class="fw-bold tracking-tight text-dark mt-2 mb-0">
                                {{ $tasks->where('status', 'Completed')->count() }}</h3>
                        </div>
                        <div class="stat-icon-minimal text-success-minimal">
                            <i class="bi bi-check-circle"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Tasks -->
        <div class="col-md-4">
            <div class="card border-0 stat-card-minimal">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <span class="text-muted text-uppercase tracking-wider extra-small fw-semibold">Sedang diproses</span>
                            <h3 class="fw-bold tracking-tight text-dark mt-2 mb-0">
                                {{ $tasks->where('status', 'Pending')->count() }}</h3>
                        </div>
                        <div class="stat-icon-minimal text-warning-minimal">
                            <i class="bi bi-clock"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                        <span class="fw-semibold">Please fix the following:</span>
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

    <!-- Data Panel List Table -->
    <div class="card border-0 content-card-minimal">
        <div class="card-header bg-transparent border-0 pt-4 px-4 pb-3">
            <div class="row align-items-center g-3">
                <div class="col-sm-6">
                    <h5 class="fw-bold text-dark tracking-tight mb-0">Daftar Tugas</h5>
                </div>
                <div class="col-sm-6">
                    <div class="position-relative">
                        <i
                            class="bi bi-search position-absolute top-50 start-0 translate-middle-y text-muted ms-3 small"></i>
                        <input type="text" class="form-control search-input-minimal" id="searchTask"
                            placeholder="Search tasks...">
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-minimal align-middle mb-0">
                    <thead>
                        <tr>
                            <th scope="col" width="6%">#</th>
                            <th scope="col">Konteks Tugas</th>
                            <th scope="col" width="12%">Prioritas</th>
                            <th scope="col" width="12%">Status</th>
                            <th scope="col" width="15%">Batas waktu</th>
                            <th scope="col" width="15%" class="text-end">Tindakan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td class="text-secondary small">{{ $loop->iteration }}</td>
                                <td>
                                    <span class="fw-semibold text-dark d-block mb-0.5">{{ $task->title }}</span>
                                    @if ($task->description)
                                        <span class="text-muted extra-small d-block text-truncate"
                                            style="max-width: 320px;">
                                            {{ Str::limit($task->description, 60) }}
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    @if ($task->priority == 'High')
                                        <span class="badge-minimal bg-danger-minimal text-danger-text">Tinggi</span>
                                    @elseif($task->priority == 'Medium')
                                        <span class="badge-minimal bg-warning-minimal text-warning-text">Sedang</span>
                                    @else
                                        <span class="badge-minimal bg-success-minimal text-success-text">Rendah</span>
                                    @endif
                                </td>
                                <td>
                                    @if ($task->status == 'Completed')
                                        <span class="badge-minimal bg-success-minimal text-success-text">Selesai</span>
                                    @else
                                        <span class="badge-minimal bg-light text-secondary">Sedang Diproses</span>
                                    @endif
                                </td>
                                <td class="text-secondary text-sm">
                                    {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d M Y') : '-' }}
                                </td>
                                <td class="text-end">
                                    <div class="d-inline-flex gap-1">
                                        <button class="btn btn-action-minimal" data-bs-toggle="modal"
                                            data-bs-target="#showTask{{ $task->id }}" title="View details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-action-minimal" data-bs-toggle="modal"
                                            data-bs-target="#editTask{{ $task->id }}" title="Edit item">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-action-minimal btn-action-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteTask{{ $task->id }}" title="Delete item">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>

                            <!-- MODAL EDIT TASK -->
                            <div class="modal fade" id="editTask{{ $task->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content modal-custom-minimal">
                                        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header border-0 pt-4 px-4 pb-2">
                                                <h5 class="fw-bold text-dark tracking-tight mb-0">Edit Task</h5>
                                                <button type="button" class="btn-close small" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body px-4 py-3">
                                                <div class="mb-3">
                                                    <label class="form-label text-dark small fw-medium mb-2">Title <span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" name="title"
                                                        class="form-control form-input-minimal"
                                                        value="{{ $task->title }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label
                                                        class="form-label text-dark small fw-medium mb-2">Description</label>
                                                    <textarea name="description" class="form-control form-input-minimal" rows="3" placeholder="Task details...">{{ $task->description }}</textarea>
                                                </div>
                                                <div class="row g-3">
                                                    <div class="col-md-6">
                                                        <label
                                                            class="form-label text-dark small fw-medium mb-2">Priority</label>
                                                        <select name="priority" class="form-select form-input-minimal">
                                                            <option value="Low"
                                                                {{ $task->priority == 'Low' ? 'selected' : '' }}>Low
                                                            </option>
                                                            <option value="Medium"
                                                                {{ $task->priority == 'Medium' ? 'selected' : '' }}>Medium
                                                            </option>
                                                            <option value="High"
                                                                {{ $task->priority == 'High' ? 'selected' : '' }}>High
                                                            </option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label
                                                            class="form-label text-dark small fw-medium mb-2">Status</label>
                                                        <select name="status" class="form-select form-input-minimal">
                                                            <option value="Pending"
                                                                {{ $task->status == 'Pending' ? 'selected' : '' }}>Pending
                                                            </option>
                                                            <option value="Completed"
                                                                {{ $task->status == 'Completed' ? 'selected' : '' }}>
                                                                Completed</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-12">
                                                        <label
                                                            class="form-label text-dark small fw-medium mb-2">Deadline</label>
                                                        <input type="date" name="deadline"
                                                            value="{{ optional($task->deadline)->format('Y-m-d') }}"
                                                            class="form-control form-input-minimal">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer border-0 px-4 pb-4 pt-2">
                                                <button type="button" class="btn btn-light px-3 py-2 fw-medium btn-sm"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <button type="submit"
                                                    class="btn btn-dark px-3 py-2 fw-medium btn-sm minimal-btn">Save
                                                    Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL DETAIL TASK -->
                            <div class="modal fade" id="showTask{{ $task->id }}" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content modal-custom-minimal">
                                        <div class="modal-header border-0 pt-4 px-4 pb-2">
                                            <h5 class="fw-bold text-dark tracking-tight mb-0">Pemeriksaan Tugas</h5>
                                            <button type="button" class="btn-close small" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body px-4 py-3">
                                            <div class="pb-3 border-bottom mb-3">
                                                <span
                                                    class="text-muted extra-small fw-semibold text-uppercase tracking-wider">Judul</span>
                                                <h6 class="text-dark fw-bold mt-1 mb-0">{{ $task->title }}</h6>
                                            </div>
                                            <div class="pb-3 border-bottom mb-3">
                                                <span
                                                    class="text-muted extra-small fw-semibold text-uppercase tracking-wider">Deskripsi</span>
                                                <p class="text-dark small mt-1 mb-0 lh-base text-break">
                                                    {{ $task->description ?: '-' }}</p>
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-6">
                                                    <span
                                                        class="text-muted extra-small fw-semibold text-uppercase tracking-wider d-block mb-1">Prioritas</span>
                                                    @if ($task->priority == 'High')
                                                        <span
                                                            class="badge-minimal bg-danger-minimal text-danger-text">Tinggi</span>
                                                    @elseif($task->priority == 'Medium')
                                                        <span
                                                            class="badge-minimal bg-warning-minimal text-warning-text">Sedang</span>
                                                    @else
                                                        <span
                                                            class="badge-minimal bg-success-minimal text-success-text">Rendah</span>
                                                    @endif
                                                </div>
                                                <div class="col-6">
                                                    <span
                                                        class="text-muted extra-small fw-semibold text-uppercase tracking-wider d-block mb-1">Status</span>
                                                    @if ($task->status == 'Completed')
                                                        <span
                                                            class="badge-minimal bg-success-minimal text-success-text">Selesai</span>
                                                    @else
                                                        <span class="badge-minimal bg-light text-secondary">Sedang Diproses</span>
                                                    @endif
                                                </div>
                                                <div class="col-12 mt-3">
                                                    <span
                                                        class="text-muted extra-small fw-semibold text-uppercase tracking-wider d-block mb-1">Batas Waktu Target</span>
                                                    <div class="text-dark small fw-medium">
                                                        <i class="bi bi-calendar-event text-muted me-1.5"></i>
                                                        {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->translatedFormat('d F Y') : '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-0 px-4 pb-4 pt-2">
                                            <button type="button" class="btn btn-light w-100 py-2 fw-semibold btn-sm"
                                                data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- MODAL DELETE CONFIRMATION -->
                            <div class="modal fade" id="deleteTask{{ $task->id }}" tabindex="-1"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered modal-sm">
                                    <div class="modal-content modal-custom-minimal">
                                        <form action="{{ route('tasks.destroy', $task->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="modal-body text-center p-4">
                                                <div class="alert-icon-circle-danger mx-auto mb-3">
                                                    <i class="bi bi-trash"></i>
                                                </div>
                                                <h6 class="fw-bold text-dark tracking-tight mb-1">Remove Task?</h6>
                                                <p class="text-muted small mb-0">This step is permanent and cannot be
                                                    reversed.</p>
                                            </div>
                                            <div class="modal-footer border-0 justify-content-center px-4 pb-4 pt-0 gap-2">
                                                <button type="button"
                                                    class="btn btn-light px-3 py-1.5 fw-medium btn-sm flex-grow-1"
                                                    data-bs-dismiss="modal">Abort</button>
                                                <button type="submit"
                                                    class="btn btn-danger px-3 py-1.5 fw-medium btn-sm flex-grow-1">Confirm</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted small">
                                    <i class="bi bi-inbox fs-3 d-block mb-2 text-secondary opacity-50"></i>
                                    <span class="fw-semibold d-block text-dark mb-1">Ruang Kerja yang Bersih</span>
                                    Tidak ada catatan yang sesuai dengan pencarian Anda. Coba tambahkan tugas baru.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- MODAL ADD NEW TASK -->
    <div class="modal fade" id="createTaskModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content modal-custom-minimal">
                <form action="{{ route('tasks.store') }}" method="POST">
                    @csrf
                    <div class="modal-header border-0 pt-4 px-4 pb-2">
                        <h5 class="fw-bold text-dark tracking-tight mb-0">Buat Tugas</h5>
                        <button type="button" class="btn-close small" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 py-3">
                        <div class="mb-3">
                            <label class="form-label text-dark small fw-medium mb-2">Judul <span
                                    class="text-danger">*</span></label>
                            <input type="text" name="title" class="form-control form-input-minimal"
                                placeholder="Write task title..." required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label text-dark small fw-medium mb-2">Deskripsi</label>
                            <textarea name="description" rows="4" class="form-control form-input-minimal"
                                placeholder="Provide extra workflow notes..."></textarea>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-dark small fw-medium mb-2">Tingkat Prioritas</label>
                                <select name="priority" class="form-select form-input-minimal">
                                    <option value="Low">Rendah</option>
                                    <option value="Medium" selected>Sedang</option>
                                    <option value="High">Tinggi</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-dark small fw-medium mb-2">Tanggal Target</label>
                                <input type="date" name="deadline" class="form-control form-input-minimal">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer border-0 px-4 pb-4 pt-2">
                        <button type="button" class="btn btn-light px-3 py-2 fw-medium btn-sm"
                            data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-dark px-3 py-2 fw-medium btn-sm minimal-btn">Tugas Penyebaran</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        /* Core Typography Styles */
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

        /* Solid Black Main Button */
        .minimal-btn {
            background-color: #0f172a;
            border: none;
            border-radius: 6px;
            transition: background-color 0.2s ease;
        }

        .minimal-btn:hover,
        .minimal-btn:focus {
            background-color: #1e293b;
        }

        /* Metrics Card */
        .stat-card-minimal {
            background-color: #ffffff;
            border: 1px solid #f1f5f9 !important;
            border-radius: 10px;
        }

        .stat-icon-minimal {
            width: 38px;
            height: 38px;
            border-radius: 8px;
            background-color: #f8fafc;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: #64748b;
        }

        .text-success-minimal {
            color: #16a34a;
            background-color: #f0fdf4;
        }

        .text-warning-minimal {
            color: #d97706;
            background-color: #fffbeb;
        }

        /* Main Workspace Panel */
        .content-card-minimal {
            background-color: #ffffff;
            border: 1px solid #f1f5f9 !important;
            border-radius: 12px;
        }

        /* Minimalist Table Elements */
        .table-minimal thead th {
            font-size: 0.75rem;
            font-weight: 600;
            text-uppercase: uppercase;
            letter-spacing: 0.05em;
            color: #94a3b8;
            border-bottom: 1px solid #f1f5f9;
            padding: 0.85rem 0.5rem;
        }

        .table-minimal tbody td {
            padding: 1rem 0.5rem;
            border-bottom: 1px solid #f8fafc;
            font-size: 0.875rem;
        }

        .table-minimal tbody tr:last-child td {
            border-bottom: none;
        }

        /* Action Buttons Styling */
        .btn-action-minimal {
            border: none;
            background: #f8fafc;
            color: #475569;
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            transition: all 0.15s ease;
        }

        .btn-action-minimal:hover {
            background-color: #e2e8f0;
            color: #0f172a;
        }

        .btn-action-danger:hover {
            background-color: #fef2f2;
            color: #dc2626;
        }

        /* Search input bar customization */
        .search-input-minimal {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.5rem 1rem 0.5rem 2.25rem;
            font-size: 0.875rem;
            transition: all 0.2s ease;
        }

        .search-input-minimal:focus {
            background-color: #ffffff;
            border-color: #0f172a;
            box-shadow: none;
        }

        /* Modal Structure Alignment */
        .modal-custom-minimal {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        }

        .form-input-minimal {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            padding: 0.55rem 0.75rem;
            font-size: 0.875rem;
            color: #0f172a;
        }

        .form-input-minimal:focus {
            background-color: #ffffff;
            border-color: #0f172a;
            box-shadow: none;
        }

        /* Minimalist Badge Configs */
        .badge-minimal {
            display: inline-flex;
            align-items: center;
            padding: 0.25rem 0.5rem;
            font-size: 0.725rem;
            font-weight: 600;
            border-radius: 4px;
        }

        .bg-danger-minimal {
            background-color: #fef2f2;
        }

        .text-danger-text {
            color: #991b1b;
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

        /* Circle Container inside Danger Modal */
        .alert-icon-circle-danger {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: #fef2f2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        /* Minimal Alerts Elements */
        .alert-minimal {
            border: none;
            border-radius: 8px;
            padding: 0.75rem 2.5rem 0.75rem 1rem;
            margin-bottom: 1.25rem;
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

        /* Animation Keyframe */
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
            // Menutup alert sistem secara otomatis setelah 3 detik
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
