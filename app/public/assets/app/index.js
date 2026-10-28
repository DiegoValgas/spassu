import { Alert } from '/assets/app/lib/alert.js';
import { Loading } from '/assets/app/lib/loading.js';
import { Api } from '/assets/app/lib/api.js';

/**
 * @description Set window page helpers.
 */
window.alert = new Alert();
window.loading = new Loading();
window.api = new Api();

/**
 * @description Action to confirm record deletion.
 */
window.deleteAction = function(event) {
    event.preventDefault();

    if (!confirm('Deseja mesmo excluir o registro?')) {
        return;
    }

    window.api
        .reset()
        .setMethod('DELETE')
        .setAction(event.target.href)
        .request()
        .catch(() => window.loading.hide());
};

/**
 * @description Action to confirm record restore.
 */
window.restoreAction = function(event) {
    event.preventDefault();

    if (!confirm('Deseja mesmo restaurar o registro?')) {
        return;
    }

    window.api
        .reset()
        .setMethod('PUT')
        .setAction(event.target.href)
        .request({})
        .catch(() => window.loading.hide());
};
