"use strict";
$(function () {
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    var e,
        t = $(".datatables-permissions");
    t.length &&
        (e = t.DataTable({
            ajax: "getBranchs",
            columns: [
                { data: "" },
                { data: "id" },
                { data: "anexo" },
                { data: "name" },
                { data: "address" },
                { data: "phone" },
                { data: "email" },
                { data: "status" },
                { data: "" },
            ],
            columnDefs: [
                {
                    className: "control",
                    orderable: !1,
                    searchable: !1,
                    responsivePriority: 1,
                    targets: 0,
                    render: function (e, t, a, n) {
                        return "";
                    },
                },
                { targets: 1, searchable: !1, visible: !1 },
                {
                    targets: 2,
                    responsivePriority: 1,
                    render: function (e, t, a, n) {
                        return (
                            '<span class="text-nowrap text-heading">' +
                            e +
                            "</span>"
                        );
                    },
                },
                {
                    targets: 3,
                    responsivePriority: 1,
                    render: function (e, t, a, n) {
                        return (
                            '<span class="emp_name text-truncate text-heading fw-medium">' +
                            e +
                            "</span>"
                        );
                    },
                },

                {
                    targets: 4,
                    orderable: !1,
                    className: "text-center",
                    render: function (e, t, a, n) {
                        return e;
                    },
                },
                {
                    targets: 5,
                    className: "text-center",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return e;
                    },
                },
                {
                    targets: 7,
                    render: function (e, t, a, n) {
                        const checkedAttribute = e === 1 ? "checked" : "";
                        return (
                            '<label class="switch switch-lg"><input type="checkbox" class="switch-input btn-status" ' +
                            checkedAttribute +
                            '><span class="switch-toggle-slider"><span class="switch-on"></span><span class="switch-off"></span></span></label>'
                        );
                    },
                },
                {
                    targets: -1,
                    searchable: !1,
                    title: "Actions",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2 btn-edit"><i class="mdi mdi-pencil-outline mdi-20px"></i></button><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon delete-record"><i class="mdi mdi-delete-outline mdi-20px"></i></button></span>';
                    },
                },
            ],
            order: [[1, "asc"]],
            dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "Mostrar _MENU_",
                search: "Buscar",
                searchPlaceholder: "Buscar Sucursal..",
            },
            buttons: [
                {
                    text: "<span class='mdi mdi-plus'></span> Agregar Sucursal",
                    className:
                        "add-new btn btn-primary mb-3 mb-md-0 waves-effect waves-light btn-add",
                    attr: {
                        "data-bs-toggle": "modal",
                        "data-bs-target": "#addPermissionModal",
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
                            return e.data().name;
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
        })),
        $(".datatables-permissions tbody").on(
            "click",
            ".delete-record",
            function () {
                let row = $(this).closest("tr");
                let rowData = $(this)
                    .closest("table")
                    .DataTable()
                    .row(row)
                    .data();
                e.row($(this).parents("tr")).remove().draw();
                $.ajax({
                    url: "deleteBranch",
                    type: "POST",
                    data: {
                        id: rowData.id,
                        _token: csrfToken,
                    },
                    success: function (data) {
                        if (data.success) {
                            Toast.fire({
                                icon: "success",
                                title: data.message,
                            });
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error(xhr.responseText);
                    },
                });
            }
        );
    $(".btn-add").on("click", function () {
        $("#title-form").text("Agregar Sucursal");
        $("#title-form").attr("data-i18n", "Add Branch");
        closeForm();
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
            status = isChecked ? "1" : "0",
            csrfToken = $('meta[name="csrf-token"]').attr("content");

        let formData = {
            id: id,
            status: status,
            _token: csrfToken, // Agregar el token CSRF aquí
        };

        $.ajax({
            url: "statusBranch",
            method: "POST",
            data: formData,
            dataType: "json",
        })
            .done(function (response) {
                Toast.fire({
                    icon: response.type,
                    title: response.message,
                });
            })
            .fail(function (xhr, status, error) {
                console.error("Hubo un error en la solicitud AJAX:", error);
            })
            .always(function () {
                $.unblockUI();
            });
    });

    e.on("click", ".btn-edit", function () {
        closeForm();
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();
        $("#branch").val(rowData.id);
        $("#anexo").val(rowData.anexo);
        $("#name").val(rowData.name);
        $("#address").val(rowData.address);
        $("#mail").val(rowData.email);
        $("#urbanization").val(rowData.urbanization);
        $("#phone").val(rowData.phone);
        $("#address").val(rowData.address);
        $("#ubigeo").val(rowData.ubigeo);
        $("#title-form").text("Editar Sucursal");
        $("#title-form").attr("data-i18n", "Edit Branch");
        $("#addPermissionModal").modal("show");
    });

    let f = document.getElementById("branchForm");

    let fv = FormValidation.formValidation(f, {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: "Ingresar nombre de sucursal",
                    },
                },
            },
            address: {
                validators: {
                    notEmpty: {
                        message: "Ingresar dirección",
                    },
                },
            },
            address: {
                validators: {
                    notEmpty: {
                        message: "Ingresar ubigeo",
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: "",
                rowSelector: function (field, ele) {
                    return ".form-floating-outline";
                },
            }),
            submitButton: new FormValidation.plugins.SubmitButton(),
            autoFocus: new FormValidation.plugins.AutoFocus(),
        },
    });

    fv.on("core.form.valid", function () {
        const method = $("#title-form").attr("data-i18n");
        if (method == "Edit Branch") {
            updateDataServe();
        } else {
            sendDataServe();
        }
    });

    function sendDataServe() {
        const submitBtn = document.querySelector(".data-submit");

        const resetBtn = setLoadingState(submitBtn);

        const formData = new FormData(f);

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        fetch("insertBranch", {
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
                if (data.status === 200) {
                    e.ajax.reload();
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    closeForm();
                    $("#addPermissionModal").modal("hide");
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
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

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        fetch("updateBranch", {
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
                if (data.status === 200) {
                    e.ajax.reload();
                    Toast.fire({
                        icon: "success",
                        title: data.message,
                    });
                    closeForm();
                    $("#addPermissionModal").modal("hide");
                } else {
                    Toast.fire({
                        icon: "error",
                        title: data.message,
                    });
                }
            })
            .catch((error) => {
                console.error("Error:", error.message);
            })
            .finally(() => {
                resetBtn();
            });
    }

    function closeForm() {
        f.reset();
        fv.resetForm();
    }

    function setLoadingState(btnElement) {
        const originalContent = btnElement.innerHTML;
        const originalDisabled = btnElement.disabled;

        btnElement.innerHTML =
            '<span class="spinner-border me-1" role="status" aria-hidden="true"></span>Cargando...';
        btnElement.disabled = true;

        return function resetBtn() {
            btnElement.innerHTML = originalContent;
            btnElement.disabled = originalDisabled;
        };
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
