<footer class="footer bg-white border-top mt-auto">

    <div class="container-fluid p-0">

        <div class="row align-items-center py-3.5 g-0">

            <!-- Copyright Area -->
            <div class="col-md-6 text-center text-md-start">

                <span class="text-secondary extra-small">
                    &copy; {{ date('Y') }} <span class="fw-medium text-dark">RanmaTask</span>. Seluruh hak dilindungi undang-undang.
                </span>

            </div>

            <!-- Meta Tech & Version Details -->
            <div class="col-md-6 text-center text-md-end mt-2 mt-md-0">

                <span
                    class="text-secondary extra-small d-inline-flex align-items-center justify-content-center justify-content-md-end gap-1">

                    <i class="bi bi-code-slash me-0.5 text-muted"></i>
                    Dibuat dengan
                    <span class="fw-medium text-dark">Laravel</span>
                    &
                    <span class="fw-medium text-dark">Bootstrap 5</span>

                    <span class="text-muted mx-1.5">&bull;</span>

                    <span class="version-badge">
                        v1.0.0
                    </span>

                </span>

            </div>

        </div>

    </div>

</footer>

<style>
    .footer {
        width: 100%;
        background-color: #ffffff;
        border-top: 1px solid #f1f5f9 !important;
        /* Menggunakan border ultra-tipis */
        padding: 0 1.5rem;
    }

    /* Ukuran teks minimalis dan clean */
    .footer .extra-small {
        font-size: 0.8rem;
        letter-spacing: -0.01em;
    }

    /* Lencana Versi Monokromatik Premium */
    .footer .version-badge {
        font-size: 0.7rem;
        font-weight: 600;
        color: #475569;
        background-color: #f1f5f9;
        padding: 0.2rem 0.5rem;
        border-radius: 4px;
        letter-spacing: 0;
        display: inline-block;
    }

    @media (max-width: 991px) {
        .footer {
            padding: 0 0.5rem;
        }
    }
</style>
