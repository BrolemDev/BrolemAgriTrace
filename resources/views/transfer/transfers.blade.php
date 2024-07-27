@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Filtro de búsqueda</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-3">
                        <div class="form-floating form-floating-outline">
                            <input type="text" class="form-control" placeholder="YYYY-MM-DD to YYYY-MM-DD"
                                id="flatpickr-range">
                            <label for="flatpickr-range">Rango de Fechas</label>
                        </div>
                    </div>
                    <div class="col-md-3 user_role"></div>
                    <div class="col-md-3 user_plan"></div>
                    <div class="col-md-3 user_status"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-entries table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th>Fecha</th>
                            <th>Comprobante</th>
                            <th>Destinatario</th>
                            <th>Peso (KG)</th>
                            <th>PDF</th>
                            <th>Estado</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Link -->
    <div class="modal fade" id="modal-link" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body pt-3 pt-md-0 px-0 pb-md-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Enlace de Recepción</h3>
                        <p class="text-center w-75 m-auto mt-1">
                            Envia el enlace a la persona que le llegara los productos, asi informara el estado del envio.
                        </p>
                    </div>

                    <hr class="my-4 mx-n3 mx-md-n5" />

                    <h5 class="mt-4">Comparte el enlace de recepción</h5>
                    <form class="row g-3" onsubmit="return false">
                        <div class="col-lg-10">
                            <div class="input-group input-group-merge">
                                <input type="text" id="clipboard-link" class="form-control" value="" />
                                <span class="clipboard-btn input-group-text text-primary cursor-pointer"
                                    data-clipboard-action="copy" data-clipboard-target="#clipboard-link">Copiar</span>
                            </div>
                        </div>
                        <div class="col-lg-2 d-flex align-items-end">
                            <div class="btn-social">
                                <button id="whatsapp-button" class="btn btn-icon btn-primary me-2">
                                    <i class="tf-icons mdi mdi-whatsapp mdi-24px"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--/ Refer & Earn Modal -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('vendor/libs/toastr/toastr.js') }}"></script>
    <script src="{{ asset('vendor/libs/clipboard/clipboard.js') }}"></script>
    <script src="{{ asset('js/app-transfer-list.js') }}"></script>
@endsection
