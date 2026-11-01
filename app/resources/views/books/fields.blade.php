<div class="mb-3">
    <label for="title" class="form-label">Título</label>
    <input
        type="text"
        class="form-control"
        id="title"
        name="title"
        value="{{ $hasRecord ? $book->title : '' }}"
    >
</div>

<div class="row">
    <div class="col-xl-6 mb-3">
        <label for="publisher" class="form-label">Editora</label>
        <input
            type="text"
            class="form-control"
            id="publisher"
            name="publisher"
            value="{{ $hasRecord ? $book->publisher : '' }}"
        >
    </div>

    <div class="col-xl-6 mb-3">
        <label for="price" class="form-label">Preço</label>
        <input
            type="text"
            class="form-control"
            id="price"
            name="price"
            value="{{ $hasRecord ? number_format($book->price, 2, ',', '.') : '' }}"
        >
    </div>
</div>

<div class="row">
    <div class="col-xl-6 mb-3">
        <label for="edition" class="form-label">Edição</label>
        <input
            type="number"
            class="form-control"
            id="edition"
            name="edition"
            value="{{ $hasRecord ? $book->edition : '' }}"
        >
    </div>

    <div class="col-xl-6 mb-3">
        <label for="publication_year" class="form-label">Ano de publicação</label>
        <input
            type="text"
            class="form-control"
            id="publication_year"
            name="publication_year"
            pattern="\d{4}"
            maxlength="4"
            inputmode="numeric"
            value="{{ $hasRecord ? $book->publication_year : '' }}"
        >
    </div>
</div>

