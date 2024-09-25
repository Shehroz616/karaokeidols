document.addEventListener('DOMContentLoaded', function () {

    const step1 = FormValidation.formValidation(document.querySelector('.step-1'), {
        fields: {
            'singer_type': {
                validators: {
                    notEmpty: {
                        message: 'Please select a singer type',  // Updated message for radio buttons
                    },
                },
            },
        },
        plugins: {
            trigger: new FormValidation.plugins.Trigger(),
            bootstrap5: new FormValidation.plugins.Bootstrap5({
                eleValidClass: '',
                rowSelector: '.custom-radios-container'  // Ensure this selector targets the radio buttons' container
            }),
            submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
            instance.on('plugins.message.placed', function (e) {
                if (e.element.parentElement.parentElement.classList.contains('custom-radios-container')) {
                    e.element.parentElement.parentElement.insertAdjacentElement('afterend', e.messageElement);
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
            'song-title': {
                validators: {
                    notEmpty: {
                        message: 'Please enter song title',
                    },
                    stringLength: {
                        max: 30,
                        message: 'Song title be less than 30 characters long',
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'Song title can only alphabets and number only',
                    },
                },
            },
            'song-artist': {
                validators: {
                    notEmpty: {
                        message: 'Please enter song title',
                    },
                    stringLength: {
                        max: 30,
                        message: 'Song title be less than 30 characters long',
                    },
                    regexp: {
                        regexp: /^[a-zA-Z0-9 ]+$/,
                        message: 'Song title can only alphabets and number only',
                    },
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