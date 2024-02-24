@extends('layouts/layout')

@section('content')
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Users List Table -->
        <div class="card">
            <div class="card-header border-bottom">
                <h5 class="card-title">Filtro de búsqueda</h5>
                <div class="d-flex justify-content-between align-items-center row py-3 gap-3 gap-md-0">
                    <div class="col-md-4 user_role"></div>
                    <div class="col-md-4 user_plan"></div>
                    <div class="col-md-4 user_status"></div>
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
            <!-- Offcanvas to add new user -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasAddUser"
                aria-labelledby="offcanvasAddUserLabel">
                <div class="offcanvas-header">
                    <h5 id="offcanvasAddUserLabel" class="offcanvas-title add-new"></h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>
                <div class="offcanvas-body mx-0 flex-grow-0 h-100">
                    <form class="add-new-user pt-0" id="addNewUserForm" onsubmit="return false">
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="add-user-lastname"
                                placeholder="Valenzuela Estrada" name="userLastname" aria-label="">
                            <label for="add-user-lastname">Apellidos</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" class="form-control" id="add-user-fullname" placeholder="Marlon Emerson"
                                name="userFirstname" aria-label="John Doe">
                            <label for="add-user-fullname">Nombres</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="add-user-dni" class="form-control phone-mask"
                                placeholder="65847152" aria-label="" name="userDNI">
                            <label for="add-user-dni">DNI</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="add-user-contact" class="form-control phone-mask"
                                placeholder="956841257" aria-label="" name="userContact">
                            <label for="add-user-contact">Telefono</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <input type="text" id="add-user-email" class="form-control"
                                placeholder="john.doe@example.com" aria-label="john.doe@example.com" name="userEmail">
                            <label for="add-user-email">Correo Electronico</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="user-office" class="select2 form-select" name="userOffice">
                                <option value="0"> Seleccionar Oficina</option>
                                @foreach ($offices as $office)
                                    <option value="{{ $office->id_office }}">{{ $office->name_office }}</option>
                                @endforeach
                            </select>
                            <label for="user-office">Oficina</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="user-role" class="select2 form-select" data-placeholder="Seleccionar Rol" name="userRol">
                            </select>
                            <label for="user-role">Rol</label>
                        </div>
                        <div class="form-floating form-floating-outline mb-4">
                            <select id="user-plan" class="form-select" name="userStatus">
                                <option value="1">Activo</option>
                                <option value="2">Inactivo</option>
                            </select>
                            <label for="user-plan">Estado</label>
                        </div>
                        <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Guardar</button>
                        <button type="reset" class="btn btn-outline-secondary"
                            data-bs-dismiss="offcanvas">Cancelar</button>
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
    <script src="{{ asset('vendor/libs/%40form-validation/umd/plugin-auto-focus/index.min.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('js/app-user-list.js') }}"></script>
@endsection
