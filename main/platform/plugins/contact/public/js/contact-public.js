$(() => {
    let showError = function (message) {
        $('.contact-error-message').html(message).show()
        if (typeof Theme !== 'undefined' && Theme.showError) {
            Theme.showError(message)
        }
    }

    let showSuccess = function (message) {
        $('.contact-success-message').html(message).show()
        if (typeof Theme !== 'undefined' && Theme.showSuccess) {
            Theme.showSuccess(message)
        }
    }

    let handleError = function (data) {
        if (typeof data.errors !== 'undefined' && data.errors.length) {
            handleValidationError(data.errors)
        } else {
            if (typeof data.responseJSON !== 'undefined') {
                if (typeof data.responseJSON.errors !== 'undefined') {
                    if (data.status === 422) {
                        handleValidationError(data.responseJSON.errors)
                    }
                } else if (typeof data.responseJSON.message !== 'undefined') {
                    showError(data.responseJSON.message)
                } else {
                    $.each(data.responseJSON, (index, el) => {
                        $.each(el, (key, item) => {
                            showError(item)
                        })
                    })
                }
            } else {
                showError(data.statusText)
            }
        }
    }

    let handleValidationError = function (errors) {
        let message = ''
        $.each(errors, (index, item) => {
            if (message !== '') {
                message += '<br />'
            }
            if (Array.isArray(item)) {
                message += item.join('<br />')
            } else {
                message += item
            }
        })
        showError(message)
    }

    $(document).on('input', '.contact-form input[name="phone"], .contact-form input[name="phone_display"]', function() {
        const $inp = $(this)
        const val = $inp.val()
        if (val && !val.startsWith('+')) {
            const digits = val.replace(/\D/g, '')
            const max = parseInt($inp.attr('maxlength')) || 10
            if (digits.length > max) {
                $inp.val(digits.slice(0, max))
            }
        }
    })

    $(document).on('submit', '.contact-form', function (event) {
        event.preventDefault()
        event.stopPropagation()

        const $form = $(this)
        const $button = $form.find('button[type=submit]')

        $('.contact-success-message').html('').hide()
        $('.contact-error-message').html('').hide()

        const $nameInput = $form.find('input[name="name"]')
        const $emailInput = $form.find('input[name="email"]')
        const $phoneInput = $form.find('input[name="phone"]')
        const $contentInput = $form.find('textarea[name="content"]')
        const $termsInput = $form.find('input[name="agree_terms_and_policy"]')

        const nameVal = ($nameInput.val() || '').trim()
        const emailVal = ($emailInput.val() || '').trim()
        const phoneVal = ($phoneInput.val() || '').trim()
        const contentVal = ($contentInput.val() || '').trim()

        // 1. Name validation
        if (!nameVal || nameVal.length < 2) {
            showError('Please enter your name (at least 2 characters).')
            $nameInput.focus()
            return false
        }
        const nameRegex = /^[\p{L}\s.'-]+$/u
        if (!nameRegex.test(nameVal)) {
            showError('The name must only contain letters, spaces, hyphens, and dots.')
            $nameInput.focus()
            return false
        }

        // 2. Email validation
        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,10}$/
        if (!emailVal || !emailRegex.test(emailVal) || emailVal.indexOf('..') !== -1 || emailVal.toLowerCase().indexOf('.c0m') !== -1 || emailVal.toLowerCase().indexOf('@gamil.') !== -1) {
            showError('Please enter a valid email address with a valid domain extension.')
            $emailInput.focus()
            return false
        }

        // 3. Phone validation
        if (!phoneVal) {
            showError('Please enter your phone number.')
            $phoneInput.focus()
            return false
        }
        if (phoneVal.startsWith('+91')) {
            const digits = phoneVal.replace(/\D/g, '').substring(2)
            if (digits.length !== 10 || !['6', '7', '8', '9'].includes(digits[0])) {
                showError('Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9 for India (+91).')
                $phoneInput.focus()
                return false
            }
        } else if (phoneVal.replace(/\D/g, '').length < 7) {
            showError('Please enter a valid phone number.')
            $phoneInput.focus()
            return false
        }

        // 4. Content (Message) validation
        if (!contentVal || contentVal.length < 5) {
            showError('The message must be at least 5 characters.')
            $contentInput.focus()
            return false
        }

        // 5. Terms checkbox
        if ($termsInput.length && !$termsInput.is(':checked')) {
            showError('You must agree to the Terms and Privacy Policy before submitting.')
            $termsInput.focus()
            return false
        }

        $.ajax({
            type: 'POST',
            cache: false,
            url: $form.prop('action'),
            data: new FormData($form[0]),
            contentType: false,
            processData: false,
            beforeSend: () => $button.addClass('button-loading'),
            success: ({ error, message }) => {
                if (!error) {
                    $form[0].reset()
                    showSuccess(message)
                } else {
                    showError(message)
                }

                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }

                document.dispatchEvent(new CustomEvent('contact-form.submitted'))
            },
            error: (error) => {
                if (typeof refreshRecaptcha !== 'undefined') {
                    refreshRecaptcha()
                }
                handleError(error)
            },
            complete: () => $button.removeClass('button-loading'),
        })
    })
})
