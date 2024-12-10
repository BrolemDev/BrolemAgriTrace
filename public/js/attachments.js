"use strict";
$(function () {
    var e,
        t = $(".table-products");
    t.length &&
        (e = t.DataTable({
            ajax: "getDetails/" + $("#id").val(),
            columns: [
                { data: "id" },
                { data: "description" },
                { data: "file1" },
                { data: "file2" },
                { data: "quantity" },
                { data: "unit" },
                { data: "price_unit" },
                { data: "price" },
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
                {
                    targets: 2,
                    className: "text-center",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return `<button type="button" class="btn btn-icon btn-danger waves-effect waves-light">
                                  <span class="tf-icons mdi mdi-file-upload"></span>
                                </button>`;
                    },
                },
                {
                    targets: 3,
                    className: "text-center",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return `<button type="button" class="btn btn-icon btn-danger waves-effect waves-light">
                                <span class="tf-icons mdi mdi-file-upload"></span>
                              </button>`;
                    },
                },
            ],
            language: {
                emptyTable: "No hay productos en la tabla",
                search: "Buscar",
            },
            dom: '<"row mx-1"<"col-sm-12" f>>t<"row mx-2"<"col-sm-12 col-md-6" i><"col-sm-12 col-md-6" p>>',
            pageLength: 1000, // Cambia este número según la cantidad total de registros
            lengthChange: false, // Oculta la opción de "Show entries"
            paging: false, // Desactiva la paginación
            language: {
                info: "", // Elimina el texto "Mostrando X entradas"
                infoEmpty: "", // Elimina el texto "Mostrando 0 a 0 de 0 entradas"
                infoFiltered: "", // Elimina el texto sobre la cantidad filtrada
            },
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
        })),
        $(".table-products tbody").on("click", ".delete-record", function () {
            e.row($(this).parents("tr")).remove().draw();
        });

    let csrfToken = $('meta[name="csrf-token"]').attr("content");
});
