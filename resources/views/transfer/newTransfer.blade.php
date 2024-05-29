@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Sticky Actions -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div
                        class="card-header bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                        <h5 class="card-title mb-sm-0 me-2">Guía de Remisión del Remitente</h5>
                        <div class="action-btns">
                            <button class="btn btn-outline-primary me-3">
                                <span class="align-middle"> Atras</span>
                            </button>
                            <button class="btn btn-primary">
                                Generar Guia de Remisión
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-10 mx-auto">
                                <!-- 1. Delivery Address -->
                                <h5 class="mb-4">1. CLIENTE</h5>
                                <div class="row g-4">
                                    <div class="col-md-8">
                                        <div class="form-floating form-floating-outline">
                                            <select id="state" class="select2 form-select" data-allow-clear="true"
                                                data-placeholder="Escribe el Número de RUC o Razón Social">
                                                <option value="">Seleccionar Cliente</option>
                                            </select>
                                            <label for="state">Escribe el Número de RUC o Razón Social</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group input-group-merge mb-4">
                                            <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                    class="mdi mdi-email-outline"></i></span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="codeP"
                                                    placeholder="ABC123" name="product_code">
                                                <label for="codeP">Email (Opcional)</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- 2. Delivery Type -->
                                <h5 class="my-4">2. DATOS DE TRASLADO</h5>
                                <div class="row gy-4">
                                    <div class="col-md-4 mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <select id="reason" class="select2 form-select" data-allow-clear="true"
                                                data-placeholder="Motivo del Traslado">
                                                <option value="">Seleccionar Motivo</option>
                                                @foreach ($reasons as $row)
                                                    <option value="{{ $row->id_reason }}">
                                                        {{ Str::limit($row->description_reason, 40, '...') }}</option>
                                                @endforeach
                                            </select>
                                            <label for="state">Seleccione Motivo del Traslado *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <select id="transfer_mode" class="select2 form-select" data-allow-clear="true"
                                                data-placeholder="Modalidad de Traslado ">
                                                <option value="">Seleccionar Modalidad</option>
                                                @foreach ($modalities as $row)
                                                    <option value="{{ $row->id_modality }}">{{ $row->description_modality }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <label for="state">Seleccione Modalidad de Traslado *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="multicol-birthdate" class="form-control dob-picker"
                                                placeholder="YYYY-MM-DD" name="end_date">
                                            <label for="multicol-birthdate">Fecha Inicial de Traslado</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pincode" class="form-control" placeholder="658468">
                                            <label for="pincode">Peso bruto (KGM) *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pincode" class="form-control" placeholder="658468">
                                            <label for="pincode">Número de bultos *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pincode" class="form-control" placeholder="658468">
                                            <label for="pincode">Número de contenedor</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-floating form-floating-outline">
                                            <select id="port_code" class="select2 form-select" data-allow-clear="true"
                                                data-placeholder="Seleccione Código de puerto">
                                                <option value="">Seleccionar Cliente</option>
                                                @foreach ($ports as $port)
                                                    <option value="{{ $port->id_portcode }}">
                                                        {{ $port->description_portcode }}</option>
                                                @endforeach
                                            </select>
                                            <label for="state">Código de puerto</label>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- 3. Apply Promo code -->
                                <h5 class="my-4">3. DATOS DEL TRANSPORTE PRIVADO</h5>
                                <div class="row gy-4">
                                    <div class="col-md-3">
                                        <div class="form-floating form-floating-outline">
                                            <select id="doc" class="select2 form-select" data-allow-clear="true"
                                                data-placeholder="Seleccione Tipo Doc.">
                                                <option value="">Seleccionar Cliente</option>
                                            </select>
                                            <label for="state">Tipo Doc.Ident.* </label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge mb-4">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="codeP"
                                                    placeholder="ABC123" name="product_code">
                                                <label for="codeP"> N° Doc Conductor: *</label>
                                            </div>
                                            <span class="input-group-text cursor-pointer" id="generateCode">
                                                <i class="mdi mdi-magnify"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge mb-4">
                                            <span class="input-group-text" id="generateCode">
                                                <i class="mdi mdi-card-account-details-outline"></i>
                                            </span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="codeP"
                                                    placeholder="ABC123" name="product_code">
                                                <label for="codeP"> Nombre Conductor: *</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-group input-group-merge mb-4">
                                            <span class="input-group-text" id="generateCode">
                                                <i class="mdi mdi-car-3-plus"></i>
                                            </span>
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" class="form-control" id="codeP"
                                                    placeholder="ABC123" name="product_code">
                                                <label for="codeP"> N° Placa Vehíc.: *</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- 4. Payment Method -->
                                <div class="row gy-4 ">
                                    <div class="col-md-6">
                                        <h5 class="my-4">4. PUNTO DE PARTIDA</h5>
                                    </div>
                                    <div class="col-md-6">
                                        <h5 class="my-4">5. PUNTO DE LLEGADA</h5>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pincode" class="form-control"
                                                placeholder="658468">
                                            <label for="pincode"> Dirección *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" id="pincode" class="form-control"
                                                placeholder="658468">
                                            <label for="pincode"> Dirección *</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select id="ubigeo_origin" class="select2 form-select"
                                                data-allow-clear="true" data-placeholder="Seleccione Ubigeo de Origen">
                                                <option value="">Seleccionar Cliente</option>
                                            </select>
                                            <label for="state"> Ubigeo * </label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-floating form-floating-outline">
                                            <select id="ubigeo_destiny" class="select2 form-select"
                                                data-allow-clear="true" data-placeholder="Seleccione Ubigeo de Llegada">
                                                <option value="">Seleccionar Cliente</option>
                                            </select>
                                            <label for="state"> Ubigeo * </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row gy-4 mt-3">
                                    <div class="card-header p-0">
                                        <div class="nav-align-top">
                                            <ul class="nav nav-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <button type="button" class="nav-link active" role="tab"
                                                        data-bs-toggle="tab" data-bs-target="#navs-top-home"
                                                        aria-controls="navs-top-home" aria-selected="true">
                                                        5. Detalle de guía de remisión: *
                                                    </button>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="tab-content p-0">
                                            <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                                <div class="card-datatable table-responsive">
                                                    <table class="table-products table">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th></th>
                                                                <th>Descripcion</th>
                                                                <th>Und/Medidad</th>
                                                                <th>Peso (KGM)</th>
                                                                <th>Cantidad</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Sticky Actions -->
        <div class="modal fade" id="ModalProduct" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-dialog-centered">
                <div class="modal-content  p-3 p-md-4">
                    <div class="modal-header mb-3">
                        <div class="card-title header-elements">
                            <h5 class="m-0 me-2">PRODUCTO</h5>
                            <div class="card-header-elements ms-auto">
                                <span class="text text-muted d-flex">
                                    <a href="{{ route('Inventario') }}" target="_blank"
                                        class="btn btn-primary waves-effect waves-light">Crear
                                        Nuevo</a>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-body py-3 py-md-0">
                        <form id="modalFormProduct" class="row g-4">
                            <div class="col-12">
                                <div class="form-floating form-floating-outline">
                                    <select id="productApp" name="productApp" class="form-select"
                                        aria-label="Default select example" data-placeholder="Selecciona un Producto">
                                    </select>
                                    <label for="modalEditUserStatus">Aquí puedes buscar y seleccionar tu
                                        producto/Servicio!</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="descrApp" id="descrApp" class="form-control"
                                        placeholder="">
                                    <label for="descrApp">Descripción</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="codeApp" id="codeApp" class="form-control" disabled>
                                    <label for="codeApp">Código</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="slctExtent" name="slctExtent" class="select2 form-select"
                                        aria-label="Default select example">
                                        @foreach ($extents as $row)
                                            <option value="{{ $row->id_extent }}">{{ $row->name_extent }}</option>
                                        @endforeach
                                    </select>
                                    <label for="slct-extent">Und/Medida</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="quantityApp" id="quantityApp" class="form-control"
                                        value="1">
                                    <label for="modalEditUserEmail">Cantidad</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="weightApp" id="weightApp" class="form-control"
                                        value="1">
                                    <label for="modalEditUserEmail">Peso (KGM)</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary me-sm-3 me-1">Agregar</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('vendor/libs/jquery-sticky/jquery-sticky.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('js/form-layouts.js') }}"></script>
    <script src="{{ asset('js/tables-datatables-transfer.js') }}"></script>
@endsection
