/**
 * This object handles form data and submission.
 */
export class Form {
    /**
     * @param {string} formSelector The form selector.
     */
    constructor(formSelector = null) {
        this.formElement = document.querySelector(formSelector);
    }

    /**
     * @param {Function} callback The callback to perform on submit.
     * @description Set the form submit event listener.
     * @returns {void}
     */
    onSubmit(callback) {
        this.formElement.addEventListener('submit', callback);
    }

    /**
     * @description Get the form data.
     * @returns {FormData} The form data.
     */
    getData() {
        return new FormData(this.formElement);
    }

    /**
     * @description Submit the form data.
     * @param {FormData|Object} data The form data to submit.
     * @returns {Promise<Response>} The response from the server.
     */
    async request(data) {
        return window.api
            .reset()
            .setAction(this.formElement.action)
            .setMethod(this.formElement.method)
            .request(data);
    }
}
