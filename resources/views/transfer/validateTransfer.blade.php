<!DOCTYPE html>

<html lang="en" class="light-style layout-wide customizer-hide" dir="ltr" data-theme="theme-default"
    data-assets-path="{{ asset('') }}" data-template="vertical-menu-template">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>
        Brolem | Validar Guia
    </title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
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

    <link rel="stylesheet" href="{{ asset('vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/typeahead-js/typeahead.css') }}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/bs-stepper/bs-stepper.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-select/bootstrap-select.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/select2/select2.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/%40form-validation/umd/styles/index.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('vendor/libs/dropzone/dropzone.css') }}">

    <!-- Page CSS -->

    <!-- Page -->
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/page-auth.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('vendor/js/helpers.js') }}"></script>

    <script src="{{ asset('vendor/js/template-customizer.js') }}"></script>
    <script src="{{ asset('js/config.js') }}"></script>
</head>

<body>
    <!-- Content -->

    <div class="authentication-wrapper authentication-cover">
        <!-- Logo -->
        <a href="#" class="auth-cover-brand d-flex align-items-center gap-2">
            <span class="app-brand-logo demo">
                <span style="color: var(--bs-primary)">
                    <svg width="268" height="150" viewbox="0 0 38 20" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M30.0944 2.22569C29.0511 0.444187 26.7508 -0.172113 24.9566 0.849138C23.1623 1.87039 22.5536 4.14247 23.5969 5.92397L30.5368 17.7743C31.5801 19.5558 33.8804 20.1721 35.6746 19.1509C37.4689 18.1296 38.0776 15.8575 37.0343 14.076L30.0944 2.22569Z"
                            fill="currentColor"></path>
                        <path
                            d="M30.171 2.22569C29.1277 0.444187 26.8274 -0.172113 25.0332 0.849138C23.2389 1.87039 22.6302 4.14247 23.6735 5.92397L30.6134 17.7743C31.6567 19.5558 33.957 20.1721 35.7512 19.1509C37.5455 18.1296 38.1542 15.8575 37.1109 14.076L30.171 2.22569Z"
                            fill="url(#paint0_linear_2989_100980)" fill-opacity="0.4"></path>
                        <path
                            d="M22.9676 2.22569C24.0109 0.444187 26.3112 -0.172113 28.1054 0.849138C29.8996 1.87039 30.5084 4.14247 29.4651 5.92397L22.5251 17.7743C21.4818 19.5558 19.1816 20.1721 17.3873 19.1509C15.5931 18.1296 14.9843 15.8575 16.0276 14.076L22.9676 2.22569Z"
                            fill="currentColor"></path>
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="currentColor"></path>
                        <path
                            d="M14.9558 2.22569C13.9125 0.444187 11.6122 -0.172113 9.818 0.849138C8.02377 1.87039 7.41502 4.14247 8.45833 5.92397L15.3983 17.7743C16.4416 19.5558 18.7418 20.1721 20.5361 19.1509C22.3303 18.1296 22.9391 15.8575 21.8958 14.076L14.9558 2.22569Z"
                            fill="url(#paint1_linear_2989_100980)" fill-opacity="0.4"></path>
                        <path
                            d="M7.82901 2.22569C8.87231 0.444187 11.1726 -0.172113 12.9668 0.849138C14.7611 1.87039 15.3698 4.14247 14.3265 5.92397L7.38656 17.7743C6.34325 19.5558 4.04298 20.1721 2.24875 19.1509C0.454514 18.1296 -0.154233 15.8575 0.88907 14.076L7.82901 2.22569Z"
                            fill="currentColor"></path>
                        <defs>
                            <lineargradient id="paint0_linear_2989_100980" x1="5.36642" y1="0.849138" x2="10.532"
                                y2="24.104" gradientunits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1"></stop>
                                <stop offset="1" stop-opacity="0"></stop>
                            </lineargradient>
                            <lineargradient id="paint1_linear_2989_100980" x1="5.19475" y1="0.849139" x2="10.3357"
                                y2="24.1155" gradientunits="userSpaceOnUse">
                                <stop offset="0" stop-opacity="1"></stop>
                                <stop offset="1" stop-opacity="0"></stop>
                            </lineargradient>
                        </defs>
                    </svg>
                </span>
            </span>
            <span class="app-brand-text demo text-heading fw-bold">Brolem</span>
        </a>
        <div class="authentication-inner row m-0">
            <div class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 mt-5 mt-xxl-0">
                <img alt="register-multi-steps-illustration"
                    src="{{ asset('img/illustrations/auth-register-multi-steps-illustration.png') }}"
                    class="h-auto mh-100 w-px-200" />
            </div>

            <div class="d-flex col-lg-8 align-items-center justify-content-center authentication-bg p-5">
                <div class="w-px-700 mt-5 mt-lg-0">
                    <div id="multiStepsValidation" class="bs-stepper wizard-numbered">
                        <div class="bs-stepper-header border-bottom-0">
                            <div class="line"></div>
                            <div class="step" data-target="#personalInfoValidation">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">01</span>
                                        <span class="d-flex flex-column gap-1 ms-2">
                                            <span class="bs-stepper-title">Personal</span>
                                            <span class="bs-stepper-subtitle">Ingrese Información</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                            <div class="step" data-target="#accountDetailsValidation">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">02</span>
                                        <span class="d-flex flex-column gap-1 ms-2">
                                            <span class="bs-stepper-title">Recepción</span>
                                            <span class="bs-stepper-subtitle">Estado recepción</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                            <div class="line"></div>
                            <div class="step" data-target="#billingLinksValidation">
                                <button type="button" class="step-trigger">
                                    <span class="bs-stepper-circle"><i class="mdi mdi-check"></i></span>
                                    <span class="bs-stepper-label">
                                        <span class="bs-stepper-number">03</span>
                                        <span class="d-flex flex-column gap-1 ms-2">
                                            <span class="bs-stepper-title">Imagenes</span>
                                            <span class="bs-stepper-subtitle">Evidencias imagen</span>
                                        </span>
                                    </span>
                                </button>
                            </div>
                        </div>
                        <div class="bs-stepper-content">
                            <form id="multiStepsForm" onsubmit="return false" enctype="multipart/form-data">
                                <input type="hidden" name="idG" value="{{$guide->id}}">
                                <!-- Personal Info -->
                                <div id="personalInfoValidation" class="content">
                                    <div class="content-header mb-3">
                                        <h4 class="mb-0">Información personal</h4>
                                        <small>Ingrese su información personal</small>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <select id="document_type" name="document_type"
                                                    class="select2 form-select" data-allow-clear="true">
                                                    @foreach ($documents as $doc)
                                                        <option value="{{ $doc->id_doc }}">{{ $doc->name_doc }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="document_type">Tipo de Documento</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="document_number" name="document_number"
                                                    class="form-control" placeholder="00000000" />
                                                <label for="document_number">Número de Documento</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="lastname" name="lastname"
                                                    class="form-control" placeholder="Apellidos" />
                                                <label for="lastname">Apellidos</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="firstname" name="firstname"
                                                    class="form-control" placeholder="Nombres" />
                                                <label for="firstname">Nombres</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="input-group input-group-merge">
                                                <span class="input-group-text">(+51)</span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" id="phone_number" name="phone_number"
                                                        class="form-control multi-steps-mobile"
                                                        placeholder="932 265 454" />
                                                    <label for="phone_number">Número Celular</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-secondary btn-prev" disabled="">
                                                <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                            </button>
                                            <button class="btn btn-primary btn-next">
                                                <span
                                                    class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Siguiente</span>
                                                <i class="mdi mdi-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Account Details -->
                                <div id="accountDetailsValidation" class="content">
                                    <div class="content-header mb-3">
                                        <h4 class="mb-0">Recepción</h4>
                                        <small>Ingresa el estado recepción</small>
                                    </div>
                                    <div class="row g-3">
                                        <div class="col-sm-12">
                                            <div class="form-floating form-floating-outline">
                                                <select id="condition" name="condition" class="select2 form-select"
                                                    data-allow-clear="true">
                                                    <option value="Bueno">Bueno</option>
                                                    <option value="Dañado">Dañado</option>
                                                    <option value="Incompleto">Incompleto</option>
                                                </select>
                                                <label for="condition">Condición</label>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-floating form-floating-outline">
                                                <textarea class="form-control" rows="3" id="observation" name="observation"></textarea>
                                                <label for="observation">Observaciones aqui</label>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-secondary btn-prev">
                                                <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                            </button>
                                            <button class="btn btn-primary btn-next">
                                                <span
                                                    class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Siguiente</span>
                                                <i class="mdi mdi-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <!-- Billing Links -->
                                <div id="billingLinksValidation" class="content">

                                    <!--/ Custom plan options -->
                                    <div class="content-header mb-3">
                                        <h4 class="mb-0">Iamgenes</h4>
                                        <small>Guarda evidencia de recepción</small>
                                    </div>
                                    <!-- Credit Card Details -->
                                    <div class="row g-3">
                                        <div class="col-md-12  mb-3">
                                            <div class="input-group">
                                                <input type="file" class="form-control form-control-lg"
                                                    multiple="multiple" id="imgsReception" name="imgsReception[]"
                                                    aria-describedby="inputGroupFileAddon04" aria-label="Upload">
                                                <button class="btn btn-outline-primary" type="button"
                                                    id="inputGroupFileAddon04"><i
                                                        class="mdi mdi-cloud-upload fs-3"></i></button>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-between">
                                            <button class="btn btn-secondary btn-prev">
                                                <i class="mdi mdi-arrow-left me-sm-1 me-0"></i>
                                                <span class="align-middle d-sm-inline-block d-none">Anterior</span>
                                            </button>
                                            <button type="submit" class="btn btn-primary btn-next btn-submit">
                                                Guardar Recepción
                                            </button>
                                        </div>
                                    </div>
                                    <!--/ Credit Card Details -->
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- / Multi Steps Registration -->
        </div>
    </div>

    <script>
        window.Helpers.initCustomOptionCheck();
    </script>

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

    <!-- Vendors JS -->
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('vendor/libs/bs-stepper/bs-stepper.js') }}"></script>
    <script src="{{ asset('vendor/libs/select2/select2.js') }}"></script>
    <script src="{{ asset('vendor/libs/block-ui/block-ui.js') }}"></script>
    <script src="{{ asset('vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('vendor/libs/%40form-validation/umd/bundle/popular.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/%40form-validation/umd/plugin-bootstrap5/index.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/pages-auth-multisteps.js') }}"></script>
</body>

</html>

<!-- beautify ignore:end -->
