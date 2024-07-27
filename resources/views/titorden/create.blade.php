@extends('layouts/layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <form id="formOC">
                <div class="col-12">
                    <div class="card">
                        <div
                            class="card-header bg-label-secondary d-flex justify-content-sm-between align-items-sm-center flex-column flex-sm-row">
                            <h5 class="card-title mb-sm-0 me-2">ORDEN DE COMPRA</h5>
                            <div class="action-btns">
                                <button class="btn btn-outline-primary me-3">
                                    <span class="align-middle"> Atras</span>
                                </button>
                                <button class="btn btn-primary">
                                    Generar Orden de Compra
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 mx-auto" id="dataOC">
                                    <div class="row g-4">
                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select id="doc_supplier" name="doc_supplier" class="select2 form-select"
                                                    data-allow-clear="true"
                                                    data-placeholder="Escribe el número de RUC o Razón Social del Proveedor .">

                                                </select>
                                                <label for="doc_supplier">Razón Social Proveedor.* </label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-merge mb-4">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                        class="mdi mdi-badge-account-outline"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="representative"
                                                        placeholder="Representante" name="representative">
                                                    <label for="representative"> Representante *</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="input-group input-group-merge mb-4">
                                              <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                      class="mdi mdi-phone-in-talk"></i></span>
                                              <div class="form-floating form-floating-outline">
                                                  <input type="text" class="form-control" id="phone"
                                                      placeholder="Número Celular" name="phone">
                                                  <label for="phone"> Número Celular *</label>
                                              </div>
                                          </div>
                                      </div>
                                        <div class="col-md-4">
                                            <div class="input-group input-group-merge mb-4">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="ruc_destiny"
                                                        placeholder="" name="ruc_destiny">
                                                    <label for="ruc_destiny"> N° Doc: *</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer btn-primary" id="getDestiny">
                                                    <i class="mdi mdi-magnify"></i>
                                                </span>
                                            </div>
                                        </div>

                                    </div>
                                    <hr>
                                    <!-- 2. Delivery Type -->
                                    <h5 class="my-4">2. DATOS DE TRASLADO</h5>
                                    <div class="row gy-4">
                                        <div class="col-md-4 mb-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="init_transfer" class="form-control dob-picker"
                                                    placeholder="YYYY-MM-DD" name="init_transfer">
                                                <label for="init_transfer">Fecha Inicial de Traslado</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="weight_transfer" class="form-control input-number"
                                                    placeholder="" name="weight_transfer">
                                                <label for="weight_transfer">Peso bruto (KGM) *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="package_transfer" name="package_transfer"
                                                    class="form-control input-number" placeholder="658468">
                                                <label for="arr">Número de bultos *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="container_transfer" name="container_transfer"
                                                    class="form-control" placeholder="">
                                                <label for="container_transfer">Número de contenedor</label>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <!-- 3. Apply Promo code -->
                                    <h5 class="my-4">3. DATOS DEL TRANSPORTE PRIVADO</h5>
                                    <div class="row gy-4">
                                        <div class="col-md-3">
                                            <div class="input-group input-group-merge mb-4">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="number_transport"
                                                        placeholder="ABC123" name="number_transport">
                                                    <label for="number_transport"> N° Doc Conductor: *</label>
                                                </div>
                                                <span class="input-group-text cursor-pointer btn-primary" id="getTransport">
                                                    <i class="mdi mdi-magnify"></i>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-merge mb-4">
                                                <span class="input-group-text">
                                                    <i class="mdi mdi-card-account-details-outline"></i>
                                                </span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="names_transport"
                                                        placeholder="" name="names_transport">
                                                    <label for="names_transport"> Nombre Conductor: *</label>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-group-merge mb-4">
                                                <span class="input-group-text">
                                                    <i class="mdi mdi-car-3-plus"></i>
                                                </span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="plate_transport"
                                                        placeholder="" name="plate_transport">
                                                    <label for="plate_transport"> N° Placa Vehíc.: *</label>
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
                                                <input type="text" id="address_point" name="address_point"
                                                    class="form-control" value="{{ session('address') }}">
                                                <label for="address_point"> Dirección *</label>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-floating form-floating-outline">
                                                <input type="text" id="address_arrival" name="address_arrival"
                                                    class="form-control">
                                                <label for="address_arrival"> Dirección *</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-floating form-floating-outline">
                                                <select id="ubigeo_destiny" name="ubigeo_destiny"
                                                    class="select-search form-select" data-allow-clear="true"
                                                    data-placeholder="Seleccione Ubigeo de Llegada">
                                                    <option value="">Seleccionar Cliente</option>
                                                </select>
                                                <label for="ubigeo_destiny"> Ubigeo * </label>
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
                                                <div class="tab-pane fade show active" id="navs-top-home"
                                                    role="tabpanel">
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
            </form>
        </div>
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
                                    <input type="text" name="quantityApp" id="quantityApp"
                                        class="form-control input-number" value="1">
                                    <label for="modalEditUserEmail">Cantidad</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="weightApp" id="weightApp"
                                        class="form-control input-number" value="1">
                                    <label for="modalEditUserEmail">Peso (KGM)</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary me-sm-3 me-1">Agregar</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cerrar</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="ModalTransfer" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body pt-3 pt-md-0 px-0 pb-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Guía de Remesión</h3>
                        </div>
                        <div class="row py-2">
                            <div class="col-12 col-lg-4 px-4">
                                <a id="url_guide" href="{{ url('/GuiaRemisionPdf') }}" target="_blank">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="modal-refer-and-earn-step bg-label-danger">
                                            <i class="mdi mdi-file-pdf-box mdi-36px"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center">
                                    <h6 class="mb-2">Ver Guía de Remisión</h6>
                                    <p class="mb-lg-0">
                                        Redirige a la guía de remisión en formato PDF
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 px-4">
                                <a href="{{ url('/Guias_Remision') }}">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="modal-refer-and-earn-step bg-label-info">
                                            <i class="mdi mdi-file-document-multiple-outline mdi-36px"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center">
                                    <h6 class="mb-2">Ver Guías de Remisión</h6>
                                    <p class="mb-lg-0">
                                        Mira toda la lista de guías de remisión
                                    </p>
                                </div>
                            </div>
                            <div class="col-12 col-lg-4 px-4">
                                <a href="{{ '/Generar_Guia_Remision' }}">
                                    <div class="d-flex justify-content-center mb-3">
                                        <div class="modal-refer-and-earn-step bg-label-success">
                                            <i class="mdi mdi-file-document-refresh-outline mdi-36px"></i>
                                        </div>
                                    </div>
                                </a>
                                <div class="text-center">
                                    <h6 class="mb-2">Generar Nueva Guía</h6>
                                    <p class="mb-0">
                                        Genera una nueva guía de remisión
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    <script src="{{ asset('js/tables-datatables-titorden.js') }}"></script>
@endsection
