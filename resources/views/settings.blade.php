@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            <span class="text-muted fw-light">Administración /</span> Empresa
        </h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h4 class="card-header">Detalles de Empresa</h4>
                    <!-- Account -->
                    <div class="card-body">
                        <div class="d-flex align-items-start align-items-sm-center gap-4">
                            <img src="{{ asset('img/avatars/1.png') }}" alt="user-avatar"
                                class="d-block w-px-120 h-px-120 rounded" id="uploadedAvatar">
                            <div class="button-wrapper">
                                <label for="upload" class="btn btn-primary me-2 mb-3" tabindex="0">
                                    <span class="d-none d-sm-block">Subir nueva foto</span>
                                    <i class="mdi mdi-tray-arrow-up d-block d-sm-none"></i>
                                    <input type="file" id="upload" class="account-file-input" hidden=""
                                        accept="image/png, image/jpeg">
                                </label>

                                <div class="small">JPG, GIF o PNG permitidos. Tamaño máximo de 800K.</div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-2 mt-1">
                        <form id="formAccountSettings" enctype="multipart/form-data">
                            <div class="row mt-2 gy-4">
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge">
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="ruc" placeholder="R.U.C."
                                                value="{{ session('ruc') }}" name="ruc">
                                            <label for="ruc">R.U.C. </label>
                                        </div>
                                        <span class="input-group-text bg-primary text-bg-light cursor-pointer"
                                            id="searchRuc">
                                            <i class="mdi mdi-magnify fs-3"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-domain fs-4"></i>
                                        </span>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" name="reason" id="reason"
                                                placeholder="Razón Social" value="{{ session('reason') }}">
                                            <label for="reason">Razón Social</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-store-alert fs-4"></i>
                                        </span>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" name="ecommerce" id="ecommerce"
                                                placeholder=" Nombre Comercial" value="{{ session('ecommerce') }}">
                                            <label for="ecommerce"> Nombre Comercial</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-phone fs-4"></i>
                                        </span>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" name="phone" id="phone"
                                                placeholder="Telefóno" value="{{ session('phone') }}">
                                            <label for="phone">Telefóno</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-email fs-4"></i>
                                        </span>
                                        <div class="form-floating form-floating-outline">
                                            <input class="form-control" type="text" id="email" name="email"
                                                placeholder="john.doe@example.com" value="{{ session('email') }}">
                                            <label for="email">E-mail</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-floating form-floating-outline">
                                        <select id="ubigeo" name="ubigeo" class="form-select">
                                            <option value="{{ session('ubigeo') }}">
                                                {{ session('ubigeo_data')->departamento }} -
                                                {{ session('ubigeo_data')->provincia }} -
                                                {{ session('ubigeo_data')->distrito }}
                                            </option>
                                        </select>
                                        <label for="ubigeo">Ubigeo</label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-map-marker fs-4"></i>
                                        </span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="urbanization"
                                                name="urbanization" placeholder="Urbanización"
                                                value="{{ session('urbanization') }}">
                                            <label for="urbanization">Urbanización</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="input-group input-group-merge">
                                        <span class="input-group-text">
                                            <i class="mdi mdi-map-marker fs-4"></i>
                                        </span>
                                        <div class="form-floating form-floating-outline">
                                            <input type="text" class="form-control" id="address" name="address"
                                                placeholder="Dirección fiscal" value="{{ session('address') }}">
                                            <label for="address">Dirección fiscal</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary me-2">Guardar Información</button>
                                <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                            </div>
                        </form>
                    </div>
                    <!-- /Account -->
                </div>
            </div>
        </div>


    </div>
    <!-- / Content -->
@endsection()

@section('styles')
@endsection()

@section('scripts')
    <script src="{{ asset('js/pages-account-settings-account.js') }}"></script>
@endsection
