@extends('layouts/layout')

@section('content')
    <!-- Content -->
    <div class="container-xxl flex-grow-1 container-p-y">


        <h4 class="py-3 mb-4">
            Reporte Kardex
        </h4>
        <div class="card card-action mb-4">
            <div class="card-header">
                <div class="card-action-title"><i class="mdi mdi-table-edit"></i> REPORTE KARDEX / KARDEX INDIVIDUAL</div>
                <div class="card-action-element">
                    <ul class="list-inline mb-0">
                        <li class="list-inline-item">
                            <a href="javascript:void(0);" class="card-collapsible"><i
                                    class="tf-icons mdi mdi-chevron-up"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="collapse show">
                <form>
                    <div class="card-body">

                        <div class="row g-4">
                            <div class="col-md-8">
                                <div class="form-floating form-floating-outline">
                                    <select id="product" class="select2 form-select">
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="input-group input-group-merge mb-4">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="mdi mdi-barcode"></i></span>
                                    <div class="form-floating form-floating-outline">
                                        <input type="text" class="form-control" id="codeP" placeholder="ABC123">
                                        <label for="codeP">Código</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <select id="branch" class="select2 form-select">
                                        @foreach ($branches as $row)
                                            <option value="{{ $row->id_branch }}">{{ $row->name_branch }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="multicol-birthdate" class="form-control dob-picker"
                                        placeholder="YYYY-MM-DD">
                                    <label for="multicol-birthdate">Fecha Inicio</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-floating form-floating-outline">
                                    <input type="text" id="multicol-birthdate" class="form-control dob-picker"
                                        placeholder="YYYY-MM-DD">
                                    <label for="multicol-birthdate">Fecha Final</label>
                                </div>
                            </div>

                        </div>

                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary btn-next waves-effect waves-light">  <span
                                class="align-middle d-sm-inline-block d-none me-sm-1"><i
                                class="mdi mdi-content-save-check"></i> Generar Kardex</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <h5 class="card-header"><i class="mdi mdi-format-list-bulleted-square"></i> REPORTE KARDEX</h5>
            <div class="card-datatable text-nowrap">
                <table class="dt-complex-header table table-bordered">
                    <thead>
                        <tr>
                            <th rowspan="2">N°</th>
                            <th rowspan="2">Fecha</th>
                            <th rowspan="2">Detalle</th>
                            <th colspan="3" class="text-center bg-success">Entradas</th>
                            <th colspan="3" class="text-center bg-info">Salidas</th>
                            <th rowspan="2">Status</th>
                            <th rowspan="2">Action</th>

                        </tr>
                        <tr>
                            <th>Cantidad</th>
                            <th>C. Unit.</th>
                            <th>C. Total.</th>
                            <th>Cantidad</th>
                            <th>C. Unit.</th>
                            <th>C. Total.</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

    </div>
    <!-- / Content -->
@endsection()

@section('styles')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/libs/flatpickr/flatpickr.css') }}">
@endsection()

@section('scripts')
    <script src="{{ asset('vendor/libs/cleavejs/cleave.js') }}"></script>
    <script src="{{ asset('vendor/libs/cleavejs/cleave-phone.js') }}"></script>
    <script src="{{ asset('vendor/libs/moment/moment.js') }}"></script>
    <script src="{{ asset('vendor/libs/flatpickr/flatpickr.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('js/tables-datatables-basic.js') }}"></script>
@endsection
