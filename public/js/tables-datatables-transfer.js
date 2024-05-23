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
        e.row
            .add({
                id: $("#productApp").val(),
                idunit: $("#slctExtent").val(),
                code: $("#codeApp").val(),
                name: $("#productApp").find("option:selected").text(),
                description: $("#descrApp").val(),
                unit: $("#slctExtent").find("option:selected").text(),
                weight: $("#weightApp").val(),
                quantity: $("#quantityApp").val(),
            })
            .draw();
        console.log(e.rows().data());
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
});
