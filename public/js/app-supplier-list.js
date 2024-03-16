"use strict";
$(function () {
    let csrfToken = $('meta[name="csrf-token"]').attr("content");
    var e,
        t = $(".datatables-permissions"),
        l = "app-user-list.html";
    t.length &&
        (e = t.DataTable({
            ajax: "getSuppliers",
            columns: [
                { data: "" },
                { data: "id" },
                { data: "name" },
                { data: "ruc" },
                { data: "verify" },
                { data: "sanitary" },
                { data: "expiry" },
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
                    targets: 1,
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
                    render: function (e, t, a, n) {
                        return (
                            '<span class="text-nowrap text-heading">' +
                            a.ruc +
                            "</span>"
                        );
                    },
                },
                {
                    targets: 4,
                    orderable: !1,
                    className: "text-center",
                    render: function (e, t, a, n) {
                        if (e) {
                            return '<button type="button" class="btn btn-icon btn-primary btn-fab demo view_ruc"><span class="tf-icons mdi mdi-checkbox-marked-circle-outline mdi-24px"></span></button>';
                        }
                        return '<button type="button" class="btn btn-icon btn-danger btn-fab demo verify-ruc"><span class="tf-icons mdi mdi-layers-plus mdi-24px"></span></button>';
                    },
                },
                {
                    targets: 5,
                    className: "text-center",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        if (e) {
                            return '<button type="button" class="btn btn-icon btn-primary btn-fab demo view_file"><span class="tf-icons mdi mdi-checkbox-marked-circle-outline mdi-24px"></span></button>';
                        }
                        return '<button type="button" class="btn btn-icon btn-danger btn-fab demo add_file"><span class="tf-icons mdi mdi-layers-plus mdi-24px"></span></button>';
                    },
                },
                {
                    targets: 6,
                    className: "text-center",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return e != "" ? e : "-----------";
                    },
                },
                {
                    targets: -1,
                    searchable: !1,
                    title: "Actions",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2" data-bs-target="#editPermissionModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="mdi mdi-pencil-outline mdi-20px"></i></button><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon delete-record"><i class="mdi mdi-delete-outline mdi-20px"></i></button></span>';
                    },
                },
            ],
            order: [[1, "asc"]],
            dom: '<"row mx-1"<"col-sm-12 col-md-3" l><"col-sm-12 col-md-9"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-md-end justify-content-center flex-wrap me-1"<"me-3"f>B>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "Mostrar _MENU_",
                search: "Buscar",
                searchPlaceholder: "Buscar..",
            },
            buttons: [
                {
                    text: "<span class='mdi mdi-plus'></span> Agregar Proveedor",
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
        },
        )),
        
        $(".datatables-permissions tbody").on(
            "click",
            ".delete-record",
            function () {
                e.row($(this).parents("tr")).remove().draw();
            }
        );
    $(".btn-add").on("click", function () {
        closeForm();
        $("#title-form").text("Agregar Proveedor");
        $("#title-form").attr("data-i18n", "Add Supplier");
    });

    e.on("click", ".verify-ruc", function () {
        $("#validity-ruc")[0].reset();
        $(".custom-option-icon").removeClass("checked");

        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        $("#id_validate").val(rowData.id);
        $("#title-ruc-validate").text(rowData.name);
        $(".btn_validity").text("validar");
        $("#verifyRUC").modal("show");
    });

    e.on("click", ".view_ruc", function () {
        $("#validity-ruc")[0].reset();
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        $("#id_validate").val(rowData.id);
        $("#title-ruc-validate").text(rowData.name);
        $(".custom-option-icon").addClass("checked");
        $("#customCheckboxIcon1").prop("checked", true);
        $("#customCheckboxIcon2").prop("checked", true);
        $("#obse").val(rowData.observation);
        $(".btn_validity").text("Invalidar");
        $("#verifyRUC").modal("show");
    });

    e.on("click", ".add_file", function () {
        $("#file-sanitary")[0].reset();
        document.getElementById("pdfPreview").innerHTML = "";
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();
        $("#id_file_supplier").val(rowData.id);
        $("#title-file-sanitary").text(rowData.name);
        $(".btn_file").text("Validar");
        $("#action").val(1);
        $("#uploadFile").modal("show");
    });

    e.on("click", ".view_file", function () {
        document.getElementById("pdfPreview").innerHTML = "";
        $("#file-sanitary")[0].reset();
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();
        $("#id_file_supplier").val(rowData.id);
        $("#title-file-sanitary").text(rowData.name);
        $("#action").val(2);
        $(".btn_file").text("Invalidar");
        $("#file_name").val(rowData.file);
        var pdfPath = "/storage/supplier/" + rowData.file;

        // Creamos un elemento object para mostrar el PDF
        var pdfObject = document.createElement("object");
        pdfObject.type = "application/pdf";
        pdfObject.data = pdfPath;
        pdfObject.style.width = "100%";
        pdfObject.style.height = "500px";

        pdfPreview.appendChild(pdfObject);
        $("#uploadFile").modal("show");
    });

    $("#formFile").on("change", function (event) {
        var file = this.files[0];
        var reader = new FileReader();

        reader.onload = function () {
            var pdfPreview = document.getElementById("pdfPreview");
            pdfPreview.innerHTML = ""; // Limpiar cualquier contenido previo

            var pdfObject = document.createElement("object");
            pdfObject.type = "application/pdf";
            pdfObject.data = reader.result;
            pdfObject.style.width = "100%";
            pdfObject.style.height = "500px"; // Ajusta el alto según tus necesidades
            pdfObject.setAttribute("toolbar", "0"); // Oculta la barra lateral de navegación
            pdfObject.setAttribute("zoom", "50");

            pdfPreview.appendChild(pdfObject);
        };

        reader.readAsDataURL(file);
    });

    $("#ruc").on("input", function () {
        if ($(this).val().length == 11) {
            $.blockUI({
                message:
                    '<div class="d-flex justify-content-center"><p class="mb-0">Buscando RUC </p> <div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                timeout: 1e3,
                css: {
                    backgroundColor: "transparent",
                    color: "#fff",
                    border: "0",
                },
                overlayCSS: { opacity: 0.5 },
            });
            $.ajax({
                type: "POST",
                url: "getRUC",
                data: { ruc: $(this).val(), _token: csrfToken },
            })
                .done((response) => {
                    if (response.condicion == "HABIDO") {
                        $("#business_name").val(response.razonSocial);
                        $("#address").val(response.direccion);
                        $("#ubigeo").val(
                            `${response.departamento} - ${response.provincia} - ${response.distrito}`
                        );
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "RUC NO HABIDO",
                        });
                        closeForm();
                    }
                })
                .always(() => {
                    $.unblockUI();
                });
        } else {
            $("#business_name").val("");
            $("#address").val("");
            $("#ubigeo").val("");
            $("#mail").val("");
            $("#phone").val("");
        }
    });

    $("#validity-ruc").on("submit", function () {
        var isChecked1 = $("#customCheckboxIcon1").prop("checked");
        var isChecked2 = $("#customCheckboxIcon2").prop("checked");
        var action = $(".btn_validity").text() == "validar" ? "1" : "0";
        if (isChecked1 && isChecked2) {
            $.ajax({
                url: "verifySupplier",
                type: "POST",
                data: {
                    action: action,
                    id: $("#id_validate").val(),
                    observation: $("#obse").val(),
                    _token: csrfToken,
                },
            })
                .done((v) => {
                    e.ajax.reload();
                    Toast.fire({
                        icon: v.type,
                        title: v.message,
                    });
                    closeValidity();
                })
                .fail((h) => {
                    console.log(h.responseText);
                });
        } else {
            Toast.fire({
                icon: "error",
                title: "DEBE DE COMPLETAR LOS CAMPOS REQUERIDOS",
            });
        }
    });

    $("#file-sanitary").on("submit", function () {
        const b = document.getElementById("file-sanitary");
        const formData = new FormData(b);

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));
        fetch("verifySanitary", {
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
                e.ajax.reload();
                Toast.fire({
                    icon: data.type,
                    title: data.message,
                });
                $("#uploadFile").modal("hide");
            })
            .catch((error) => {
                console.error("Error:", error.message);
            })
            .finally(() => {});
    });

    let f = document.getElementById("supplierForm");

    let fv = FormValidation.formValidation(f, {
        fields: {
            ruc: {
                validators: {
                    notEmpty: {
                        message: "Porfavor ingresar RUC",
                    },
                },
            },
            business_name: {
                validators: {
                    notEmpty: {
                        message: "",
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

        formData.append("_token", $('meta[name="csrf-token"]').attr("content"));

        fetch("insertSupplier", {
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
                    e.DataTable().ajax.reload();
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

    function closeValidity() {
        $(".btn_validity").text("Validar");
        $("#verifyRUC").modal("hide");
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
