@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-2">Lista de Proveedores</h4>

        <p class="mb-4">Aqui podras ver el estado de cada proveedor, validar el estado del proveedor, además de crear,
            editar o eliminar.</p>


        <!-- Permission Table -->
        <div class="card">
            <div class="card-datatable table-responsive">
                <table class="datatables-permissions table">
                    <thead class="table-light">
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Razon Social</th>
                            <th>RUC</th>
                            <th>Validacion RUC</th>
                            <th>Registro Sanitario</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <!--/ Permission Table -->

        <!-- Modal -->
        <!-- Supplier Modal -->
        <div class="modal fade" id="addPermissionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-simple modal-dialog-centered modal-edit-user">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body py-3 py-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                            onclick=" closeForm()"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2" id="title-form" data-i18n=""></h3>
                        </div>
                        <form id="supplierForm" class="row g-4" onsubmit="return false">
                            <input type="hidden" id="id" name="id">
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="ruc" name="ruc" class="form-control"
                                        placeholder="20123456789">
                                    <label for="ruc">Ingresar RUC</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="business_name" name="business_name" class="form-control"
                                        placeholder="D' DON PEPITO S.A">
                                    <label for="business_name">Razón Social</label>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="mail" name="mail" class="form-control"
                                        placeholder="admin@donpepito.com">
                                    <label for="mail">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" name="phone"
                                        class="form-control modal-edit-tax-id" placeholder="123 456 7890">
                                    <label for="phone">Número Celular</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Av. PettiTours 2012">
                                    <label for="address">Dirección Fiscal</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="ubigeo" name="ubigeo" class="form-control"
                                        placeholder="Ubigeo">
                                    <label for="ubigeo">Ubigeo</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
                                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                                    aria-label="Close" >Cancelar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Add Supplier Modal -->

        <!-- Verify RUC -->
        <div class="modal fade" id="verifyRUC" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body pt-3 pt-md-0 px-0 pb-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Verificar RUC</h3>
                            <p class="pt-1" id="title-ruc-validate"></p>

                        </div>
                        <form id="validity-ruc" class="row g-3" onsubmit="return false">
                            <input type="hidden" id="id_validate" name="id_validate">
                            <div class="row py-2 justify-content-center align-items-center">
                                <div class="col-md mb-md-0 mb-2">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="customCheckboxIcon1">
                                            <span class="custom-option-body">
                                                <i class="mdi mdi-domain"></i>
                                                <span class="custom-option-title"> Instalaciones </span>
                                                <small> Indica que el negocio opera desde un local físico o
                                                    instalación similar. </small>
                                            </span>
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="customCheckboxIcon1" name="instalation">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md mb-md-0 mb-2">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="customCheckboxIcon2">
                                            <span class="custom-option-body">
                                                <i class="mdi mdi-account-group"></i>
                                                <span class="custom-option-title"> Capacidad Operativa </span>
                                                <small> Capacidad del negocio para operar de manera
                                                    efectiva y eficiente en su entorno. </small>
                                            </span>
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="customCheckboxIcon2" name="personal">
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md mb-md-0 mb-2">
                                    <div class="form-check custom-option custom-option-icon">
                                        <label class="form-check-label custom-option-content" for="customCheckboxIcon3">
                                            <span class="custom-option-body">
                                                <i class="mdi mdi-currency-usd-off"></i>
                                                <span class="custom-option-title"> No Adeudo o Sanciones </span>
                                                <small> Manejo de sus obligaciones financieras y legales de manera efectiva.
                                                </small>
                                            </span>
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="customCheckboxIcon3" name="debts">
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4 mx-n3 mx-md-n5">
                            <h5 class="pt-2">Observaciones</h5>
                            <div class="col-lg-10">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="obse" name="obse" class="form-control"
                                        placeholder="">
                                    <label for="ruc">Observaciones</label>
                                </div>
                            </div>
                            <div class="col-lg-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn_validity">validar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Verify RUC -->

        <!-- Verify RUC -->
        <div class="modal fade" id="uploadFile" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-simple modal-refer-and-earn modal-dialog-centered">
                <div class="modal-content p-3 p-md-5">
                    <div class="modal-body pt-3 pt-md-0 px-0 pb-md-0">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2">Registro Sanitario</h3>
                            <p class="pt-1" id="title-file-sanitary"></p>
                        </div>
                        <form id="file-sanitary" class="row g-3" onsubmit="return false" enctype="multipart/form-data">
                            <input type="hidden" id="id_file_supplier" name="id_file_supplier">
                            <input type="hidden" id="action" name="action">
                            <input type="hidden" id="file_name" name="file_name">
                            <div class="col-lg-9">
                            </div>
                            <div class="col-lg-2 d-flex align-items-end">
                                <button type="submit" class="btn btn-primary btn_file">Validar</button>
                            </div>
                            <hr class="my-4 mx-n3 mx-md-n5">

                            <div class="row py-2 justify-content-center align-items-center">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Registro Sanitario</label>
                                    <input class="form-control" type="file" id="formFile" name="formFile">
                                </div>
                                <div class="mb-3">
                                    <div id="pdfPreview"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!--/ Verify RUC -->

        <!-- /Modal -->
    </div>
    <!-- / Content -->

    <!-- / Content -->
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <script src="{{ asset('js/app-supplier-list.js') }}"></script>
@endsection
