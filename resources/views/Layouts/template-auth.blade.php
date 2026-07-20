<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title') | RanmaTask</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="bg-light">

    <div class="container-fluid">

        <div class="row min-vh-100">

            <!-- Left Side -->
            <div
                class="col-lg-6 d-none d-lg-flex
                    align-items-center
                    justify-content-center
                    bg-primary
                    text-white">

                <div class="text-center px-5">

                    <h1 class="display-4 fw-bold">
                        ✓ RanmaTask
                    </h1>

                    <p class="lead mt-4">
                        Organize your daily tasks easily,
                        stay productive,
                        and never miss your important work.
                    </p>

                    <img src="{{ asset('images/auth-illustration.svg') }}" class="img-fluid mt-5"
                        style="max-height:350px;" alt="Illustration">

                </div>

            </div>

            <!-- Right Side -->
            <div class="col-lg-6 d-flex align-items-center justify-content-center">

                <div class="w-100" style="max-width:450px;">

                    @yield('content')

                </div>

            </div>

        </div>

    </div>

</body>

</html>
