"use strict";
$(function () {
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
    var today = new Date(),
        csrfToken = $('meta[name="csrf-token"]').attr("content");

    var oneMonthAgo = new Date();
    oneMonthAgo.setMonth(oneMonthAgo.getMonth() - 1);

    var startDate = formatDate(oneMonthAgo);
    var endDate = formatDate(today);
    var e,
        s = $(".datatables-entries");
    const buttonConfig = {
        0: {
            colorClass: "btn-danger",
            iconClass: "mdi-close-circle-outline",
            titleText: "No Generado",
            idclass: "datatables-cancel",
        },
        1: {
            colorClass: "btn-success",
            iconClass: "mdi-checkbox-marked-circle-outline",
            titleText: "Recibido",
            idclass: "datatables-success",
        },
        2: {
            colorClass: "btn-warning",
            iconClass: "mdi-alert-circle-outline",
            titleText: "Pendiente",
            idclass: "datatables-warning",
        },
    };
    $("#flatpickr-range").flatpickr({
        mode: "range",
        dateFormat: "Y-m-d",
        defaultDate: [startDate, endDate],
        locale: {
            rangeSeparator: " Hasta ",
        },
        onChange: function (selectedDates, dateStr, instance) {
            if (selectedDates && selectedDates.length === 2) {
                $.blockUI({
                    message:
                        '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                    css: { backgroundColor: "transparent", border: "0" },
                    overlayCSS: { opacity: 0.5 },
                });
                var Checked = $(".switch-input").prop("checked");

                var isChecked = Checked ? "1" : "0";

                console.log(isChecked);

                var startDate = selectedDates[0].toISOString();
                var endDate = selectedDates[1].toISOString();
                $.ajax({
                    url: "Tabla_Logs",
                    type: "GET",
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        isChecked: isChecked,
                    },
                })
                    .done((response) => {
                        e.clear().rows.add(response.data).draw();
                    })
                    .fail(function (error) {
                        console.error("error:", error.responseText);
                    })
                    .always(function (response) {
                        $.unblockUI();
                    });
            }
        },
    });

    s.length &&
        (e = s.DataTable({
            ajax: "table_guides",

            columns: [
                { data: "id" },
                { data: "date" },
                { data: "voucher" },
                { data: "destiny" },
                { data: "weight" },
                { data: "weight" },
                { data: "status" },
                { data: "weight" },
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
                    render: function (e, t, a, n) {
                        return `<span>${e}</span>`;
                    },
                },

                {
                    targets: 2,
                    render: function (e, t, a, n) {
                        return `GUIA DE REMISIÓN REMITENTE: T001 - ${e}`;
                    },
                },
                {
                    targets: 3,
                    render: function (e, t, a, n) {
                        return `<span>${e}</span><p>${a.reason}</p>`;
                    },
                },
                {
                    targets: 5,
                    render: function (e, t, a, n) {
                        return `<a href="GuiaRemisionPdf/${a.id}" target="_blank" type="button" class="btn btn-icon btn-danger btn-fab demo waves-effect waves-light" data-bs-toggle="tooltip" data-bs-placement="top" title="Descargar PDF">
                         <span class="tf-icons bg-label-danger mdi mdi-file-pdf-box mdi-24px"></span>
                        </a> `;
                    },
                },
                {
                    targets: 6,
                    render: function (e, t, a, n) {
                        const config = buttonConfig[e] || {
                            colorClass: "btn-primary",
                            iconClass: "mdi-checkbox-marked-circle-outline",
                            titleText: "Descargar PDF",
                            idclass: "datatables-pdf",
                        };

                        return `<button type="button" class="btn btn-icon ${config.colorClass} btn-fab demo waves-effect waves-light ${config.idclass}" data-bs-toggle="tooltip" data-bs-placement="top" title="${config.titleText}">
                            <span class="tf-icons mdi ${config.iconClass} mdi-24px"></span>
                        </button>`;
                    },
                },
                {
                    targets: -1,
                    render: function (e, t, a, n) {
                        return `
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="mdi mdi-dots-vertical mdi-20px"></i></button>
                                <div class="dropdown-menu dropdown-menu-end m-0">
                                    <a href="#" class="dropdown-item"><i class="mdi mdi-email-arrow-right-outline me-2"></i>Enviar al Correo Electrónico</a>
                                    <a href="#" class="dropdown-item delete-record"><i class="mdi mdi-whatsapp me-2"></i>Enviar Whatsapp</a>
                                </div>
                            </div>
                        `;
                    },
                },
            ],
            order: [[1, "desc"]],
            dom: '<"row mx-2"<"col-md-2"<"me-3"l>><"col-md-10"<"dt-action-buttons text-xl-end text-lg-start text-md-end text-start d-flex align-items-center justify-content-end flex-md-row flex-column mb-3 mb-md-0 gap-3"fB>>>t<"row mx-2"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            language: {
                sLengthMenu: "Mostrar _MENU_",
                search: "",
                searchPlaceholder: "Buscar ..",
            },
            buttons: [
                {
                    text: '<i class="mdi mdi-plus me-0 me-sm-1"></i><span class="d-none d-sm-inline-block">CREAR GUÍA REMISIÓN</span>',
                    className:
                        "create-guide btn btn-primary waves-effect waves-light",
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
        })),
        e.on("draw.dt", function () {
            [].slice
                .call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                .map(function (a) {
                    return new bootstrap.Tooltip(a, {
                        boundary: document.body,
                    });
                });
        }),
        setTimeout(() => {
            $(".dataTables_filter .form-control").removeClass(
                "form-control-sm"
            ),
                $(".dataTables_length .form-select").removeClass(
                    "form-select-sm"
                );
        }, 300);
    var p = [].slice.call(document.querySelectorAll(".clipboard-btn"));
    ClipboardJS
        ? p.map(function (t) {
              new ClipboardJS(t).on("success", function (t) {
                  "copy" == t.action &&
                      Toast.fire({
                          icon: "success",
                          title: "Enlace Copiado",
                      });
              });
          })
        : p.map(function (t) {
              t.setAttribute("disabled", !0);
          });

    $(".create-guide").each(function () {
        $(this).click(function (e) {
            e.preventDefault();
            location.href = "Generar_Guia_Remision";
        });
    });

    e.on("click", ".datatables-cancel", function (e) {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();

        $("#clipboard-link").val(rowData.link);
        $("#modal-link").modal("show");
    });

    $("#whatsapp-button").on("click", function () {
        var message = encodeURIComponent(
            "Hola, te compartimos el enlace para que puedas registrar la recepción de tu guía: " +
                $("#clipboard-link").val()
        );
        var whatsappUrl = "https://wa.me/?text=" + message;
        window.open(whatsappUrl, "_blank");
    });

    e.on("click", ".btn-acepted", function () {
        let row = $(this).closest("tr");
        let rowData = $(this).closest("table").DataTable().row(row).data();
        Swal.fire({
            title: "Estas seguro?",
            text: `Aceptaras el Cambio de Documento de la Entrada: ${rowData.detcart}`,
            icon: "warning",
            showCancelButton: !0,
            confirmButtonText: "Si, aceptar",
            cancelButtonText: "Cancelar",
            customClass: {
                confirmButton: "btn btn-primary me-3 waves-effect waves-light",
                cancelButton: "btn btn-outline-secondary waves-effect",
            },
            buttonsStyling: !1,
        }).then(function (t) {
            if (t.value) {
                $.blockUI({
                    message:
                        '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
                    css: { backgroundColor: "transparent", border: "0" },
                    overlayCSS: { opacity: 0.5 },
                });
                $.ajax({
                    url: "updatedDocument",
                    type: "post",
                    data: {
                        id: rowData.id,
                        detcart: rowData.detcart,
                        document: rowData.dniAfter,
                        _token: csrfToken,
                    },
                })
                    .done((response) => {
                        console.log(response);
                        e.ajax.reload();

                        Toast.fire({
                            icon: "success",
                            title: "Se ha cambiad el Documento",
                        });
                    })
                    .fail((response) => {
                        Toast.fire({
                            icon: "error",
                            title: "Error al cambiar documento, contactar con SISTEMAS",
                        });
                        console.log(response.responseText);
                    })
                    .always(() => {
                        $.unblockUI();
                    });
            }
        });
    });

    function formatDate(date) {
        var year = date.getFullYear();
        var month = (date.getMonth() + 1).toString().padStart(2, "0");
        var day = date.getDate().toString().padStart(2, "0");
        var hours = date.getHours().toString().padStart(2, "0");
        var minutes = date.getMinutes().toString().padStart(2, "0");
        var seconds = date.getSeconds().toString().padStart(2, "0");
        return `${year}-${month}-${day}T${hours}:${minutes}:${seconds}`;
    }

    function highlightIncorrectDigits(incorrectNumber, correctNumber) {
        let strIncorrect = incorrectNumber.toString();
        let strCorrect = correctNumber.toString();
        let result = "";

        for (let i = 0; i < strIncorrect.length; i++) {
            const digit = strIncorrect[i];
            const isCorrect = strCorrect.includes(digit);

            if (!isCorrect) {
                result += `<span style="color: #ff6347">${digit}</span>`;
            } else {
                result += digit;
                // Remove the first occurrence of digit from strCorrect to handle duplicates
                strCorrect = strCorrect.replace(digit, "");
            }
        }

        return result;
    }

    const blockUI = () => {
        $.blockUI({
            message:
                '<div class="sk-wave mx-auto"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div>',
            css: { backgroundColor: "transparent", border: "0" },
            overlayCSS: { opacity: 0.5 },
        });
    };

    const Toast = Swal.mixin({
        toast: true,
        position: "top",
        showConfirmButton: false,
        timer: 4000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal.stopTimer;
            toast.onmouseleave = Swal.resumeTimer;
        },
    });
}),
    (function () {})();
