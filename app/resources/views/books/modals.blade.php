<div class="modal fade" id="authorModal" tabindex="-1" aria-labelledby="authorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="authorModalLabel">Adicionar autor</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="filterAuthor" style="width: 100%;"></select>
            </div>
            <div class="modal-footer">
                <button id="addAuthor" type="button" class="btn btn-dark"
                    data-route="{{ route('books.add-author', $book->id) }}">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="subjectModal" tabindex="-1" aria-labelledby="subjectModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="subjectModalLabel">Adicionar assunto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <select id="filterSubject" style="width: 100%;"></select>
            </div>
            <div class="modal-footer">
                <button id="addSubject" type="button" class="btn btn-dark"
                    data-route="{{ route('books.add-subject', $book->id) }}">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</div>
