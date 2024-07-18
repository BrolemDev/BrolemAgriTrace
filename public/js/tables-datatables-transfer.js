"use strict";
$(function () {
    var e,
        t = $(".table-products"),
        l = "app-user-list.html";
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
                        return '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 btn-edit"><i class="mdi mdi-pencil-outline mdi-20px"></i></button><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon delete-record"><i class="mdi mdi-delete-outline mdi-20px"></i></button></span>';
                    },
                },
            ],
            dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            buttons: [
                {
                    text: "Agregar",
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

    $(".select-search").select2({
        dropdownParent: $("#formTransfer"),
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
        placeholder: "Buscar un ubigeo",
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
            searching: function () {
                return "Buscando...";
            },
            noResults: function () {
                return "No se encontraron resultados";
            },
        },
    });

    //Obtener los datos del destinatario

    $("#getDestiny").on("click", function (e) {
        blockUI();

        let formData = new FormData();
        formData.append("_token", csrfToken);
        formData.append("doc", "6");
        formData.append("number", $("#ruc_destiny").val());

        fetch("getDoc", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    return response.json().then((data) => {
                        throw new Error(data.message || "Error desconocido");
                    });
                }
                return response.json();
            })
            .then((data) => {
                if (data.status === "success") {
                    $("#reason_destiny").val(data.data.razonSocial);
                    console.log(data.data);
                } else {
                    throw new Error(data.message || "Error desconocido");
                }
            })
            .catch((error) => {
                console.error("Error:", error.message);
                $("#reason_destiny").val("");
                Toast.fire({
                    icon: "error",
                    title: error.message,
                });
            })
            .finally(() => {
                $.unblockUI();
            });
    });

    $("#getTransport").on("click", function (e) {
        blockUI();
        console.log($("#doc_transport").val());
        console.log($("#number_transport").val());

        let formData = new FormData();
        formData.append("_token", csrfToken);
        formData.append("doc", $("#doc_transport").val());
        formData.append("number", $("#number_transport").val());

        fetch("getDoc", {
            method: "POST",
            body: formData,
        })
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error en la solicitud");
                }
                return response.json();
            })
            .then((data) => {
                if (data.status === "success") {
                    if ($("#doc_transport").val() == "6") {
                        $("#names_transport").val(data.data.razonSocial);
                    } else if ($("#doc_transport").val() == "1") {
                        $("#names_transport").val(
                            `${data.data.nombres} ${data.data.apellidoPaterno} ${data.data.apellidoMaterno}`
                        );
                    }
                    console.log(data.data);
                } else {
                    throw new Error(data.message || "Error desconocido");
                }
            })
            .catch((error) => {
                console.error("Error:", error.message);
                $("#names_transport").val();
                Toast.fire({
                    icon: "error",
                    title: error.message,
                });
            })
            .finally(() => {
                $.unblockUI();
            });
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
                })
                .draw();
        } else {
            e.draw(false); // Redibujar el DataTable para aplicar los cambios
        }

        $("#ModalProduct").modal("hide");
    });

    $("#productApp").on("select2:select", function (e) {
        var code = e.params.data.data.code;
        var description = e.params.data.data.description;
        var unit = e.params.data.data.unit;

        $("#codeApp").val(code);
        $("#descrApp").val(description);
        $("#slctExtent").val(unit).trigger("change");
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

        var newOption = new Option(rowData.name, rowData.id, true, true);
        $("#productApp").append(newOption).trigger("change");

        $.each(defaultValues, function (selector, value) {
            $(selector).val(value).trigger("change");
        });

        $("#ModalProduct").modal("show");
    });

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
