"use strict";
$(function () {
    var e = $(".select2");
    e.length &&
        e.each(function () {
            var i = $(this);
            select2Focus(i),
                i.wrap('<div class="position-relative"></div>').select2({
                    dropdownParent: i.parent(),
                    placeholder: i.data("placeholder"),
                });
        });
}),
    document.addEventListener("DOMContentLoaded", function (e) {
        let csrfToken = $('meta[name="csrf-token"]').attr("content");
        var n = document.querySelector("#multiStepsValidation");
        if (null !== n) {
            var a = n.querySelector("#multiStepsForm");
            const d = a.querySelector("#accountDetailsValidation");
            var s = a.querySelector("#personalInfoValidation"),
                i = a.querySelector("#billingLinksValidation"),
                as = document.querySelector("#observation"),
                o = [].slice.call(a.querySelectorAll(".btn-next")),
                a = [].slice.call(a.querySelectorAll(".btn-prev")),
                r = document.querySelector(".multi-steps-exp-date"),
                l = document.querySelector(".multi-steps-cvv"),
                m = document.querySelector(".multi-steps-mobile"),
                u = document.querySelector(".multi-steps-pincode"),
                c = document.querySelector(".multi-steps-card"),
                form = document.getElementById("multiStepsForm");
            r &&
                new Cleave(r, {
                    date: !0,
                    delimiter: "/",
                    datePattern: ["m", "y"],
                }),
                l && new Cleave(l, { numeral: !0, numeralPositiveOnly: !0 }),
                m &&
                    new Cleave(m, {
                        phone: !0,
                        phoneRegionCode: "US",
                        blocks: [9],
                        numericOnly: !0,
                    }),
                u && new Cleave(u, { delimiter: "", numeral: !0 }),
                c &&
                    new Cleave(c, {
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
                as && autosize(as);
            let t = new Stepper(n, { linear: !0 });

            const g = FormValidation.formValidation(s, {
                    fields: {
                        document_number: {
                            validators: {
                                notEmpty: {
                                    message:
                                        "Por favor ingrese el número de documento",
                                },
                            },
                        },
                        lastname: {
                            validators: {
                                notEmpty: {
                                    message: "Por favor ingrese sus apellidos",
                                },
                            },
                        },
                        firstname: {
                            validators: {
                                notEmpty: {
                                    message: "Por favor ingrese sus nombres",
                                },
                            },
                        },
                        phone_number: {
                            validators: {
                                notEmpty: {
                                    message:
                                        "Por favor ingrese su número de teléfono",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: function (e, t) {
                                switch (e) {
                                    case "multiStepsFirstName":
                                        return ".col-sm-6";
                                    case "multiStepsAddress":
                                        return ".col-md-12";
                                    default:
                                        return ".row";
                                }
                            },
                        }),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    },
                }).on("core.form.valid", function () {
                    t.next();
                }),
                p = FormValidation.formValidation(d, {
                    fields: {
                        multiStepsPass: {
                            validators: {
                                notEmpty: { message: "Please enter password" },
                            },
                        },
                        multiStepsConfirmPass: {
                            validators: {
                                notEmpty: {
                                    message: "Confirm Password is required",
                                },
                                identical: {
                                    compare: function () {
                                        return d.querySelector(
                                            '[name="multiStepsPass"]'
                                        ).value;
                                    },
                                    message:
                                        "The password and its confirm are not the same",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: ".col-sm-6",
                        }),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    },
                    init: (e) => {
                        e.on("plugins.message.placed", function (e) {
                            e.element.parentElement.classList.contains(
                                "input-group"
                            ) &&
                                e.element.parentElement.insertAdjacentElement(
                                    "afterend",
                                    e.messageElement
                                );
                        });
                    },
                }).on("core.form.valid", function () {
                    t.next();
                }),
                v = FormValidation.formValidation(i, {
                    fields: {
                        multiStepsCard: {
                            validators: {
                                notEmpty: {
                                    message: "Please enter card number",
                                },
                            },
                        },
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        bootstrap5: new FormValidation.plugins.Bootstrap5({
                            eleValidClass: "",
                            rowSelector: function (e, t) {
                                return "multiStepsCard" !== e
                                    ? ".col-dm-6"
                                    : ".col-md-12";
                            },
                        }),
                        autoFocus: new FormValidation.plugins.AutoFocus(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                    },
                    init: (e) => {
                        e.on("plugins.message.placed", function (e) {
                            e.element.parentElement.classList.contains(
                                "input-group"
                            ) &&
                                e.element.parentElement.insertAdjacentElement(
                                    "afterend",
                                    e.messageElement
                                );
                        });
                    },
                }).on("core.form.valid", function () {
                    blockUI();

                    const formData = new FormData(form);
                    formData.append("_token", csrfToken);

                    console.log(formData);

                    fetch("validateGuide", {
                        method: "POST",
                        body: formData,
                    })
                        .then((response) => {
                            if (!response.ok) {
                                return response.text().then((text) => {
                                    throw new Error(text);
                                });
                            }
                            return response.json();
                            º;
                        })
                        .then((data) => {
                            if (
                                data.message ===
                                "Reception and images saved successfully."
                            ) {
                                window.location.href = "/ConfirmacionGuia";
                            } else {
                                alert(
                                    "Hubo un problema al guardar. comunicarse con sistemas."
                                );
                                console.log(
                                    "Mensaje del servidor:",
                                    data.message
                                );
                            }
                        })
                        .catch((error) => {
                            console.error("Error:", error.message);
                        })
                        .finally(() => {
                            $.unblockUI();
                        });
                });
            o.forEach((e) => {
                e.addEventListener("click", (e) => {
                    switch (t._currentIndex) {
                        case 0:
                            g.validate();
                            break;
                        case 1:
                            p.validate();
                            break;
                        case 2:
                            v.validate();
                    }
                });
            }),
                a.forEach((e) => {
                    e.addEventListener("click", (e) => {
                        switch (t._currentIndex) {
                            case 2:
                            case 1:
                                t.previous();
                        }
                    });
                });
        }

        function blockUI() {
            $.blockUI({
                message:
                    '<div class="d-flex justify-content-center"><div class="sk-wave m-0"><div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div> <div class="sk-rect sk-wave-rect"></div></div> </div>',
                timeout: 1e3,
                css: {
                    backgroundColor: "transparent",
                    color: "#fff",
                    border: "0",
                },
                overlayCSS: { opacity: 0.5 },
            });
        }
    });
