/**
 * This object handles API requests.
 */
export class Api {
    constructor() {
        this.errorsCode = new Set([404, 500]);
        this.reset();
    }

    /**
     * Set the request headers.
     * @param {Headers} headers The request headers.
     * @return {Api}
     */
    setHeaders(headers) {
        this.headers = headers;

        return this;
    }

    /**
     * Set the request method.
     * @param {string} method The request method.
     * @return {Api}
     */
    setMethod(method) {
        this.method = method;

        return this;
    }

    /**
     * Set the request action.
     * @param {string} action The request action.
     * @return {Api}
     */
    setAction(action) {
        this.action = action;

        return this;
    }

    /**
     * Set the request header token.
     * @return {Api}
     */
    setHeaderToken() {
        this.headers.append(
            'X-CSRF-TOKEN',
            document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        );

        return this;
    }

    /**
     * Reset the object statements.
     * @return {Api}
     */
    reset() {
        this.method = 'GET';
        this.action = '/';
        this.headers = new Headers();
        this.setHeaderToken();

        return this;
    }

    /**
     * @description Submit the form data.
     * @param {FormData|Object} data The form data to submit.
     * @returns {Promise<Response>} The response from the server.
     */
    async request(data = {}) {
        window.loading.show();
        this.headers.set('Accept', 'application/json');

        const response = await fetch(this.action, {
            method: this.method.toUpperCase(),
            body: data instanceof FormData ? data : JSON.stringify(data),
            headers: this.headers
        });
        const json = await response.json();
        const responseData = {...json, ...{status: response.status}};

        window.loading.hide();

        if (responseData.errors) {
            window.alert.show(window.alert.buildMessage(responseData.errors), 'danger');
        } else if (this.errorsCode.has(responseData.status)) {
            window.alert.show(`Error: ${JSON.stringify(responseData)}.`, 'danger');
        } else if (responseData.redirect) {
            window.location.href = responseData.redirect;

            return;
        }

        return responseData;
    }
}
