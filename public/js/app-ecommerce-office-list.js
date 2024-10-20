"use strict";
const commentEditor = document.querySelector(".comment-editor");
commentEditor &&
    new Quill(commentEditor, {
        modules: { toolbar: ".comment-toolbar" },
        placeholder: "Ingrese la descripción de la categoría...",
        theme: "snow",
    }),
    $(function () {
        let e, n, s;
        s = (
            isDarkStyle
                ? ((e = config.colors_dark.borderColor),
                  (n = config.colors_dark.bodyBg),
                  config.colors_dark)
                : ((e = config.colors.borderColor),
                  (n = config.colors.bodyBg),
                  config.colors)
        ).headingColor;
        let t = $(".datatables-category-list"),
            o = $(".select2");
        o.length &&
            o.each(function () {
                var t = $(this);
                select2Focus(t),
                    t.wrap('<div class="position-relative"></div>').select2({
                        dropdownParent: t.parent(),
                        placeholder: t.data("placeholder"),
                    });
            }),
            t.length &&
                (t.DataTable({
                    ajax: "Offices",
                    columns: [
                        { data: "" },
                        { data: "id" },
                        { data: "name" },
                        { data: "status" },
                        { data: "" },
                    ],
                    columnDefs: [
                        {
                            className: "control",
                            searchable: !1,
                            orderable: !1,
                            responsivePriority: 1,
                            targets: 0,
                            render: function (t, e, n, s) {
                                return "";
                            },
                        },
                        {
                            targets: 2,
                            responsivePriority: 2,
                            render: function (t, e, n, s) {
                                var o = n.name,
                                    a = n.description,
                                    r = n.image,
                                    i = n.id;
                                return (
                                    '<div class="d-flex flex-column justify-content-center">' +
                                    '<span class="text-heading fw-medium text-wrap">' +
                                    (o || "") +
                                    "</span>" +
                                    '<small class="text-truncate mb-0 d-none d-sm-block">' +
                                    (a || "") +
                                    "</small>" +
                                    "</div></div>"
                                );
                            },
                        },
                        {
                            targets: 3,
                            responsivePriority: 3,
                            render: function (t, e, n, s) {
                                const checkedAttribute =
                                    t === 1 ? "checked" : "";
                                return (
                                    '<label class="switch switch-lg"><input type="checkbox" class="switch-input btn-status" ' +
                                    checkedAttribute +
                                    '><span class="switch-toggle-slider"><span class="switch-on"></span><span class="switch-off"></span></span></label>'
                                );
                            },
                        },
                        {
                            targets: -1,
                            title: "Actions",
                            searchable: !1,
                            orderable: !1,
                            render: function (t, e, n, s) {
                                return '<div class="d-flex align-items-sm-center justify-content-sm-center"><button class="btn btn-sm btn-icon btn-edit"><i class="mdi mdi-pencil-outline"></i></button>';
                            },
                        },
                    ],
                    order: [0, "desc"],
                    dom: '<"card-header d-flex rounded-0 flex-wrap py-md-0"<"me-5 ms-n2"f><"d-flex justify-content-start justify-content-md-end align-items-baseline"<"dt-action-buttons d-flex align-items-start align-items-md-center justify-content-sm-center mb-3 mb-sm-0 gap-3"lB>>>t<"row mx-1"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                    lengthMenu: [7, 10, 20, 50, 70, 100],
                    language: {
                        sLengthMenu: "_MENU_",
                        search: "",
                        searchPlaceholder: "Buscar Oficina",
                    },
                    buttons: [
                        {
                            extend: "collection",
                            className:
                                "btn btn-label-secondary dropdown-toggle me-3 waves-effect waves-light",
                            text: '<i class="mdi mdi-export-variant me-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                            buttons: [
                                {
                                    extend: "print",
                                    text: '<i class="mdi mdi-printer-outline me-1" ></i>Print',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: [1, 2],
                                        format: {
                                            body: function (t, e, n) {
                                                var s;
                                                return t.length <= 0
                                                    ? t
                                                    : ((t = $.parseHTML(t)),
                                                      (s = ""),
                                                      $.each(
                                                          t,
                                                          function (t, e) {
                                                              void 0 !==
                                                                  e.classList &&
                                                              e.classList.contains(
                                                                  "user-name"
                                                              )
                                                                  ? (s +=
                                                                        e
                                                                            .lastChild
                                                                            .firstChild
                                                                            .textContent)
                                                                  : void 0 ===
                                                                    e.innerText
                                                                  ? (s +=
                                                                        e.textContent)
                                                                  : (s +=
                                                                        e.innerText);
                                                          }
                                                      ),
                                                      s);
                                            },
                                        },
                                    },
                                    customize: function (t) {
                                        $(t.document.body)
                                            .css("color", s)
                                            .css("border-color", e)
                                            .css("background-color", n),
                                            $(t.document.body)
                                                .find("table")
                                                .addClass("compact")
                                                .css("color", "inherit")
                                                .css("border-color", "inherit")
                                                .css(
                                                    "background-color",
                                                    "inherit"
                                                );
                                    },
                                },
                                {
                                    extend: "csv",
                                    text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        format: {
                                            body: function (t, e, n) {
                                                var s;
                                                return t.length <= 0
                                                    ? t
                                                    : ((t = $.parseHTML(t)),
                                                      (s = ""),
                                                      $.each(
                                                          t,
                                                          function (t, e) {
                                                              void 0 !==
                                                                  e.classList &&
                                                              e.classList.contains(
                                                                  "user-name"
                                                              )
                                                                  ? (s +=
                                                                        e
                                                                            .lastChild
                                                                            .firstChild
                                                                            .textContent)
                                                                  : void 0 ===
                                                                    e.innerText
                                                                  ? (s +=
                                                                        e.textContent)
                                                                  : (s +=
                                                                        e.innerText);
                                                          }
                                                      ),
                                                      s);
                                            },
                                        },
                                    },
                                },
                                {
                                    extend: "excel",
                                    text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        format: {
                                            body: function (t, e, n) {
                                                var s;
                                                return t.length <= 0
                                                    ? t
                                                    : ((t = $.parseHTML(t)),
                                                      (s = ""),
                                                      $.each(
                                                          t,
                                                          function (t, e) {
                                                              void 0 !==
                                                                  e.classList &&
                                                              e.classList.contains(
                                                                  "user-name"
                                                              )
                                                                  ? (s +=
                                                                        e
                                                                            .lastChild
                                                                            .firstChild
                                                                            .textContent)
                                                                  : void 0 ===
                                                                    e.innerText
                                                                  ? (s +=
                                                                        e.textContent)
                                                                  : (s +=
                                                                        e.innerText);
                                                          }
                                                      ),
                                                      s);
                                            },
                                        },
                                    },
                                },
                                {
                                    extend: "pdf",
                                    text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        format: {
                                            body: function (t, e, n) {
                                                var s;
                                                return t.length <= 0
                                                    ? t
                                                    : ((t = $.parseHTML(t)),
                                                      (s = ""),
                                                      $.each(
                                                          t,
                                                          function (t, e) {
                                                              void 0 !==
                                                                  e.classList &&
                                                              e.classList.contains(
                                                                  "user-name"
                                                              )
                                                                  ? (s +=
                                                                        e
                                                                            .lastChild
                                                                            .firstChild
                                                                            .textContent)
                                                                  : void 0 ===
                                                                    e.innerText
                                                                  ? (s +=
                                                                        e.textContent)
                                                                  : (s +=
                                                                        e.innerText);
                                                          }
                                                      ),
                                                      s);
                                            },
                                        },
                                    },
                                },
                                {
                                    extend: "copy",
                                    text: '<i class="mdi mdi-content-copy me-1"></i>Copy',
                                    className: "dropdown-item",
                                    exportOptions: {
                                        columns: [1, 2, 3, 4, 5],
                                        format: {
                                            body: function (t, e, n) {
                                                var s;
                                                return t.length <= 0
                                                    ? t
                                                    : ((t = $.parseHTML(t)),
                                                      (s = ""),
                                                      $.each(
                                                          t,
                                                          function (t, e) {
                                                              void 0 !==
                                                                  e.classList &&
                                                              e.classList.contains(
                                                                  "user-name"
                                                              )
                                                                  ? (s +=
                                                                        e
                                                                            .lastChild
                                                                            .firstChild
                                                                            .textContent)
                                                                  : void 0 ===
                                                                    e.innerText
                                                                  ? (s +=
                                                                        e.textContent)
                                                                  : (s +=
                                                                        e.innerText);
                                                          }
                                                      ),
                                                      s);
                                            },
                                        },
                                    },
                                },
                            ],
                        },
                        {
                            text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Agregar</span>',
                            className:
                                "add-new btn btn-primary ms-n1 waves-effect waves-light",
                            attr: {
                                "data-bs-toggle": "offcanvas",
                                "data-bs-target":
                                    "#offcanvasEcommerceCategoryList",
                            },
                        },
                    ],
                    responsive: {
                        details: {
                            display: $.fn.dataTable.Responsive.display.modal({
                                header: function (t) {
                                    return "Details of " + t.data().categories;
                                },
                            }),
                            type: "column",
                            renderer: function (t, e, n) {
                                n = $.map(n, function (t, e) {
                                    return "" !== t.title
                                        ? '<tr data-dt-row="' +
                                              t.rowIndex +
                                              '" data-dt-column="' +
                                              t.columnIndex +
                                              '"><td> ' +
                                              t.title +
                                              ':</td> <td class="ps-0">' +
                                              t.data +
                                              "</td></tr>"
                                        : "";
                                }).join("");
                                return (
                                    !!n &&
                                    $('<table class="table"/><tbody />').append(
                                        n
                                    )
                                );
                            },
                        },
                    },
                }),
                $(".dataTables_length").addClass("mt-0 mt-md-3"),
                $(".dt-action-buttons").addClass("pt-0")),
            setTimeout(() => {
                $(".dataTables_filter .form-control").removeClass(
                    "form-control-sm"
                ),
                    $(".dataTables_length .form-select").removeClass(
                        "form-select-sm"
                    );
            }, 300);
        $(".add-new").on("click", function () {
            $(".offcanvas-title")
                .attr("data-i18n", "Add Category")
                .text("Agregar Oficina");
            $(".data-submit").text("AGREGAR");
        });
        t.on("click", ".btn-status", function () {
            $.blockUI({
                message:
                    '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                css: { backgroundColor: "transparent", border: "0" },
                overlayCSS: { opacity: 0.5 },
            });
            let row = $(this).closest("tr");
            let rowData = $(this).closest("table").DataTable().row(row).data(),
                isChecked = $(this).prop("checked");

            let id = rowData.id,
                status = isChecked ? "1" : "0";

            let csrfToken = $('meta[name="csrf-token"]').attr("content");
            let formData = {
                id: id,
                status: status,
                _token: csrfToken, // Agregar el token CSRF aquí
            };

            $.ajax({
                url: "status",
                method: "POST",
                data: formData,
                dataType: "json",
            })
                .done(function (response) {
                    if (response.success) {
                        Toast.fire({
                            icon: "success",
                            title: "Estado de Oficina actualizada correctamente",
                        });
                    } else {
                        console.error(
                            "Hubo un error al actualizar la categoría:",
                            response.error
                        );
                    }
                })
                .fail(function (xhr, status, error) {
                    console.error("Hubo un error en la solicitud AJAX:", error);
                })
                .always(function () {
                    $.unblockUI();
                });
        });
        t.on("click", ".btn-edit", function () {
            let row = $(this).closest("tr");
            let rowData = $(this).closest("table").DataTable().row(row).data();

            $("#offcanvasEcommerceCategoryListLabel")
                .attr("data-i18n", "Edit Office")
                .text("Editar Oficina");
            $("#ecommerce-category-title").val(rowData.name);
            $("#categoryDescription .ql-editor").html(rowData.description);

            $("#offcanvasEcommerceCategoryList").offcanvas("show");
            $("#categoryId").val(rowData.id);
            $(".data-submit").text("EDITAR");
        });

        const f = document.getElementById("eCommerceCategoryListForm");

        const fv = FormValidation.formValidation(f, {
            fields: {
                categoryTitle: {
                    validators: {
                        notEmpty: {
                            message: "Porfavor ingresar nombre de oficina",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "is-valid",
                    rowSelector: function (t, e) {
                        return ".mb-4";
                    },
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
        });

        fv.on("core.form.valid", function () {
            const method = $("#offcanvasEcommerceCategoryListLabel").attr(
                "data-i18n"
            );
            if (method == "Edit Office") {
                updateDataServe();
            } else {
                sendDataServe();
            }
        });

        function sendDataServe() {
            const submitBtn = document.querySelector(".data-submit");

            const resetBtn = setLoadingState(submitBtn);

            const formData = new FormData(f);
            const descriptionContent = $(
                "#categoryDescription .ql-editor"
            ).html();
            formData.append("description", descriptionContent);
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );

            fetch("insertOffice", {
                method: "POST",
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
                    f.reset();
                    document
                        .getElementById("ecommerce-category-title")
                        .classList.remove("is-valid");
                    t.DataTable().ajax.reload();
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    $("#offcanvasEcommerceCategoryList").offcanvas("hide");
                    clearEditorContent();
                })
                .catch((error) => {
                    console.error("Error:", error.message);
                })
                .finally(() => {
                    resetBtn();
                });
        }

        function updateDataServe() {
            const submitBtn = document.querySelector(".data-submit");
            const resetBtn = setLoadingState(submitBtn);
            const formData = new FormData(f);
            const descriptionContent = $(
                "#categoryDescription .ql-editor"
            ).html();
            formData.append("description", descriptionContent);
            formData.append(
                "_token",
                $('meta[name="csrf-token"]').attr("content")
            );

            fetch("updateOffice", {
                method: "POST",
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
                    $("#offcanvasEcommerceCategoryList").offcanvas("hide");
                    f.reset();
                    t.DataTable().ajax.reload();
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    document
                        .getElementById("ecommerce-category-title")
                        .classList.remove("is-valid");
                    clearEditorContent();
                })
                .catch((error) => {
                    console.error("Error:", error.message);
                })
                .finally(() => {
                    resetBtn();
                });
        }

        // Función para cambiar el estilo del botón durante la carga y deshabilitarlo
        function setLoadingState(btnElement) {
            // Guardar el estado original del botón
            const originalContent = btnElement.innerHTML;
            const originalDisabled = btnElement.disabled;

            // Cambiar el contenido del botón a un spinner y "Loading..."
            btnElement.innerHTML =
                '<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Cargando...';
            btnElement.disabled = true;

            // Devolver la función para restaurar el contenido original del botón y habilitarlo nuevamente
            return function resetBtn() {
                btnElement.innerHTML = originalContent;
                btnElement.disabled = originalDisabled;
            };
        }

        function clearEditorContent() {
            const commentEditor = document.querySelector(".comment-editor");
            if (commentEditor) {
                const quill = new Quill(commentEditor, {
                    modules: { toolbar: ".comment-toolbar" },
                    placeholder: "Ingrese la descripción de la oficina...",
                    theme: "snow",
                });
                quill.setText("");
            }
        }
        const Toast = Swal.mixin({
            toast: true,
            position: "top",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            },
        });
    });
