<script>
    (function() {
        function initEmailValidation() {
            document.querySelectorAll('input[type="email"][name="email"]').forEach(function(input) {
                if (input.dataset.emailCheckInitialized === 'true') {
                    return;
                }
                input.dataset.emailCheckInitialized = 'true';

                const clearError = function() {
                    input.classList.remove('is-invalid');
                    const err = (input.closest('.form-group, .mb-3, div') || input.parentElement).querySelector('.js-email-custom-error');
                    if (err) {
                        err.remove();
                    }
                };

                const validateEmailValue = function() {
                    const val = (input.value || '').trim().toLowerCase();
                    if (!val) {
                        return null;
                    }

                    const atPos = val.lastIndexOf('@');
                    if (atPos === -1) {
                        return @json(__('Please enter a valid email address.'));
                    }

                    const domain = val.slice(atPos + 1);
                    if (!domain || domain.indexOf('.') === -1) {
                        return @json(__('Please enter a valid email address.'));
                    }

                    // TLD syntax: letters only or punycode, no numbers like c0m
                    if (!/\.(?:[a-z]{2,24}|xn--[a-z0-9-]+)$/i.test(domain)) {
                        return @json(__('Please enter a valid email address.'));
                    }

                    const parts = domain.split('.');
                    const provider = parts[0];
                    const tld = parts[parts.length - 1];

                    const typoTlds = ['c0m', 'con', 'comm', 'coom', 'cm', 'vom', 'cpm', 'ogr', 'nte', 'ent'];
                    if (typoTlds.indexOf(tld) !== -1) {
                        return @json(__('Please enter a valid email address.'));
                    }

                    const typoProviders = ['email', 'gamil', 'gmial', 'gmai', 'gmaill', 'gnail', 'gmal', 'gmeil', 'gamail', 'gmaul', 'yahooo', 'yaho', 'yahu', 'hotmial', 'hotmai', 'outlok', 'outllook'];
                    if (typoProviders.indexOf(provider) !== -1) {
                        return @json(__('Please enter a valid email address.'));
                    }

                    if (/@(gmail|googlemail)\.com$/i.test(val)) {
                        const local = val.slice(0, atPos);
                        if (!/^[a-z0-9](?:[a-z0-9.]{4,28})[a-z0-9]$/i.test(local) || local.indexOf('..') !== -1) {
                            return @json(__('Please enter a valid email address.'));
                        }
                    }

                    return null;
                };

                const showError = function(msg) {
                    clearError();
                    input.classList.add('is-invalid');
                    const err = document.createElement('div');
                    err.className = 'invalid-feedback d-block js-email-custom-error';
                    err.textContent = msg;
                    input.insertAdjacentElement('afterend', err);
                };

                input.addEventListener('blur', function() {
                    const err = validateEmailValue();
                    err ? showError(err) : clearError();
                });

                input.addEventListener('input', clearError);

                const form = input.closest('form');
                if (form) {
                    form.addEventListener('submit', function(event) {
                        const err = validateEmailValue();
                        if (err) {
                            event.preventDefault();
                            event.stopImmediatePropagation();
                            showError(err);
                            input.focus();
                        }
                    }, true);
                }
            });
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEmailValidation);
        } else {
            initEmailValidation();
        }
    })();
</script>
