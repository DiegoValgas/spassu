/**
 * This object handles loading indicators.
 */
export class Loading {
    constructor () {
        this.wrapper = document.querySelector('.loading-container');
    }

    /**
     * Show the loading indicator.
     */
    show () {
        this.wrapper.classList.remove('d-none');
    }

    /**
     * Hide the loading indicator.
     */
    hide () {
        this.wrapper.classList.add('d-none');
    }
}