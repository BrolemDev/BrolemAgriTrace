"use strict";

!(function () {
    var e = [].slice.call(document.querySelectorAll(".card-collapsible")),
        l = [].slice.call(document.querySelectorAll(".card-expand")),
        s = [].slice.call(document.querySelectorAll(".card-close")),
        r = document.querySelectorAll(".dob-picker"),
        c = document.getElementById("sortable-4");
    e &&
        e.map(function (l) {
            l.addEventListener("click", (e) => {
                e.preventDefault(),
                    new bootstrap.Collapse(
                        l.closest(".card").querySelector(".collapse")
                    ),
                    l.closest(".card-header").classList.toggle("collapsed"),
                    Helpers._toggleClass(
                        l.firstElementChild,
                        "mdi-chevron-down",
                        "mdi-chevron-up"
                    );
            });
        }),
        l &&
            l.map(function (l) {
                l.addEventListener("click", (e) => {
                    e.preventDefault(),
                        Helpers._toggleClass(
                            l.firstElementChild,
                            "mdi-fullscreen",
                            "mdi-fullscreen-exit"
                        ),
                        l.closest(".card").classList.toggle("card-fullscreen");
                });
            }),
        document.addEventListener("keyup", (e) => {
            e.preventDefault(),
                "Escape" === e.key &&
                    (e = document.querySelector(".card-fullscreen")) &&
                    (Helpers._toggleClass(
                        e.querySelector(".card-expand").firstChild,
                        "mdi-fullscreen",
                        "mdi-fullscreen-exit"
                    ),
                    e.classList.toggle("card-fullscreen"));
        }),
        s &&
            s.map(function (l) {
                l.addEventListener("click", (e) => {
                    e.preventDefault(),
                        l.closest(".card").classList.add("d-none");
                });
            }),
        null !== c && Sortable.create(c, { animation: 500, handle: ".card" }),
        r &&
            r.forEach(function (e) {
                e.flatpickr({
                    monthSelectorType: "static",
                    defaultDate: new Date(),
                });
            });
})(),
    $(function () {
        let a = $("#dt-kardex"),
            s;
        const csrfToken = $('meta[name="csrf-token"]').attr("content");

        $("#product").select2({
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
                                data: { code: product.code_product },
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
        $("#product").on("select2:select", function (e) {
            var codeProduct = e.params.data.data.code;
            $("#codeP").val(codeProduct);
        });
        $("#branch").select2();

        a.length &&
            a.DataTable({
                columns: [
                    { data: "" },
                    { data: "created_at" },
                    { data: "detail_kardex" },
                    { data: "input_quantity" },
                    { data: "unit_cost" },
                    { data: "total_cost" },
                    { data: "output_quantity" },
                    { data: "unit_cost" },
                    { data: "total_cost" },
                    { data: "stock" },
                    { data: "type_kardex" },
                ],
                columnDefs: [
                    {
                        targets: 0,
                        render: function (e, t, a, n) {
                            return n.row + 1;
                        },
                    },
                    {
                        targets: 1,
                        className: "text-center",
                        render: function (e, t, a, n) {
                            return moment(e).format("DD/MM/YYYY HH:mm:ss");
                        },
                    },
                    {
                        targets: 2,
                        render: function (e, t, a, n) {
                            return renderDetailWithIconAndColor(
                                e,
                                a.type_kardex
                            );
                        },
                    },
                    {
                        targets: [3, 4, 5],
                        className: "text-center bg-success",
                        render: function (e, t, a, n) {
                            if (isEntryKardex(a.type_kardex)) {
                                return `<h6>${e}</h6>`;
                            } else {
                                return `<h6>0.00</h6>`;
                            }
                        },
                    },
                    {
                        targets: [6, 7, 8],
                        className: "text-center bg-info",
                        render: function (e, t, a, n) {
                            if (isExitKardex(a.type_kardex)) {
                                return `<h6>${e}</h6>`;
                            } else {
                                return `<h6>0.00</h6>`;
                            }
                        },
                    },
                    {
                        targets: -1,
                        visible: !1,
                    },
                ],
                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
            });

        let f = document.getElementById("form-kardex"),
            fv;

        fv = FormValidation.formValidation(f, {
            fields: {
                codeProduct: {
                    validators: {
                        notEmpty: {
                            message:
                                "Obligatorio ingresar un Código de Producto",
                        },
                    },
                },
                product: {
                    validators: {
                        notEmpty: {
                            message: "Debe seleccionar un producto",
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
                            case "code_product":
                            case "nameP":
                            case "igvId":
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
            blockUI();
            const formData = new FormData(f);

            fetch("table-kardex", {
                method: "post",
                body: formData,
            })
                .then((response) => {
                    if (!response.ok) {
                        throw new Error(
                            "Hubo un problema al procesar el formulario."
                        );
                    }
                    return response.json();
                })
                .then((data) => {
                    console.log(data);
                    a.DataTable().clear().draw();

                    data.forEach((item) => {
                        a.DataTable().row.add({
                            created_at: item.created_at,
                            detail_kardex: item.detail_kardex,
                            input_quantity: item.input_quantity,
                            unit_cost: item.unit_cost,
                            total_cost: item.total_cost,
                            output_quantity: item.output_quantity,
                            unit_cost: item.unit_cost,
                            total_cost: item.total_cost,
                            stock: item.stock,
                            type_kardex: item.type_kardex,
                        });
                    });

                    a.DataTable().draw();
                })
                .catch((error) => {
                    console.error("Error:", error.message);
                })
                .finally(() => {
                    $.unblockUI();
                });
        });

        function renderDetailWithIconAndColor(detail, type) {
            const iconsAndColors = {
                inventario_inicial: {
                    icon: '<i class="mdi mdi-database-arrow-up"></i>',
                    color: "success",
                    text: "Inventario Inicial",
                },
                compra: {
                    icon: '<i class="mdi mdi-folder-outline"></i>',
                    color: "success",
                    text: "Compra",
                },
                ingreso_transa: {
                    icon: '<i class="mdi mdi-alert-circle-outline"></i>',
                    color: "success",
                    text: "Ingreso Transa",
                },
                salida_transa: {
                    icon: '<i class="mdi mdi-check"></i>',
                    color: "info",
                    text: "Salida Transa",
                },
                venta: {
                    icon: '<i class="mdi mdi-chart-pie-outline"></i>',
                    color: "info",
                    text: "Venta",
                },
            };

            const { icon, color, text } = iconsAndColors[type] || {
                icon: '<i class="mdi mdi-arrow-down"></i>',
                color: "info",
                text: "Otros",
            };

            return (
                '<div class="d-flex justify-content-start align-items-center">' +
                '<div class="avatar-wrapper">' +
                '<div class="avatar avatar-sm me-2">' +
                '<span class="avatar-initial rounded-circle bg-label-' +
                color +
                '">' +
                icon +
                "</span>" +
                "</div></div>" +
                '<div class="d-flex flex-column gap-1">' +
                '<a href="pages-profile-user.html" class="text-truncate"><h6 class="mb-0">' +
                text +
                "</h6></a>" +
                '<small class="text-truncate">' +
                detail +
                "</small>" +
                "</div></div>"
            );
        }

        function isEntryKardex(type) {
            return (
                type === "inventario_inicial" ||
                type === "compra" ||
                type === "ingreso_transa" ||
                type === "ingreso_sindoc"
            );
        }

        function isExitKardex(type) {
            return (
                type === "salida_transa" ||
                type === "venta" ||
                type === "salida_sindoc"
            );
        }

        function blockUI() {
            $.blockUI({
                message:
                    '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                css: { backgroundColor: "transparent", border: "0" },
                overlayCSS: { opacity: 0.5 },
            });
        }
    });
