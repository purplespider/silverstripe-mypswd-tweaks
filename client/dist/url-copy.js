// Copy button on the CMS URL segment field (see templates/SilverStripe/CMS/Forms/SiteTreeURLSegmentField.ss)
(function () {
    var RESET_DELAY = 2000;

    // Build the URL from the field's current value, so it reflects any edit made since the page loaded
    function getURL(button) {
        var input = button.closest('.field.urlsegment').querySelector('input[data-prefix]');
        if (!input) {
            return button.getAttribute('data-url');
        }

        var prefix = input.getAttribute('data-prefix');
        var value = input.value;
        var base = document.querySelector('base');

        // The homepage lives at the site root, so link there rather than to /home
        if (value === 'home' && base && prefix === base.href) {
            return prefix;
        }

        return prefix + value;
    }

    // Fallback for non-HTTPS environments, where navigator.clipboard isn't available
    function legacyCopy(text) {
        var textarea = document.createElement('textarea');
        textarea.value = text;
        textarea.setAttribute('readonly', '');
        textarea.style.position = 'fixed';
        textarea.style.opacity = '0';
        document.body.appendChild(textarea);
        textarea.select();
        var copied = document.execCommand('copy');
        document.body.removeChild(textarea);
        return copied ? Promise.resolve() : Promise.reject();
    }

    function copy(text) {
        if (navigator.clipboard && window.isSecureContext) {
            return navigator.clipboard.writeText(text).catch(function () {
                return legacyCopy(text);
            });
        }
        return legacyCopy(text);
    }

    function showState(button, label, icon) {
        var labelEl = button.querySelector('.url-copy__label');
        labelEl.textContent = label;
        button.className = button.className.replace(/\bfont-icon-\S+/, icon);
    }

    document.addEventListener('click', function (event) {
        var button = event.target.closest('.url-copy');
        if (!button) {
            return;
        }

        // Lock the width so the button group doesn't jump when the label changes
        button.style.minWidth = button.offsetWidth + 'px';

        copy(getURL(button)).then(function () {
            showState(button, 'Copied', 'font-icon-check-mark');
        }, function () {
            showState(button, 'Copy failed', 'font-icon-cancel');
        }).then(function () {
            clearTimeout(button.copyTimer);
            button.copyTimer = setTimeout(function () {
                showState(button, 'Copy link', 'font-icon-p-multi');
            }, RESET_DELAY);
        });
    });
})();
