'use strict';

document.querySelectorAll('[data-mspricing-toggle]').forEach(function (button) {
    button.addEventListener('click', function () {
        var mode = button.dataset.mspricingToggle;

        document.querySelectorAll('[data-mspricing-price]').forEach(function (el) {
            el.classList.toggle('mspricing-plan__price--hidden', el.dataset.mspricingPrice !== mode);
        });

        document.querySelectorAll('[data-mspricing-toggle]').forEach(function (btn) {
            var isActive = btn.dataset.mspricingToggle === mode;
            btn.classList.toggle('mspricing-toggle__button--active', isActive);
            btn.setAttribute('aria-pressed', isActive ? 'true' : 'false');
        });
    });
});
