"use strict";
$(function () {
        const csrfToken = $('meta[name="csrf-token"]').attr("content");
    var size = document.querySelector("#autosize-demo");
    let t, a, n;
    n = (
        isDarkStyle
            ? ((t = config.colors_dark.borderColor),
              (a = config.colors_dark.bodyBg),
              config.colors_dark)
            : ((t = config.colors.borderColor),
              (a = config.colors.bodyBg),
              config.colors)
    ).headingColor;
    let s = $(".datatables-users"),
        i = $(".select2"),
        m = $(".bootstrap-maxlength-example"),
        l = "Mi_Perfil",
        o = {
            1: { title: "Activo", class: "bg-label-success" },
            2: { title: "Inactivo", class: "bg-label-secondary" },
            3: { title: "Pendiente", class: "bg-label-warning" },
        };
    size && autosize(size),
        i.length &&
            i.each(function () {
                var i = $(this);
                select2Focus(i),
                    i.wrap('<div class="position-relative"></div>').select2({
                        dropdownParent: i.parent(),
                        placeholder: i.data("placeholder"),
                    });
            }),
        m.length &&
            m.each(function () {
                $(this).maxlength({
                    warningClass: "label label-success bg-success text-white",
                    limitReachedClass: "label label-danger",
                    separator: " de ",
                    preText: "Has escrito ",
                    postText: " caracteres disponibles.",
                    validate: !0,
                    threshold: +this.getAttribute("maxlength"),
                });
            }),
        s.length &&
            s.DataTable({
                ajax: "Products",
                columns: [
                    { data: "" },
                    { data: "id" },
                    { data: "code" },
                    { data: "name" },
                    { data: "extent" },
                    { data: "branch" },
                    { data: "category" },
                    { data: "stock" },
                    { data: "action" },
                ],
                columnDefs: [
                    {
                        className: "control",
                        searchable: !1,
                        orderable: !1,
                        responsivePriority: 2,
                        targets: 0,
                        render: function (e, t, a, n) {
                            return "";
                        },
                    },
                    {
                        targets: 1,
                        orderable: !1,
                        visible: !1,
                    },
                    {
                        targets: 2,
                        responsivePriority: 4,
                        render: function (e, t, a, n) {
                            return `<a href="javascript:void(0)"><span>#${e}</span></a>`;
                        },
                    },
                    {
                        targets: 3,
                        render: function (e, t, a, n) {
                            return (
                                '<span class="text-heading">' + e + "</span>"
                            );
                        },
                    },
                    {
                        targets: 4,
                        render: function (e, t, a, n) {
                            return e;
                            
                        },
                    },
                    {
                        targets: 5,
                        render: function (e, t, a, n) {
                            return (
                                '<span class="text-heading">' + e + "</span>"
                            );
                        },
                    },
                    {
                        targets: 6,
                        render: function (e, t, a, n) {
                            return e;
                        },
                    },
                    {
                        targets: -1,
                        title: "Acción",
                        searchable: !1,
                        orderable: !1,
                        render: function (e, t, a, n) {
                            return '<div class="d-flex align-items-center"><a href="javascript:;" data-bs-toggle="tooltip" class="text-body delete-record" data-bs-placement="top" title="Delete Invoice"><i class="mdi mdi-delete-outline mdi-20px mx-1"></i></a><a href="app-invoice-preview.html" data-bs-toggle="tooltip" class="text-body" data-bs-placement="top" title="Preview Invoice"><i class="mdi mdi-eye-outline mdi-20px mx-1"></i></a><div class="dropdown"><a href="javascript:;" class="btn dropdown-toggle hide-arrow text-body p-0" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical mdi-20px"></i></a><div class="dropdown-menu dropdown-menu-end"><a href="javascript:;" class="dropdown-item">Download</a><a href="app-invoice-edit.html" class="dropdown-item">Edit</a><a href="javascript:;" class="dropdown-item">Duplicate</a></div></div></div>';
                        },
                    },
                ],
                order: [[2, "desc"]],
                dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0 gap-3"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                language: {
                    sLengthMenu: "Show _MENU_",
                    search: "",
                    searchPlaceholder: "Buscar..",
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
                                    columns: [2, 3, 4, 5, 6],
                                    format: {
                                        body: function (e, t, a) {
                                            var n;
                                            return e.length <= 0
                                                ? e
                                                : ((e = $.parseHTML(e)),
                                                  (n = ""),
                                                  $.each(e, function (e, t) {
                                                      void 0 !== t.classList &&
                                                      t.classList.contains(
                                                          "user-name"
                                                      )
                                                          ? (n +=
                                                                t.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            t.innerText
                                                          ? (n += t.textContent)
                                                          : (n += t.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                                customize: function (e) {
                                    $(e.document.body)
                                        .css("color", n)
                                        .css("border-color", t)
                                        .css("background-color", a),
                                        $(e.document.body)
                                            .find("table")
                                            .addClass("compact")
                                            .css("color", "inherit")
                                            .css("border-color", "inherit")
                                            .css("background-color", "inherit");
                                },
                            },
                            {
                                extend: "csv",
                                text: '<i class="mdi mdi-file-document-outline me-1" ></i>Csv',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6],
                                    format: {
                                        body: function (e, t, a) {
                                            var n;
                                            return e.length <= 0
                                                ? e
                                                : ((e = $.parseHTML(e)),
                                                  (n = ""),
                                                  $.each(e, function (e, t) {
                                                      void 0 !== t.classList &&
                                                      t.classList.contains(
                                                          "user-name"
                                                      )
                                                          ? (n +=
                                                                t.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            t.innerText
                                                          ? (n += t.textContent)
                                                          : (n += t.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                            },
                            {
                                extend: "excel",
                                text: '<i class="mdi mdi-file-excel-outline me-1"></i>Excel',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6],
                                    format: {
                                        body: function (e, t, a) {
                                            var n;
                                            return e.length <= 0
                                                ? e
                                                : ((e = $.parseHTML(e)),
                                                  (n = ""),
                                                  $.each(e, function (e, t) {
                                                      void 0 !== t.classList &&
                                                      t.classList.contains(
                                                          "user-name"
                                                      )
                                                          ? (n +=
                                                                t.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            t.innerText
                                                          ? (n += t.textContent)
                                                          : (n += t.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                            },
                            {
                                extend: "pdf",
                                text: '<i class="mdi mdi-file-pdf-box me-1"></i>Pdf',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6],
                                    format: {
                                        body: function (e, t, a) {
                                            var n;
                                            return e.length <= 0
                                                ? e
                                                : ((e = $.parseHTML(e)),
                                                  (n = ""),
                                                  $.each(e, function (e, t) {
                                                      void 0 !== t.classList &&
                                                      t.classList.contains(
                                                          "user-name"
                                                      )
                                                          ? (n +=
                                                                t.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            t.innerText
                                                          ? (n += t.textContent)
                                                          : (n += t.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                            },
                            {
                                extend: "copy",
                                text: '<i class="mdi mdi-content-copy me-1"></i>Copy',
                                className: "dropdown-item",
                                exportOptions: {
                                    columns: [2, 3, 4, 5, 6],
                                    format: {
                                        body: function (e, t, a) {
                                            var n;
                                            return e.length <= 0
                                                ? e
                                                : ((e = $.parseHTML(e)),
                                                  (n = ""),
                                                  $.each(e, function (e, t) {
                                                      void 0 !== t.classList &&
                                                      t.classList.contains(
                                                          "user-name"
                                                      )
                                                          ? (n +=
                                                                t.lastChild
                                                                    .firstChild
                                                                    .textContent)
                                                          : void 0 ===
                                                            t.innerText
                                                          ? (n += t.textContent)
                                                          : (n += t.innerText);
                                                  }),
                                                  n);
                                        },
                                    },
                                },
                            },
                        ],
                    },
                    {
                        text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">Agregar</span>',
                        className:
                            "add-new btn btn-primary waves-effect waves-light",
                    },
                ],
                responsive: {
                    details: {
                        display: $.fn.dataTable.Responsive.display.modal({
                            header: function (e) {
                                return "Details of " + e.data().full_name;
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
                initComplete: function () {
                    this.api()
                        .columns(5)
                        .every(function () {
                            var t = this,
                                a = $(
                                    '<select id="branchID" class="select2 form-select text-capitalize" name="branchId"><option value=""> Mostrar Productos/Servicios en Todos los Almacenes</option></select>'
                                )
                                    .appendTo(".branch_product")
                                    .on("change", function () {
                                        var e = $.fn.dataTable.util.escapeRegex(
                                            $(this).val()
                                        );
                                        t.search(
                                            e ? "^" + e + "$" : "",
                                            !0,
                                            !1
                                        ).draw();
                                    });
                            a.select2({
                                dropdownParent: a.parent(),
                                placeholder: a.data("placeholder"),
                            });
                            t.data()
                                .unique()
                                .sort()
                                .each(function (e, t) {
                                    a.append(
                                        '<option value="' +
                                            e +
                                            '">' +
                                            e +
                                            "</option>"
                                    );
                                });
                        });
                },
            }),
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);
    $(".add-new").on("click", function () {
        $("#title-form").attr("data-i18n", "Add Product");
        $(".data-submit").text("GUARDAR");
        if ($("#branchID").val() == "") {
            Toast.fire({
                icon: "warning",
                title: "Selecciona una Sucursal",
            });
        } else {
            $("#addProductModal").modal("show");
        }
    });
    $("#generateCode").click(function () {
        $.ajax({
            url: "generateCode",
            method: "GET",
            data: { _token: csrfToken },
        })
            .done((response) => {
                $("#code_product").val(response.code);
            })
            .fail((error) => {
                console.log(error.responseText);
            });
    });
    $(".btn-detraction").click(function () {
        const isChecked = $(this).prop("checked");
        if (isChecked) {
            $(".detraction").removeAttr("style");
            $("#detraction").removeAttr("disabled");
        } else {
            $(".detraction").attr("style", "display:none");
            $("#detraction").attr("disabled", true);
        }
    });

    var e = document.querySelectorAll(".phone-mask"),
        fv,
        f = document.getElementById("productForm");

    fv = FormValidation.formValidation(f, {
        fields: {
            code: {
                validators: {
                    notEmpty: { message: "Genera un código" },
                },
            },
            name: {
                validators: {
                    notEmpty: { message: "Ingresa nombre de producto" },
                },
            },
            igv: {
                validators: {
                    notEmpty: { message: "Seleccion Tipo de IGV" },
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
        const method = $("#title-form").attr("data-i18n");
        if (method == "Edit User") {
            updateDataServe();
        } else {
            sendDataServe();
        }
    });

    function sendDataServe() {
        $.blockUI({
            message:
                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });
        const isChecked = $(".btn-detraction").prop("checked"),
            status = isChecked ? 1 : 0;
        const submitBtn = document.querySelector(".data-submit");
        const resetBtn = setLoadingState(submitBtn);
        const formData = new FormData(f);
        formData.append("_token", csrfToken);
        formData.append("branch", $("#branchID").val());
        formData.append("detract", status);

        fetch("newProduct", {
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
                Toast.fire({
                    icon: "success",
                    title: data.message,
                });
                console.log(data.message);
            })
            .catch((error) => {
                console.error("Error:", error.message);
            })
            .finally(() => {
                $.unblockUI();
                resetBtn();
            });
    }

    function updateDataServe() {
        $.blockUI({
            message:
                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            timeout: 1e3,
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });

        const submitBtn = document.querySelector(".data-submit");
        const resetBtn = setLoadingState(submitBtn);
        const formData = new FormData(f);
        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        fetch("updateUser", {
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
                s.DataTable().ajax.reload();
                $("#addProductModal").offcanvas("hide");
                Toast.fire({
                    icon: "success",
                    title: data.message,
                });
            })
            .catch((error) => {
                console.error("Error:", error.message);
            })
            .finally(() => {
                $.unblockUI();
                clearForm();
                resetBtn();
            });
    }

    function clearForm() {
        f.reset();
        fv.resetForm();
    }

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

    function getOffice(officeID) {
        if (officeID) {
            $.ajax({
                url: "Usuarios/roles",
                data: { id: officeID, _token: csrfToken },
                type: "POST",
                dataType: "json",
                async: false,
            }).done((data) => {
                $("#user-role").empty();
                $("#user-role").append(
                    '<option value="">Seleccionar Rol</option>'
                );
                $.each(data, function (key, value) {
                    $("#user-role").append(
                        '<option value="' +
                            value.id_rol +
                            '">' +
                            value.name_rol +
                            "</option>"
                    );
                });
            });
        } else {
            $("#user-role").empty();
            $("#user-role").append('<option value="">Seleccionar Rol</option>');
        }
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
