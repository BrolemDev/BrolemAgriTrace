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
                e.flatpickr({ monthSelectorType: "static" });
            });
})(),
    $(function () {
        let a = $(".dt-complex-header");
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
                                id: product.code_product,
                                text: product.name_product,
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
                }
            }
        });
        $("#product").on("select2:select", function (e) {
            var codeProduct = e.params.data.id; // Obtener el código del producto seleccionado
            $("#codeP").val(codeProduct);
        });
        $("#branch").select2();
        a.length &&
            a.DataTable({
                ajax: assetsPath + "json/table-datatable.json",
                columns: [
                    { data: "id" },
                    { data: "start_date" },
                    { data: "email" },
                    { data: "salary" },
                    { data: "salary" },
                    { data: "salary" },
                    { data: "salary" },
                    { data: "salary" },
                    { data: "status" },
                    { data: "id" },
                    { data: "id" },
                ],

                dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>><"table-responsive"t><"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 10,
                lengthMenu: [10, 25, 50, 75, 100],
            });
    });
