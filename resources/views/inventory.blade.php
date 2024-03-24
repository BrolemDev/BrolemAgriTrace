@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">eCommerce /</span> Productos/Servicios
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
                            <th>Usuario</th>
                            <th>Oficina</th>
                            <th>Rol</th>
                            <th>Telefono</th>
                            <th>Estado</th>
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
                            onclick=" closeForm()"></button>
                        <div class="text-center mb-4">
                            <h3 class="mb-2" id="title-form" data-i18n=""></h3>
                        </div>
                        <form id="productForm" class="row g-4" onsubmit="return false">
                            <input type="hidden" id="branch" name="branch">
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="code_product" name="code_product" class="form-control"
                                        placeholder="0001">
                                    <label for="code_product">Código</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-8">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="name" name="name" class="form-control"
                                        placeholder="Sucursal/Almacen San Miguel 140">
                                    <label for="name">Nombre de Producto/Servicio</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="address" name="address" class="form-control"
                                        placeholder="Av. PettiTours 2012">
                                    <label for="address">Dirección</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="urbanization" name="urbanization" class="form-control"
                                        placeholder="Av. PettiTours 2012">
                                    <label for="urbanization">Urbanización</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-5">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="ubigeo" name="ubigeo" class="form-control"
                                        placeholder="Ubigeo">
                                    <label for="ubigeo">Ubigeo</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="email" id="mail" name="mail" class="form-control"
                                        placeholder="admin@donpepito.com">
                                    <label for="mail">Email</label>
                                </div>
                            </div>
                            <div class="col-12 col-md-3">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="phone" name="phone"
                                        class="form-control modal-edit-tax-id" placeholder="123 456 7890">
                                    <label for="phone">Número Celular</label>
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
        <!--/ Add Branch Modal -->
    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.css') }}">
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('vendor/libs/bootstrap-maxlength/bootstrap-maxlength.js') }}"></script>
    <script src="{{ asset('js/app-inventory-list.js') }}"></script>

@endsection
