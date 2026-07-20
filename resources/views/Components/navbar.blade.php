<nav class="navbar navbar-expand-lg bg-white border-bottom px-4 py-3">

    <div class="container-fluid p-0">

        <!-- Left Side: Title & Mobile Toggle -->
        <div class="d-flex align-items-center">

            <!-- Toggle Sidebar (Mobile) -->
            <button class="btn btn-minimal d-lg-none me-3" id="sidebarToggle" aria-label="Toggle Sidebar">
                <i class="bi bi-list fs-4"></i>
            </button>

            <div class="d-flex flex-column">
                <h4 class="fw-bold text-dark tracking-tight mb-0">
                    @yield('title')
                </h4>
                <span class="text-muted small mt-0.5 d-none d-sm-inline">
                    Selamat datang kembali, {{ Auth::user()->name }}
                </span>
            </div>

        </div>

        <!-- Right Side: User Dropdown Menu -->
        <div class="d-flex align-items-center">

            <div class="dropdown">

                <a href="#" class="d-flex align-items-center text-decoration-none custom-dropdown-toggle"
                    data-bs-toggle="dropdown" aria-expanded="false">

                    <!-- Minimalist Initials Avatar -->
                    <div class="avatar-minimal me-2">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </div>

                    <!-- Meta Data User (Desktop Only) -->
                    <div class="d-none d-md-block text-start me-1">
                        <h6 class="mb-0 fw-semibold text-dark text-sm">
                            {{ Auth::user()->name }}
                        </h6>
                        <span class="text-muted extra-small d-block">
                            {{ Auth::user()->email }}
                        </span>
                    </div>

                </a>

                <!-- Dropdown Menu List -->
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-minimal mt-2 animate-fade-in">

                    <li class="d-md-none">
                        <div class="px-3 py-2.5 bg-light rounded-top-2">
                            <h6 class="mb-0 fw-semibold text-dark text-sm">{{ Auth::user()->name }}</h6>
                            <span class="text-muted extra-small">{{ Auth::user()->email }}</span>
                        </div>
                    </li>

                    <li>
                        <a href="#" class="dropdown-item">
                            <i class="bi bi-person me-2.5"></i>
                            <span>Profile</span>
                        </a>
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                <i class="bi bi-box-arrow-right me-2.5"></i>
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>

<style>
    .navbar {
        height: 72px;
        /* Sedikit lebih ramping untuk efisiensi layar */
        background-color: #ffffff;
        border-bottom: 1px solid #f1f5f9 !important;
    }

    .tracking-tight {
        letter-spacing: -0.025em;
    }

    .extra-small {
        font-size: 0.75rem;
    }

    .text-sm {
        font-size: 0.875rem;
    }

    /* Button Hamburger Mobile Minimalis */
    .btn-minimal {
        border: none;
        background: transparent;
        padding: 0.25rem;
        color: #0f172a;
        box-shadow: none !important;
    }

    /* Avatar Minimalis Baru */
    .avatar-minimal {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background-color: #f1f5f9;
        color: #0f172a;
        font-weight: 600;
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        justify-content: center;
        letter-spacing: 0;
    }

    /* Kustomisasi Dropdown Trigger */
    .custom-dropdown-toggle {
        color: inherit;
        transition: opacity 0.2s ease;
    }

    .custom-dropdown-toggle:hover {
        opacity: 0.85;
    }

    .custom-dropdown-toggle::after {
        display: inline-block;
        margin-left: 0.5rem;
        vertical-align: middle;
        content: "";
        border-top: 0.3em solid;
        border-right: 0.3em solid transparent;
        border-bottom: 0;
        border-left: 0.3em solid transparent;
        color: #64748b;
    }

    /* Menu Dropdown Minimalis Premium */
    .dropdown-menu-minimal {
        min-width: 200px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
        /* Bayangan sangat tipis */
        padding: 0.375rem;
    }

    .dropdown-menu-minimal .dropdown-item {
        padding: 0.5rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
        color: #475569;
        border-radius: 6px;
        display: flex;
        align-items: center;
        transition: all 0.15s ease;
    }

    .dropdown-menu-minimal .dropdown-item i {
        font-size: 1rem;
        color: #64748b;
    }

    .dropdown-menu-minimal .dropdown-item:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .dropdown-menu-minimal .dropdown-item:hover i {
        color: #0f172a;
    }

    /* State Hover Khusus Logout */
    .dropdown-menu-minimal .dropdown-item.text-danger:hover {
        background-color: #fef2f2;
        color: #991b1b !important;
    }

    .dropdown-menu-minimal .dropdown-item.text-danger:hover i {
        color: #991b1b !important;
    }

    /* Animasi Transisi Halus */
    .animate-fade-in {
        animation: navFadeIn 0.2s ease-out;
    }

    @keyframes navFadeIn {
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

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("sidebarToggle");
        const sidebar = document.querySelector(".sidebar");

        if (toggle && sidebar) {
            toggle.addEventListener("click", function(e) {
                e.stopPropagation();
                if (sidebar.style.left === "0px") {
                    sidebar.style.left = "-260px";
                } else {
                    sidebar.style.left = "0px";
                }
            });

            // Klik di luar area sidebar otomatis menutup menu pada device mobile
            document.addEventListener("click", function(e) {
                if (window.innerWidth <= 991 && sidebar.style.left === "0px") {
                    if (!sidebar.contains(e.target) && e.target !== toggle) {
                        sidebar.style.left = "-260px";
                    }
                }
            });
        }
    });
</script>
