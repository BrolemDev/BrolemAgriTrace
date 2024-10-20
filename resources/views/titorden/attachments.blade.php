@extends('layouts/layout')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-12 col-md-12 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column">
                            <div class="mb-xl-0 pb-3">
                                <div class="d-flex svg-illustration align-items-center gap-2 mb-4">
                                    <span class="app-brand-logo demo">
                                        <img src="{{ asset('img/brolemlogo.png') }}" alt="Brolem">
                                    </span>
                                </div>
                                <p class="mb-1">
                                    BROLEM COMPANY S.A.C
                                </p>
                                <p class="mb-1">JR. ENRIQUE BARREDA NRO. 535</p>
                                <p class="mb-0">
                                    LA VICTORIA. LIMA-PERU
                                </p>
                            </div>
                            <div style="text-align: right;">
                                <h4 class="fw-medium">Orden de Compra</h4>
                                <div class="mb-1">
                                    <span>OC-002-029</span>
                                </div>
                                <div>
                                    <span>Fecha:</span>
                                    <span>25/03/2023</span>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-wrap">
                            <div class="my-3">
                                <h6 class="pb-2">PROVEEDOR :</h6>
                                <p class="mb-1">Thomas shelby</p>
                                <p class="mb-1">Shelby Company Limited</p>
                                <p class="mb-1"><strong>REPRESENTANTE:</strong></p>
                                <p class="mb-0">peakyFBlinders@gmail.com</p>
                            </div>
                            <div class="my-3">
                                <h6 class="pb-2">ENVIE A:</h6>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="pe-3 fw-medium">Total Due:</td>
                                            <td>$12,110.55</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Bank name:</td>
                                            <td>American Bank</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">Country:</td>
                                            <td>United States</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">IBAN:</td>
                                            <td>ETD95476213874685</td>
                                        </tr>
                                        <tr>
                                            <td class="pe-3 fw-medium">SWIFT code:</td>
                                            <td>BR91905</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-borderless m-0">
                            <thead class="border-top">
                                <tr>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Unidad</th>
                                    <th>P. Unitario</th>
                                    <th>Importe</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-nowrap text-heading">
                                        Vuexy Admin Template
                                    </td>
                                    <td class="text-nowrap">HTML Admin Template</td>
                                    <td>$32</td>
                                    <td>1</td>
                                    <td>$32.00</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap text-heading">
                                        Frest Admin Template
                                    </td>
                                    <td class="text-nowrap">Angular Admin Template</td>
                                    <td>$22</td>
                                    <td>1</td>
                                    <td>$22.00</td>
                                </tr>
                                <tr>
                                    <td class="text-nowrap text-heading">
                                        Apex Admin Template
                                    </td>
                                    <td class="text-nowrap">HTML Admin Template</td>
                                    <td>$17</td>
                                    <td>2</td>
                                    <td>$34.00</td>
                                </tr>
                                <tr class="border-bottom">
                                    <td class="text-nowrap text-heading">
                                        Robust Admin Template
                                    </td>
                                    <td class="text-nowrap">React Admin Template</td>
                                    <td>$66</td>
                                    <td>1</td>
                                    <td>$66.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 mb-md-0 mb-3">

                            </div>
                            <div class="col-md-6 d-flex justify-content-md-end mt-2">
                                <div class="invoice-calculations">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-150">Subtotal:</span>
                                        <h6 class="mb-0 pt-1">$1800</h6>
                                    </div>
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="w-px-150">IGV:</span>
                                        <h6 class="mb-0 pt-1">$28</h6>
                                    </div>
                                    <hr />
                                    <div class="d-flex justify-content-between">
                                        <span class="w-px-150">Total:</span>
                                        <h6 class="mb-0 pt-1">$1690</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <span class="fw-medium text-heading">Note:</span>
                                <span>It was a pleasure working with you and your team.
                                    We hope you will keep us in mind for future
                                    freelance projects. Thank You!</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Invoice -->
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
