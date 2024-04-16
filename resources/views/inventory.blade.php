@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Inventario /</span> Productos/Servicios
        </h4>
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Filtro de búsqueda</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-6 branch_product"></div>
                </div>
            </div>
            <div class="card-datatable table-responsive">
                <table class="datatables-users table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Codigo</th>
                            <th>Nombre</th>
                            <th>Unidad Medida</th>
                            <th>Sucursal</th>
                            <th>Categoria</th>
                            <th>Stock</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>

        </div>

        <!-- Branch Modal -->
        <div class="modal fade" id="addProductModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-simple modal-dialog-centered modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick="closeForm()"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2" id="title-form" data-i18n=""></h3>
                        </div>
                        <form id="productForm" class="row g-4" onsubmit="return false">

                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="code_product" placeholder="Código"
                                            name="code">
                                        <label for="basic-default-password12">Código </label>
                                    </div>
                                    <span class="input-group-text cursor-pointer" id="generateCode">
                                        <i class="mdi mdi-restore"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">
                                        <i class="mdi mdi-application-edit-outline"></i>
                                    </span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="nameP" name="name"
                                            placeholder="Nombre de bien o servicio">
                                        <label for="nameP">Nombre de Producto/Servicio</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <div class="form-floating form-floating-outline">
                                        <select id="igvId" name="igv" class="select2 form-select form-select-lg"
                                            data-allow-clear="true" data-placeholder="Seleccionar IGV">
                                            @foreach ($sunat as $row)
                                                <option value="{{ $row->id_igv }}">{{ $row->description_igv }}</option>
                                            @endforeach
                                        </select>
                                        <label for="igv">Tipo de IGV</label>

                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="extent" name="extent" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" data-placeholder="Seleccionar Unidad de Medida">
                                        @foreach ($extents as $row)
                                            <option value="{{ $row->id_extent }}">{{ $row->name_extent }}</option>
                                        @endforeach
                                    </select>
                                    <label for="extent">Unidad de Medida</label>

                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="category" name="category" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" data-placeholder="Seleccionar Categoria">
                                        @foreach ($categories as $row)
                                            <option value="{{ $row->id_category }}">{{ $row->name_category }}</option>
                                        @endforeach
                                    </select>
                                    <label for="category">Seleccionar Categoria</label>

                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"> S/. </span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="pen" class="form-control" id="p_pen"
                                            placeholder="Precio Soles (Sin IGV)">
                                        <label for="p_pen">Precio Soles (Sin IGV)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text">S/.</span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="pen_igv" class="form-control" id="p_pen_igv"
                                            placeholder="Precio Soles (IGV)">
                                        <label for="p_pen_igv">Precio Soles (Inc. IGV)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="usd" class="form-control" id="usdID"
                                            placeholder="Nombre de bien o servicio">
                                        <label for="name">Precio Dolares (Sin IGV)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="mdi mdi-currency-usd"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" name="usd_igv" class="form-control" id="p_usd_igv"
                                            placeholder="Nombre de bien o servicio">
                                        <label for="p_usd_igv">Precio Dolares (Inc. IGV)</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i class="mdi mdi-package-variant"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="stock" class="form-control" id="stockID"
                                            placeholder="Stock Inicial" value="0">
                                        <label for="p_usd">Stock Inicial</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="input-group input-group-merge">
                                    <span class="input-group-text"><i
                                            class="mdi mdi-package-variant-closed-remove"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="number" name="stock_min" class="form-control" id="stock_limit"
                                            placeholder="Stock Mínimo" value="0">
                                        <label for="stock_limit">Stock Mínimo</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="text-light small fw-medium">¿Tiene Detracción?</div>
                                <label class="switch switch-lg">
                                    <input type="checkbox" class="switch-input btn-detraction">
                                    <span class="switch-toggle-slider">
                                        <span class="switch-on"></span>
                                        <span class="switch-off"></span>
                                    </span>
                                </label>
                            </div>
                            <div class="col-12 col-md-12 detraction" style="display: none">
                                <div class="form-floating form-floating-outline">
                                    <select id="detraction" name="detraction" class="select2 form-select form-select-lg"
                                        data-allow-clear="true" data-placeholder="Seleccionar Categoria" disabled>
                                        @foreach ($detractions as $row)
                                            <option value="{{ $row->id_detraction }}">
                                                {{ $row->decription_detraction . ' ( ' . $row->percentage_detraction . ')' }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="detraction">Código del Bien * :</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <label>Detalle/Nota:</label>

                                <textarea id="autosize-demo" name="detail" rows="2" class="form-control"
                                    style="overflow: hidden; overflow-wrap: break-word; resize: none; text-align: start; height: 81.6px;"></textarea>
                            </div>

                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close">Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Branch Modal -->
    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}">
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('vendor/libs/autosize/autosize.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('js/app-inventory-list.js') }}"></script>
@endsection
