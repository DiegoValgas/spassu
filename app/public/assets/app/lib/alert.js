/**
 * This object handles alert messages.
 */
export class Alert {
    constructor () {
        this.wrapper = document.getElementById('alertModal');
        this.modal = new bootstrap.Modal(this.wrapper);;
    }

    /**
     * Show an alert message.
     * @param {string} message The alert message.
     * @param {string} type The alert type (primary, secondary, success, danger, warning, info, light, dark).
     */
    show (message, type) {
        let content = document.createElement('div');
        let alert = document.createElement('div');
        let button = document.createElement('button');

        alert.classList.add('alert', `alert-${type}`, 'alert-dismissible', 'w-100');
        alert.role = 'alert';

        button.type = 'button';
        button.className = 'btn-close';
        button.setAttribute('data-bs-dismiss', 'modal');
        button.setAttribute('aria-label', 'Close');

        content.innerHTML = message;

        alert.appendChild(content);
        alert.appendChild(button);
        this.wrapper.querySelector('.modal-dialog').innerHTML = '';
        this.wrapper.querySelector('.modal-dialog').appendChild(alert);
        this.modal.show();

        // Hiding the success message automatically based on its length.
        if (type === 'success') {
            let delay = message.length * 60;

            setTimeout(() => {
                this.modal.hide();
            }, delay < 2000 ? 2000 : delay);
        }
    }

    /**
     * Build the alert message from the errors bag.
     * @param {Object} errors The object containing error messages.
     * @returns {string} The HTML string for the alert message.
     */
    buildMessage (errors) {
        if (typeof errors === 'object') {
            return Object.values(errors).flat().join('<br>');
        }

        return 'Undefined error body type.';
    }
}