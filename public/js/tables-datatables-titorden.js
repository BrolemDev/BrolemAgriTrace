"use strict";
$(function () {
    var e,
        t = $(".table-products"),
        l = "app-user-list.html",
        ao = document.querySelector("#autosize-demo");
    autosize(ao);
    t.length &&
        (e = t.DataTable({
            lengthChange: !1,
            columns: [
                { data: "" },
                { data: "id" },
                { data: "idunit" },
                { data: "code" },
                { data: "name" },
                { data: "description" },
                { data: "unit" },
                { data: "weight" },
                { data: "quantity" },
                { data: "price" },
                { data: "" },
            ],
            columnDefs: [
                {
                    className: "control",
                    orderable: !1,
                    searchable: !1,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (e, t, a, n) {
                        return "";
                    },
                },
                { targets: [1, 2, 3, 4], searchable: !1, visible: !1 },
                {
                    targets: -1,
                    searchable: !1,
                    className: "text-center",
                    title: "Acciones",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return '<span class="text-nowrap"><button type="button" class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 btn-edit"><i class="mdi mdi-pencil-outline mdi-20px"></i></button><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon delete-record"><i class="mdi mdi-delete-outline mdi-20px"></i></button></span>';
                    },
                },
            ],
            language: {
                emptyTable: "No hay productos en la tabla",
                search: "Buscar",
                info: "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                infoEmpty: "Mostrando 0 a 0 de 0 entradas",
                infoFiltered: "(filtrado de un total de _MAX_ entradas)",
                paginate: {
                    previous: "Anterior",
                    next: "Siguiente",
                },
            },
            dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [
                {
                    text: "Agregar Producto",
                    className:
                        "add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#ModalProduct",
                    },
                    init: function (e, t, a) {
                        $(t).removeClass("btn-secondary");
                    },
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (e) {
                            return "Details of " + e.data().name;
                        },
                    }),
                    type: "column",
                    renderer: function (e, t, a) {
                        a = $.map(a, function (e, t) {
                            return "" !== e.title
                                ? '<tr data-dt-row="' +
                                      e.rowIndex +
                                      '" data-dt-column="' +
                                      e.columnIndex +
                                      '"><td>' +
                                      e.title +
                                      ":</td> <td>" +
                                      e.data +
                                      "</td></tr>"
                                : "";
                        }).join("");
                        return (
                            !!a &&
                            $('<table class="table"/><tbody />').append(a)
                        );
                    },
                },
            },
            initComplete: function () {},
        })),
        $(".table-products tbody").on("click", ".delete-record", function () {
            e.row($(this).parents("tr")).remove().draw();
        });

    let csrfToken = $('meta[name="csrf-token"]').attr("content");

    $("#type_oc").change(function () {
        if ($(this).val() == "1") {
            $("#file_subject").removeClass("hidden");
        } else {
            $("#file_subject").addClass("hidden");
        }
    });

    $("#store").on("change", function () {
        var selectedOption = $(this).find("option:selected");

        var address = selectedOption.data("address");
        var ubigeo = selectedOption.data("ubigeo");

        $("#address").val(address);

        if ($('#ubigeo option[value="' + ubigeo + '"]').length === 0) {
            var newOption = new Option(ubigeo, ubigeo, true, true);
            $("#ubigeo").append(newOption).trigger("change");
        } else {
            $("#ubigeo").val(ubigeo).trigger("change");
        }
    });

    $("#doc_supplier").select2({
        dropdownParent: $("#dataOC"),
        ajax: {
            url: "/scopeSupplier",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    query: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (row) {
                        return {
                            id: row.id_supplier,
                            text: row.ruc_supplier + " - " + row.name_supplier,
                            data: {
                                representative: row.representative,
                                address: row.address_supplier,
                                phone: row.phone_supplier,
                            },
                        };
                    }),
                };
            },
            cache: true,
        },
        placeholder: "Buscar un producto",
        minimumInputLength: 2,
        language: {
            inputTooShort: function () {
                return "Por favor ingrese 2 o más caracteres";
            },
            searching: function () {
                return "Buscando...";
            },
            noResults: function () {
                return "No se encontraron resultados";
            },
        },
    });

    $("#productApp").select2({
        dropdownParent: $("#ModalProduct"),
        ajax: {
            url: "/search-products",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    query: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (product) {
                        return {
                            id: product.id_product,
                            text: product.name_product,
                            data: {
                                code: product.code_product,
                                description: product.name_product,
                                unit: product.extent_id,
                                price_pen: product.price_pen,
                                price_usd: product.price_usd,
                            },
                        };
                    }),
                };
            },
            cache: true,
        },
        placeholder: "Buscar un producto",
        minimumInputLength: 2,
        language: {
            inputTooShort: function () {
                return "Por favor ingrese 2 o más caracteres";
            },
            searching: function () {
                return "Buscando...";
            },
            noResults: function () {
                return "No se encontraron resultados";
            },
        },
    });

    $("#productApp").on("select2:select", function (e) {
        var code = e.params.data.data.code;
        var description = e.params.data.data.description;
        var unit = e.params.data.data.unit;
        var priceS = e.params.data.data.price_pen;
        var priceD = e.params.data.data.price_usd;

        if ($("#coin").val() == "3") {
            $("#priceApp").val(priceS);
        } else {
            $("#priceApp").val(priceD);
        }

        $("#codeApp").val(code);
        $("#descrApp").val(description);
        $("#slctExtent").val(unit).trigger("change");
    });

    $("#ubigeo").select2({
        dropdownParent: $("#dataOC"),
        ajax: {
            url: "/scopeCodeUbigeo",
            dataType: "json",
            delay: 250,
            data: function (params) {
                return {
                    query: params.term,
                };
            },
            processResults: function (data) {
                return {
                    results: $.map(data, function (row) {
                        return {
                            id: row.codigo_ubigeo,
                            text: `${row.departamento} - ${row.provincia} - ${row.distrito}`,
                        };
                    }),
                };
            },
            cache: true,
        },
        placeholder: "Ubigeo Sucursal",
        minimumInputLength: 2,
        language: {
            searching: function () {
                return "Buscando...";
            },
            noResults: function () {
                return "No se encontraron resultados";
            },
        },
    });

    let f = document.getElementById("modalFormProduct"),
        fv;

    fv = FormValidation.formValidation(f, {
        fields: {
            productApp: {
                validators: {
                    notEmpty: {
                        message: "Debes seleccionar un producto",
                    },
                },
            },
            codeApp: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar código",
                    },
                },
            },
            descrApp: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar descripción",
                    },
                },
            },
            quantityApp: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar cantidad",
                    },
                },
            },
            weightApp: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar peso",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "",
                rowSelector: function (e, a) {
                    switch (e) {
                        case "formValidationConfirmPass":
                        case "formValidationFile":
                        case "formValidationDob":
                        case "formValidationSelect2":
                        case "formValidationLang":
                        case "formValidationTech":
                        case "formValidationHobbies":
                        case "formValidationBio":
                        case "formValidationGender":
                            return ".col-md-6";
                        case "formValidationPlan":
                            return ".col-xl-3";
                        case "formValidationSwitch":
                        case "formValidationCheckbox":
                            return ".col-12";
                        default:
                            return ".row";
                    }
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    fv.on("core.form.valid", function () {
        var codeValue = $("#codeApp").val();

        // Buscar todas las filas con el código dado
        var rowsToEdit = e.rows(function (idx, data, node) {
            return data.code === codeValue;
        });

        // Iterar sobre las filas encontradas y actualizarlas
        rowsToEdit.every(function () {
            this.data().id = $("#productApp").val();
            this.data().idunit = $("#slctExtent").val();
            this.data().name = $("#productApp").find("option:selected").text();
            this.data().description = $("#descrApp").val();
            this.data().unit = $("#slctExtent").find("option:selected").text();
            this.data().weight = $("#weightApp").val();
            this.data().quantity = $("#quantityApp").val();
            this.data().price = $("#priceApp").val();
            this.invalidate();
        });

        // Si no se encontraron filas para editar, agregar una nueva fila
        if (rowsToEdit.count() === 0) {
            e.row
                .add({
                    id: $("#productApp").val(),
                    idunit: $("#slctExtent").val(),
                    code: codeValue,
                    name: $("#productApp").find("option:selected").text(),
                    description: $("#descrApp").val(),
                    unit: $("#slctExtent").find("option:selected").text(),
                    weight: $("#weightApp").val(),
                    quantity: $("#quantityApp").val(),
                    price: $("#priceApp").val(),
                })
                .draw();
        } else {
            e.draw(false); // Redibujar el DataTable para aplicar los cambios
        }

        $("#ModalProduct").modal("hide");
    });

    $("#coin").on("change", function () {
        var coin = $(this).val();
        if (coin == "3") {
            $("#currency").text("S/.");
        } else {
            $("#currency").text("$");
        }
    });

    $("#doc_supplier").on("select2:select", function (e) {
        var addres = e.params.data.data.address;
        var phone = e.params.data.data.phone;
        var representative = e.params.data.data.representative;

        $("#representative").val(representative);
        $("#phone").val(phone);
    });

    $("#ModalProduct").on("hidden.bs.modal", function () {
        resetForm();
    });

    e.on("click", ".btn-edit", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        const defaultValues = {
            "#descrApp": rowData.description,
            "#codeApp": rowData.code,
            "#quantityApp": rowData.quantity,
            "#weightApp": rowData.weight,
            "#slctExtent": rowData.idunit,
        };

        console.log(getTableData());
        var newOption = new Option(rowData.name, rowData.id, true, true);
        $("#productApp").append(newOption).trigger("change");

        $.each(defaultValues, function (selector, value) {
            $(selector).val(value).trigger("change");
        });

        $("#ModalProduct").modal("show");
    });

    let o = document.getElementById("formOC"),
        ov;

    ov = FormValidation.formValidation(o, {
        fields: {
            doc_supplier: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar RUC del proveedor",
                    },
                },
            },
            delivery_time: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar el tiempo de entrega",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "",
                rowSelector: function (e, a) {
                    switch (e) {
                        case "formValidationConfirmPass":
                        case "formValidationFile":
                        case "formValidationDob":
                        case "formValidationSelect2":
                        case "formValidationLang":
                        case "formValidationTech":
                        case "formValidationHobbies":
                        case "formValidationBio":
                        case "formValidationGender":
                            return ".col-md-6";
                        case "formValidationPlan":
                            return ".col-xl-3";
                        case "formValidationSwitch":
                        case "formValidationCheckbox":
                            return ".col-12";
                        default:
                            return ".row";
                    }
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    ov.on("core.form.valid", function () {
        sendDataServer();
    });

    $("#ModalTransfer").on("hidden.bs.modal", function () {
        location.reload();
    });

    function sendDataServer() {
        // Bloquear UI al iniciar la petición
        $.blockUI({
            message: `
        <div class="d-flex justify-content-center">
            <p class="mb-0">Guardando...</p>
            <div class="sk-wave m-0">
                <div class="sk-rect sk-wave-rect"></div>
                <div class="sk-rect sk-wave-rect"></div>
                <div class="sk-rect sk-wave-rect"></div>
                <div class="sk-rect sk-wave-rect"></div>
                <div class="sk-rect sk-wave-rect"></div>
            </div>
        </div>`,
            css: {
                backgroundColor: "transparent",
                color: "#fff",
                border: "0",
            },
            overlayCSS: {
                opacity: 0.5,
            },
        });

        // Crear formData y agregar CSRF token
        let formData = new FormData(o); // 'o' es el formulario
        formData.append("_token", csrfToken); // Agregar el token de CSRF

        // Obtener los datos de la tabla y agregarlos a formData
        let tableData = getTableData(); // Función que devuelve los datos de la tabla
        formData.append("tableData", JSON.stringify(tableData)); // Convertir en JSON

        let redirectId = null; // Variable para almacenar el id para la redirección

        // Enviar la solicitud con fetch
        fetch("newOC", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                // Si la respuesta no es OK, manejar el error
                if (!response.ok) {
                    return response.text().then((text) => {
                        throw new Error(text);
                    });
                }
                return response.json(); // Parsear la respuesta como JSON
            })
            .then((data) => {
                // Guardar el ID en una variable para usarlo más adelante
                if (data.id) {
                    redirectId = data.id;
                }
            })
            .catch((error) => {
                // Manejar cualquier error que ocurra en el proceso
                console.error("Error:", error.message);
                alert("Error: " + error.message); // Mostrar alerta con el mensaje de error
            })
            .finally(() => {
                // Mostrar el mensaje final de éxito y desbloquear la UI
                $.blockUI({
                    message: '<div class="p-3 bg-success">La OC se ha agregado correctamente</div>',
                    timeout: 500, // Mostrar el mensaje de éxito por 500 ms
                    css: {
                        backgroundColor: "transparent",
                        color: "#fff",
                        border: "0",
                    },
                    overlayCSS: {
                        opacity: 0.5,
                    },
                    onUnblock: function () {
                        // Redirigir solo después de que se haya desbloqueado la UI
                        if (redirectId) {
                            window.location.href = "/Adjuntos/" + redirectId;
                        }
                        $.unblockUI(); // Desbloquear la UI
                    },
                });
            });
    }

    function getTableData() {
        let tableData = [];
        e.rows().every(function (rowIdx, tableLoop, rowLoop) {
            let data = this.data();
            tableData.push(data);
        });
        return tableData;
    }

    function resetForm() {
        const defaultValues = {
            "#productApp": null,
            "#descrApp": "",
            "#codeApp": "",
            "#quantityApp": "1",
            "#weightApp": "1",
            "#slctExtent": "1",
        };

        $.each(defaultValues, function (selector, value) {
            $(selector).val(value).trigger("change");
        });
        var formValidation = $("#modalFormProduct").data("formValidation");
        if (formValidation) {
            formValidation.resetForm(true);
        }
    }

    function blockUI() {
        $.blockUI({
            message:
                '<div class="d-flex justify-content-center"><div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
            timeout: 1e3,
            css: {
                backgroundColor: "transparent",
                color: "#fff",
                border: "0",
            },
            overlayCSS: { opacity: 0.5 },
        });
    }

    const Toast = Swal.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
});
