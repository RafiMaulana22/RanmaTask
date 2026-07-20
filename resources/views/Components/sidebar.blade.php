<aside class="sidebar">

    <!-- Logo & Branding -->
    <div class="sidebar-header">

        <a href="{{ route('dashboard') }}" class="sidebar-brand text-decoration-none">

            <div class="brand-icon">
                <i class="bi bi-check2-square"></i>
            </div>

            <div class="brand-text">
                <h5 class="mb-0 fw-bold tracking-tight text-dark">RanmaTask</h5>
                <span
                    class="text-muted tracking-wide text-uppercase extra-small fw-semibold mt-0.5 d-block">Ruang Kerja</span>
            </div>

        </a>

    </div>

    <!-- Navigation Menu -->
    <div class="sidebar-menu">

        <span class="menu-title">
            Menu Utama
        </span>

        <ul class="nav flex-column mt-2 mb-4">

            <li class="nav-item mb-1">

                <a href="{{ route('dashboard') }}"
                    class="nav-link-minimal {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                    <i class="bi bi-grid-1x2"></i>

                    <span>Dashboard</span>

                </a>

            </li>

            <li class="nav-item mb-1">

                <a href="{{ route('tasks.index') }}"
                    class="nav-link-minimal {{ request()->routeIs('tasks.*') ? 'active' : '' }}">

                    <i class="bi bi-list-check"></i>

                    <span>My Tasks</span>

                </a>

            </li>

        </ul>

        <span class="menu-title">
            Akun
        </span>

        <ul class="nav flex-column mt-2">

            <li class="nav-item mb-1">

                <a href="#" class="nav-link-minimal">

                    <i class="bi bi-person-circle"></i>

                    <span>Profile</span>

                </a>

            </li>

        </ul>

    </div>

</aside>

<style>
    .sidebar {
        position: fixed;
        top: 0;
        left: 0;
        width: 260px;
        height: 100vh;
        background-color: #fafafa;
        /* Menyatu rapi dengan background dasar admin */
        border-right: 1px solid #f1f5f9;
        display: flex;
        flex-direction: column;
        z-index: 1000;
        letter-spacing: -0.01em;
    }

    .sidebar-header {
        padding: 2rem 1.5rem 1.5rem;
    }

    .sidebar-brand {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    /* Ikon Brand Minimalis Baru */
    .brand-icon {
        width: 38px;
        height: 38px;
        border-radius: 8px;
        background-color: #0f172a;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 1.15rem;
    }

    .tracking-tight {
        letter-spacing: -0.02em;
    }

    .tracking-wide {
        letter-spacing: 0.05em;
    }

    .extra-small {
        font-size: 0.65rem;
    }

    .sidebar-menu {
        padding: 1rem 1rem 2rem;
        overflow-y: auto;
        flex: 1;
    }

    /* Kategori Menu dengan Desain Elegan */
    .menu-title {
        display: block;
        padding-left: 0.75rem;
        font-size: 0.725rem;
        font-weight: 600;
        color: #94a3b8;
    }

    /* Tombol Navigasi Minimalis */
    .nav-link-minimal {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.625rem 0.75rem;
        border-radius: 6px;
        color: #475569;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .nav-link-minimal i {
        font-size: 1.05rem;
        color: #64748b;
        transition: color 0.2s ease;
    }

    /* Efek Interaksi Aksen Terbatas */
    .nav-link-minimal:hover {
        background-color: #f1f5f9;
        color: #0f172a;
    }

    .nav-link-minimal:hover i {
        color: #0f172a;
    }

    /* State Active Monokromatik Premium */
    .nav-link-minimal.active {
        background-color: #e2e8f0;
        color: #0f172a;
        font-weight: 600;
    }

    .nav-link-minimal.active i {
        color: #0f172a;
    }

    /* State Khusus Logout */
    .nav-link-minimal.text-danger:hover {
        background-color: #fef2f2;
        color: #991b1b !important;
    }

    .nav-link-minimal.text-danger:hover i {
        color: #991b1b !important;
    }

    @media (max-width: 991px) {
        .sidebar {
            left: -260px;
        }
    }
</style>
