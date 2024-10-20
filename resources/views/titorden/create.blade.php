@extends('layouts/layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <form id="formOC" enctype="multipart/form-data">
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
                                    <h5 class="my-4">1. DATOS DE PROVEEDOR</h5>
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
                                    </div>

                                    <hr>
                                    <!-- 2. Delivery Type -->
                                    <h5 class="my-4">2. DATOS DE OC</h5>

                                    <div class="row gy-4">
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <select id="type_oc" name="type_oc" class="select2 form-select"
                                                    data-allow-clear="true" data-placeholder="Seleccione Tipo OC.">
                                                    <option value="1">Materia Prima</option>
                                                    <option value="2">Insumos de Exportación</option>
                                                    <option value="3">Productos Para Calidad</option>
                                                    <option value="4">Productos para Administración</option>
                                                </select>
                                                <label for="doc_transport">Tipo de OC.* </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <select id="payment_method" name="payment_method"
                                                    class="select2 form-select" data-allow-clear="true"
                                                    data-placeholder="Seleccione Tipo OC.">
                                                    <option value="1">Efectivo</option>
                                                    <option value="2">Transferencia</option>
                                                </select>
                                                <label for="payment_method">Forma de Pago.* </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control"id="delivery_time"
                                                        name="delivery_time" placeholder="Tiempo de Entrega">
                                                    <label for="delivery_time">Tiempo Entrega.* (<code>Dias</code>) </label>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-floating form-floating-outline">
                                                <select id="coin" name="coin" class="select2 form-select"
                                                    data-allow-clear="true" data-placeholder="Seleccione Tipo Moneda.">
                                                    <option value="">Tipo de Moneda</option>

                                                    <option value="3" selected>Soles (S/.)</option>
                                                    <option value="7">Dolares ($/.)</option>
                                                </select>
                                                <label for="coin">Seleccione Tipo Moneda.* </label>
                                            </div>
                                        </div>
                                    </div>


                                    <hr>

                                    <div id="file_subject">
                                        <div class="card-title m-0">
                                            <h5 class="mb-1">Datos adicionales en Materia Prima</h5>
                                        </div>
                                        <div class="row gy-4 mt-2">
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="file" name="raw_material1"
                                                        class="form-control form-control-lg" id="inputFile01"
                                                        aria-describedby="inputFileAddon01" aria-label="Upload"
                                                        accept=".pdf,.doc,.docx,.xls,.xlsx">
                                                    <button class="btn btn-secondary waves-effect" type="button"
                                                        id="inputFileAddon01">Documento 1</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="input-group">
                                                    <input type="file" name="raw_material2"
                                                        class="form-control form-control-lg" id="inputFile02"
                                                        aria-describedby="inputFileAddon02" aria-label="Upload"
                                                        accept=".pdf,.doc,.docx,.xls,.xlsx">
                                                    <button class="btn btn-secondary waves-effect" type="button"
                                                        id="inputFileAddon02">Documento 2</button>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                    </div>


                                    <h5 class="my-4">3. DATOS DE ALMACEN</h5>

                                    <div class="row gy-4">
                                        <div class="col-md-3">
                                            <div class="form-floating form-floating-outline">
                                                <select id="store" name="store" class="select2 form-select"
                                                    data-allow-clear="true"
                                                    data-placeholder="Escribe código o nombre de sucursal .">
                                                    <option value="">Seleccionar Sucursal</option>
                                                    @foreach ($stores as $store)
                                                        <option value="{{ $store['id'] }}"
                                                            data-address="{{ $store['address'] }}"
                                                            data-ubigeo="{{ $store['ubigeo'] }}">
                                                            {{ $store['name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <label for="store">Sucursal.* </label>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-group input-group-merge mb-4">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                        class="mdi mdi-badge-account-outline"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <input type="text" class="form-control" id="address"
                                                        placeholder="Dirección sucursal" name="address">
                                                    <label for="address"> Dirección sucursal *</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-5">
                                            <div class="form-floating form-floating-outline">
                                                <select id="ubigeo" name="ubigeo" class="select2 form-select"
                                                    data-allow-clear="true" data-placeholder="Escribe el ubigeo.">
                                                </select>
                                                <label for="ubigeo">Ubigeo sucursal *</label>
                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <h5 class="my-4">4. DATOS EXTRAS</h5>

                                    <div class="row gy-4">

                                        <div class="col-md-12">
                                            <div class="input-group input-group-merge mb-4">
                                                <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                                        class="mdi mdi-badge-account-outline"></i></span>
                                                <div class="form-floating form-floating-outline">
                                                    <textarea id="autosize-demo" rows="3" name="observation" class="form-control"></textarea>
                                                    <label for="address"> Observaciones *</label>
                                                </div>
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
                                                            4. Productos OC: *
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
                                                                    <th>Descripción</th>
                                                                    <th>Und/Medidad</th>
                                                                    <th>Cantidad</th>
                                                                    <th>Precio Unitario</th>
                                                                    <th>Importe</th>
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
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" name="priceApp" id="priceApp"
                                        class="form-control input-number" value="00.00">
                                    <label for="modalEditUserEmail">Precio (<code id="currency"
                                            class="fs-6">S/.</code>)</label>
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
    <script src="{{ asset('vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('vendor/libs/jquery-sticky/jquery-sticky.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('js/form-layouts.js') }}"></script>
    <script src="{{ asset('js/tables-datatables-titorden.js') }}"></script>
@endsection
