<!DOCTYPE html>


<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('') }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">

    <title>Brolem | Confirmación de Guia</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/favicon/favicon.ico') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="" />
    <link href="{{ asset('css/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap') }}" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('vendor/fonts/materialdesignicons.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/fonts/flag-icons.css') }}">

    <!-- Menu waves for no-customizer fix -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/node-waves/node-waves.css') }}">

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/core.css') }}" class="template-customizer-core-css">
    <link rel="stylesheet" href="{{ asset('vendor/css/rtl/theme-default.css') }}" class="template-customizer-theme-css">
    <link rel="stylesheet" href="{{ asset('css/demo.css') }}">

    <!-- Vendors CSS -->

    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->

    <!-- Page CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}">
    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>

</head>

<body>
    <!-- Content -->

    <div class="position-relative">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Logo -->
                <div class="card p-2">
                    <!-- Forgot Password -->
                    <div class="app-brand justify-content-center mt-5 text-center">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <center>
                                    <img src="{{ asset('img/brolemlogo.png') }}" class="img-fluid" style="width: 80%;"
                                        alt="">
                                </center>
                            </span>
                        </a>
                    </div>
                    <div class="card-body mt-2">

                        <h4 class="mb-2">¡Formulario de Recepción Completado! ✅</h4>
                        <p class="mb-4">Tu formulario de recepción ha sido completado y enviado exitosamente.
                            ¡Gracias!</p>

                    </div>
                </div>
                <!-- /Forgot Password -->
                <img alt="mask" src="{{ asset('img/illustrations/auth-basic-forgot-password-mask-light.png') }}"
                    class="authentication-image d-none d-lg-block"
                    data-app-light-img="illustrations/auth-basic-forgot-password-mask-light.png"
                    data-app-dark-img="illustrations/auth-basic-forgot-password-mask-dark.png">
            </div>
        </div>
    </div>


    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('vendor/js/menu.js') }}"></script>

    <!-- endbuild -->

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/pages-auth-multisteps.js') }}"></script>

</body>

</html>

<!-- beautify ignore:end -->
