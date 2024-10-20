@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Guía de Remisión / </span> Recepción
        </h4>
        <div class="row">
            <!-- User Sidebar -->
            <div class="col-xl-3 col-lg-5 col-md-5 order-1 order-md-0">
                <!-- User Card -->
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="pb-3 border-bottom mb-3">Detalles</h5>
                        <div class="info-container">
                            <ul class="list-unstyled mb-4">
                                <li class="mb-3">
                                    <span class="fw-medium text-heading me-2">Nombres y Apellidos:</span>
                                </li>
                                <li class="mb-3">
                                    <span>{{ $reception->last_name }} {{ $reception->first_name }}</span>
                                </li>
                                <li class="mb-3">
                                    <span
                                        class="fw-medium text-heading me-2">{{ $reception->sunatTypeDocument->name_doc }}:</span>
                                    <span>{{ $reception->document_number }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium text-heading me-2">Condición:</span>
                                    <span class="badge bg-label-success rounded-pill">{{ $reception->condition }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium text-heading me-2">Número Celular:</span>
                                    <span>{{ $reception->phone_number }}</span>
                                </li>
                                <li class="mb-3">
                                    <span class="fw-medium text-heading me-2">Observaciones:</span>
                                </li>
                                <li class="mb-3">
                                    <span>{{ $reception->observation }}</span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /User Card -->
            </div>
            <!--/ User Sidebar -->

            <!-- User Content -->
            <div class="col-xl-9 col-lg-7 col-md-7 order-0 order-md-1">

                <!-- Activity Timeline -->
                <div class="card mb-4">
                    <h5 class="card-header">Imagenes Adjuntos</h5>
                    <div class="card-body pb-0 pt-3">
                        <div class="col-12 mb-4">
                            <div class="swiper text-white" id="swiper-3d-coverflow-effect">
                                <div class="swiper-wrapper">
                                    @foreach ($imgReception as $image)
                                        <div class="swiper-slide"
                                            style="background-image:url({{ asset('storage/' . $image->image_path) }})">
                                            <!-- Puedes añadir contenido adicional dentro del slide si es necesario -->
                                        </div>
                                    @endforeach
                                </div>
                                <div class="swiper-pagination"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Activity Timeline -->
            </div>
            <!--/ User Content -->
        </div>
    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/swiper/swiper.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/css/pages/ui-carousel.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('vendor/libs/swiper/swiper.js') }}"></script>

    <script src="{{ asset('js/ui-carousel.js') }}"></script>
@endsection
