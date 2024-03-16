@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">

        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">eCommerce /</span> Categorías
        </h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-category-list table">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th>Código</th>
                                <th class="text-nowrap">Nombre</th>
                                <th class="text-nowrap">Cuenta Ventas</th>
                                <th class="">Cuenta Compras</th>
                                <th class="">Estado</th>
                                <th class="">Acciones</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- Offcanvas to add new customer -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasEcommerceCategoryList"
                aria-labelledby="offcanvasEcommerceCategoryListLabel">
                <!-- Offcanvas Header -->
                <div class="offcanvas-header py-4">
                    <h5 id="offcanvasEcommerceCategoryListLabel" class="offcanvas-title" data-i18n=""></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <!-- Offcanvas Body -->
                <div class="offcanvas-body border-top">
                    <form class="pt-0" id="eCommerceCategoryListForm" onsubmit="return false">
                        <!-- Title -->

                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="ecommerce-category-title"
                                placeholder="140" name="codeCategory" aria-label="category title">
                            <label for="ecommerce-category-title">Código</label>
                        </div>

                        <!-- Slug -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="ecommerce-category-slug" class="form-control" placeholder="Frijoles"
                                aria-label="slug" name="nameCategory">
                            <label for="ecommerce-category-slug">Nombre</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="ecommerce-category-slug" class="form-control" placeholder="701301"
                                aria-label="slug" name="saleCategory">
                            <label for="ecommerce-category-slug">Cuenta Ventas</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="ecommerce-category-slug" class="form-control" placeholder="602310"
                                aria-label="slug" name="purchaseCategory">
                            <label for="ecommerce-category-slug">Cuenta Compras</label>
                        </div>
                        <!-- Image -->
                        <div class="form-floating form-floating-outline mb-4">
                            <input class="form-control" type="file" id="ecommerce-category-image" name="imgCategory">
                            <label for="ecommerce-category-image">Imagen</label>
                        </div>

                        <!-- Submit and reset -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Agregar</button>
                            <button type="reset" class="btn btn-outline-danger"
                                data-bs-dismiss="offcanvas">Descartar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('js/app-ecommerce-category-list.js') }}"></script>
@endsection
