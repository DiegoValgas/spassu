<div class="mb-3">
    <label class="form-label">Autores</label>
    <div class="d-grid gap-2">
        @foreach ($book->authors as $author)
            <div class="card border-dark">
                <div class="card-body d-flex justify-content-between align-items-center py-1">
                    <p class="m-0">{{ $author->name }}</p>
                    <a
                        href="{{ route('books.remove-author', [$book->id, $author->id]) }}"
                        class="text-danger"
                        onclick="deleteAction(event)"
                    >
                        <i class="ph ph-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#authorModal">
            <i class="ph ph-plus"></i> Adicionar
        </button>
    </div>
</div>

<div class="mb-3">
    <label class="form-label">Assuntos</label>
    <div class="d-grid gap-2">
        @foreach ($book->subjects as $subject)
            <div class="card border-dark">
                <div class="card-body d-flex justify-content-between align-items-center py-1">
                    <p class="m-0">{{ $subject->description }}</p>
                    <a
                        href="{{ route('books.remove-subject', [$book->id, $subject->id]) }}"
                        class="text-danger"
                        onclick="deleteAction(event)"
                    >
                        <i class="ph ph-trash"></i>
                    </a>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-sm btn-outline-dark" data-bs-toggle="modal" data-bs-target="#subjectModal">
            <i class="ph ph-plus"></i> Adicionar
        </button>
    </div>
</div>