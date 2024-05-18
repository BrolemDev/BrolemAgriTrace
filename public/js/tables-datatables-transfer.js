"use strict";
$(function () {
    var e,
        t = $(".datatables-permissions"),
        l = "app-user-list.html";
    t.length &&
        (e = t.DataTable({
            lengthChange: !1,
            ajax: assetsPath + "json/permissions-list.json",
            columns: [
                { data: "" },
                { data: "id" },
                { data: "name" },
                { data: "assigned_to" },
                { data: "created_date" },
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
                { targets: 1, searchable: !1, visible: !1 },
                {
                    targets: 2,
                    render: function (e, t, a, n) {
                        return (
                            '<span class="text-nowrap text-heading">' +
                            a.name +
                            "</span>"
                        );
                    },
                },
                {
                    targets: 3,
                    orderable: !1,
                    render: function (e, t, a, n) {
                        for (
                            var s = a.assigned_to,
                                r = "",
                                o = {
                                    Admin:
                                        '<a href="' +
                                        l +
                                        '"><span class="badge rounded-pill bg-label-primary m-1">Administrator</span></a>',
                                    Manager:
                                        '<a href="' +
                                        l +
                                        '"><span class="badge rounded-pill bg-label-warning m-1">Manager</span></a>',
                                    Users:
                                        '<a href="' +
                                        l +
                                        '"><span class="badge rounded-pill bg-label-success m-1">Users</span></a>',
                                    Support:
                                        '<a href="' +
                                        l +
                                        '"><span class="badge rounded-pill bg-label-info m-1">Support</span></a>',
                                    Restricted:
                                        '<a href="' +
                                        l +
                                        '"><span class="badge rounded-pill bg-label-danger m-1">Restricted User</span></a>',
                                },
                                d = 0;
                            d < s.length;
                            d++
                        )
                            r += o[s[d]];
                        return '<span class="text-nowrap">' + r + "</span>";
                    },
                },
                {
                    targets: 4,
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return (
                            '<span class="text-nowrap">' +
                            a.created_date +
                            "</span>"
                        );
                    },
                },
                {
                    targets: -1,
                    searchable: !1,
                    className: "text-center",
                    title: "Actions",
                    orderable: !1,
                    render: function (e, t, a, n) {
                        return '<span class="text-nowrap"><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon me-2" data-bs-target="#editPermissionModal" data-bs-toggle="modal" data-bs-dismiss="modal"><i class="mdi mdi-pencil-outline mdi-20px"></i></button><button class="btn btn-sm btn-icon btn-text-secondary rounded-pill btn-icon delete-record"><i class="mdi mdi-delete-outline mdi-20px"></i></button></span>';
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
                        "data-bs-target": "#addModalProduct",
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
        $(".datatables-permissions tbody").on(
            "click",
            ".delete-record",
            function () {
                e.row($(this).parents("tr")).remove().draw();
            }
        );

    $("#productApp").select2({
        dropdownParent: $("#addModalProduct"),
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
});
