@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Oficinas y Roles /</span> Lista Roles
        </h4>

        <div class="app-ecommerce-category">
            <!-- Category List Table -->
            <div class="card">
                <div class="card-datatable table-responsive">
                    <table class="datatables-category-list table">
                        <thead class="table-light">
                            <tr>
                                <th></th>
                                <th></th>
                                <th>Rol</th>
                                <th>Oficina</th>
                                <th class="text-nowrap">Estado &nbsp;</th>
                                <th class="text-lg-center">Acciones</th>
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
                    <form class="pt-0" id="eCommerceCategoryListForm" enctype="multipart/form-data"
                        onsubmit="return false">
                        <!-- Oficina -->
                        <div class="mb-3 ecommerce-select2-dropdown">
                            <div class="form-floating form-floating-outline">
                                <select id="ecommerce-subcategory-parent-category" class="select2 form-select"
                                    data-placeholder="Selecciona Rol" data-allow-clear="true" name="rol_id">
                                    <option value="0">Selecciona Oficina</option>
                                    @foreach ($offices as $office)
                                        <option value="{{ $office->id_office  }}">{{ $office->name_office }}</option>
                                    @endforeach
                                </select>
                                <label for="ecommerce-subcategory-parent-category">Selecciona Rol</label>
                            </div>
                        </div>
                        <!-- Title -->
                        <input type="hidden" id="categoryId" name="categoryId">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="ecommerce-category-title"
                                placeholder="Ingresa nombre de rol" name="categoryTitle" aria-label="category title">
                            <label for="ecommerce-category-title" data-i18n="Rol"></label>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label class="form-label" data-i18n="Description">Descripcion</label>
                            <div class="form-control p-0 pt-1">
                                <div class="comment-editor border-0" id="categoryDescription">
                                </div>
                                <div class="comment-toolbar border-0 rounded">
                                    <div class="d-flex justify-content-end">
                                        <span class="ql-formats me-0">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Submit and reset -->
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Agregar</button>
                            <button type="reset" class="btn btn-outline-danger"
                                data-bs-dismiss="offcanvas">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <link rel="stylesheet" href="{{ asset('vendor/libs/quill/editor.css') }}">
@endsection()

@section('scripts')
    <!-- Page JS -->
    <script src="{{ asset('js/app-ecommerce-rol-list.js') }}"></script>
@endsection
