document.addEventListener('DOMContentLoaded', function () {

    const step1 = FormValidation.formValidation(document.querySelector('.step-1'), {
        fields: {
            name: {
                validators: {
                    notEmpty: {
                        message: 'Please enter your full name',
                    },
                    stringLength: {
                        max: 30,
                        message: 'Your name must be less than 30 characters long',
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9_ ]+$/,
                        message: 'Your name can only consist of alphabetical characters, numbers, underscores, and spaces',
                    },
                },
            },
            email: {
                validators: {
                    notEmpty: {
                        message: 'Please enter email address'
                    },
                    emailAddress: {
                        message: 'The value is not a valid email address'
                    }
                },
            },
            password: {
                validators: {
                    notEmpty: {
                        message: 'Please enter password',
                    },
                    stringLength: {
                        min: 8,
                        message: 'Your name must be more than 8 characters long',
                    },
                },
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
              // Use this for enabling/changing valid/invalid class
              // eleInvalidClass: '',
              eleValidClass: '',
              rowSelector: '.form-floating'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
              if (e.element.parentElement.classList.contains('input-group')) {
                e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
              }
            });
          }
    }).on('core.form.valid', function () {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    const step2 = FormValidation.formValidation(document.querySelector('.step-2'), {
        fields: {
            phone: {
                validators: {
                    notEmpty: {
                        message: 'Please enter phone number',
                    },
                    stringLength: {
                        max: 30,
                        message: 'Your name must be less than 30 characters long',
                    },
                    regexp: {
                        regexp: /^[0-9]+$/,
                        message: 'The phone can only consist of numbers',
                    },
                },
            },
            country: {
                validators: {
                    notEmpty: {
                        message: 'Please select the country'
                    }
                },
            },
            state: {
                validators: {
                    notEmpty: {
                        message: 'Please select the state'
                    }
                },
            },
            city: {
                validators: {
                    notEmpty: {
                        message: 'Please select the city'
                    }
                },
            },
            street: {
                validators: {
                    notEmpty: {
                        message: 'Please select the street'
                    }
                },
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
              // Use this for enabling/changing valid/invalid class
              // eleInvalidClass: '',
              eleValidClass: '',
              rowSelector: '.form-floating'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
              if (e.element.parentElement.classList.contains('input-group')) {
                e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
              }
            });
          }
    }).on('core.form.valid', function () {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    const step3 = FormValidation.formValidation(document.querySelector('.step-3'), {
        fields: {
            
            introduction: {
                validators: {
                    notEmpty: {
                        message: 'Please select the country'
                    }
                },
            }
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
              // Use this for enabling/changing valid/invalid class
              // eleInvalidClass: '',
              eleValidClass: '',
              rowSelector: '.form-floating'
            }),
            autoFocus: new FormValidation.plugins.AutoFocus(),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
              if (e.element.parentElement.classList.contains('input-group')) {
                e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
              }
            });
          }
    }).on('core.form.valid', function () {
        if (currentStep < steps.length - 1) {
            currentStep++;
            showStep(currentStep);
        }
    });

    const steps = document.querySelectorAll(".steps");
    let currentStep = 0;

    function showStep(stepIndex) {
        steps.forEach((step, index) => {
            if (index === stepIndex) {
                step.classList.add("active");
                step.classList.remove("hidden");
            } else {
                step.classList.remove("active");
                step.classList.add("hidden");
            }
        });
    }

    document.querySelectorAll(".auth-btn").forEach((btn) => {
        btn.addEventListener("click", function (event) {
            event.preventDefault();
            switch (currentStep) {
                case 0:
                    step1.validate();
                  break;
    
                case 1:
                    step2.validate();
                  break;
    
                case 2:
                    step3.validate();
                  break;
    
                default:
                  break;
              }
        });
    });

    document.querySelectorAll(".go-back").forEach((btn) => {
        btn.addEventListener("click", function (event) {
            event.preventDefault();
            if (currentStep > 0) {
                currentStep--;
                showStep(currentStep);
            }
        });
    });

    showStep(currentStep); // Show the first step initially



    
});