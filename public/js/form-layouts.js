"use strict";
!(function () {
    var e = document.querySelectorAll(".phone-mask"),
        t = document.querySelector(".credit-card-mask"),
        n = document.querySelector(".expiry-date-mask"),
        c = document.querySelector(".cvv-code-mask"),
        r = document.querySelectorAll(".dob-picker"),
        o = document.querySelectorAll(".form-check-input-payment");
    e &&
        e.forEach(function (e) {
            new Cleave(e, { phone: !0, phoneRegionCode: "US" });
        }),
        t &&
            new Cleave(t, {
                creditCard: !0,
                onCreditCardTypeChanged: function (e) {
                    document.querySelector(".card-type").innerHTML =
                        "" != e && "unknown" != e
                            ? '<img src="' +
                              assetsPath +
                              "img/icons/payments/" +
                              e +
                              '-cc.png" height="28"/>'
                            : "";
                },
            }),
        n &&
            new Cleave(n, {
                date: !0,
                delimiter: "/",
                datePattern: ["m", "y"],
            }),
        c && new Cleave(c, { numeral: !0, numeralPositiveOnly: !0 }),
        r.forEach(function (element) {
            element.flatpickr({
                monthSelectorType: "static",
                defaultDate: new Date(),
                dateFormat: "d/m/Y",
            });
        });
    o &&
        o.forEach(function (e) {
            e.addEventListener("change", function (e) {
                "credit-card" === e.target.value
                    ? document
                          .querySelector("#form-credit-card")
                          .classList.remove("d-none")
                    : document
                          .querySelector("#form-credit-card")
                          .classList.add("d-none");
            });
        });
})(),
    $(function () {
        var e,
            t = $(".sticky-element"),
            i = $(".select2"),
            t =
                (window.Helpers.initCustomOptionCheck(),
                (e = Helpers.isNavbarFixed()
                    ? $(".layout-navbar").height() - 3
                    : 0),
                t.length && t.sticky({ topSpacing: e, zIndex: 9 }));
        i.length &&
            i.each(function () {
                var i = $(this);
                select2Focus(i),
                    i.wrap('<div class="position-relative"></div>').select2({
                        dropdownParent: i.parent(),
                        placeholder: i.data("placeholder"),
                    });
            });
    });
