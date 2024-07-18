"use strict";
document.addEventListener("DOMContentLoaded", function (e) {
    {
        let e = document.getElementById("uploadedAvatar");
        const l = document.querySelector(".account-file-input"),
            c = document.querySelector(".account-image-reset");
        if (e) {
            const r = e.src;
            l.onchange = () => {
                l.files[0] && (e.src = window.URL.createObjectURL(l.files[0]));
            };
        }
    }
}),
    $(function () {
        let csrfToken = $('meta[name="csrf-token"]').attr("content");

        $("#ubigeo").select2({
            dropdownParent: $("#formAccountSettings"),
            ajax: {
                url: "/scopeCodeUbigeo",
                dataType: "json",
                delay: 250,
                data: function (params) {
                    return {
                        query: params.term,
                    };
                },
                processResults: function (data) {
                    return {
                        results: $.map(data, function (row) {
                            return {
                                id: row.codigo_ubigeo,
                                text: `${row.departamento} - ${row.provincia} - ${row.distrito}`,
                            };
                        }),
                    };
                },
                cache: true,
            },
            placeholder: "Buscar un ubigeo",
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

        $("#searchRuc").on("click", function (e) {
            let rucValue = $("#ruc").val().trim();

            if (rucValue.length !== 11) {
                Toast.fire({
                    icon: "error",
                    title: "Inserte un RUC válido (11 caracteres)",
                });
                return;
            }

            blockUI();

            $.ajax({
                type: "POST",
                url: "getRUC",
                data: { ruc: rucValue, _token: csrfToken },
            })
                .done((response) => {
                    if (response.condicion == "HABIDO") {
                        $("#reason").val(response.razonSocial);
                        $("#ecommerce").val(response.razonSocial);
                        $("#address").val(response.direccion);
                        $("#urbanization").val(response.zonaTipo);
                        $("#ubigeo").empty();

                        let selectedOption = `${response.departamento} - ${response.provincia} - ${response.distrito}`;
                        let optionElement = `<option value="${response.ubigeo}" selected>${selectedOption}</option>`;

                        $("#ubigeo").append(optionElement);
                    } else {
                        Toast.fire({
                            icon: "error",
                            title: "RUC NO HABIDO",
                        });
                        closeForm();
                    }
                })
                .fail((err) => {
                    console.error(err.responseText);
                })
                .always(() => {
                    $.unblockUI();
                });
        });

        const o = document.querySelector("#formAccountSettings");
        const fv = FormValidation.formValidation(o, {
            fields: {
                ruc: {
                    validators: {
                        notEmpty: {
                            message: "RUC obligatorio",
                        },
                    },
                },
                reason: {
                    validators: {
                        notEmpty: {
                            message: "Razón social obligatorio",
                        },
                    },
                },
                ecommerce: {
                    validators: {
                        notEmpty: {
                            message: "Nombre comercial obligatorio",
                        },
                    },
                },
                phone: {
                    validators: {
                        notEmpty: {
                            message: "Ingresar número celular",
                        },
                    },
                },
                email: {
                    validators: {
                        emailAddress: {
                            message: "Ingresa correo electrónico válido",
                        },
                        notEmpty: {
                            message: "Correo electrónico obligatorio",
                        },
                    },
                },
                ubigeo: {
                    validators: {
                        notEmpty: {
                            message: "Ubigeo obligatorio",
                        },
                    },
                },
                urbanization: {
                    validators: {
                        notEmpty: {
                            message: "Urbanización obligatorio",
                        },
                    },
                },
                address: {
                    validators: {
                        notEmpty: {
                            message: "Dirección obligatoria",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    eleValidClass: "",
                    rowSelector: function (e, a) {
                        switch (e) {
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
            sendDataServe();
        });

        function sendDataServe() {
            blockUI();

            let formData = new FormData(o);
            formData.append("_token", csrfToken);

            fetch("updateSettings", {
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
                })
                .then((data) => {
                    Toast.fire({
                        icon: data.icon,
                        title: data.message,
                    });
                })
                .catch((error) => {
                    console.error("Error:", error.message);
                    // Mostrar el contenido del error
                    alert("Error: " + error.message);
                })
                .finally(() => {
                    $.unblockUI();
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
