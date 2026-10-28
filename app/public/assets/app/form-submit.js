import { Form } from '/assets/app/lib/form.js';

/**
 * @description Objects.
 */
const form = new Form('form');

/**
 * @description Handle credentials login.
 */
form.onSubmit((event) => {
    event.preventDefault();
    window.loading.show();
    form
        .request(form.getData())
        .catch(() => window.loading.hide());
});
