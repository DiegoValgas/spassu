<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookAuthorRequest;
use App\Http\Requests\BookRequest;
use App\Http\Requests\BookSubjectRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Subject;
use App\Traits\Response;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Support\Facades\DB;

class BooksController
{
    use Response;

    private string $module = 'books.';
    private array $fillable = ['title', 'publisher', 'edition', 'price', 'publication_year'];

    /**
     * Listing books.
     *
     * @param Request $request The request data.
     */
    public function index(Request $request): View
    {
        $books = Book::when($request->filled('filter_title'), fn ($query) =>
            $query->where('title', 'like', '%' . $request->filter_title . '%')
        )->when($request->filled('filter_publisher'), fn ($query) =>
            $query->where('publisher', 'like', '%' . $request->filter_publisher . '%')
        )
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view($this->module . 'index', compact('books'));
    }

    /**
     * Display the report of books, authors and subjects grouped by author.
     */
    public function report(): HttpResponse
    {
        $rows = DB::table('books_authors_subjects')
            ->orderBy('author_name')
            ->orderBy('title')
            ->orderBy('description')
            ->get();

        $report = $rows->groupBy('author_id')->map(function ($authorRows) {
            $first = $authorRows->first();

            return (object) [
                'id' => $first->author_id,
                'name' => $first->author_name,
                'books' => $authorRows->groupBy('book_id')->map(function ($bookRows) {
                    $book = $bookRows->first();

                    return (object) [
                        'title' => $book->title,
                        'publisher' => $book->publisher,
                        'edition' => $book->edition,
                        'publication_year' => $book->publication_year,
                        'price' => $book->price,
                        'subjects' => $bookRows->pluck('description')->filter()->unique()->values(),
                    ];
                })->values(),
            ];
        })->values();

        return Pdf::loadView('books.report-pdf', [
            'report' => $report,
            'generatedAt' => now(),
        ])->setPaper('a4', 'landscape')->stream('relatorio-livros-por-autor.pdf');
    }

    /**
     * Show form to create a record.
     */
    public function create(): View
    {
        return view($this->module . 'form');
    }

    /**
     * Store book request data.
     *
     * @param BookRequest $request The form request data.
     */
    public function store(BookRequest $request): JsonResponse
    {
        $book = Book::create($request->only($this->fillable));

        if (!$book) {
            return $this->error('Erro ao criar livro.');
        }

        session()->flash('success', 'Livro ' . $book->title . ' criado com sucesso.');

        return $this->redirect($this->module . 'edit', $book->id);
    }

    /**
     * Show form edition data.
     */
    public function edit(Book $book): View
    {
        return view($this->module . 'form', compact('book'));
    }

    /**
     * Update a book data.
     *
     * @param BookRequest $request The request data.
     * @param Book $book The book record.
     */
    public function update(BookRequest $request, Book $book): JsonResponse
    {
        if (!$book->update($request->only($this->fillable))) {
            return $this->error('Erro ao atualizar livro.');
        }

        session()->flash('success', 'Livro ' . $book->title . ' atualizado com sucesso.');

        return $this->redirect($this->module . 'edit', $book->id);
    }

    /**
     * Remove a book.
     *
     * @param Book $book The book record.
     */
    public function destroy(Book $book): JsonResponse
    {
        if (!$book->delete()) {
            return $this->error('Erro ao remover livro.');
        }

        session()->flash('success', 'Livro ' . $book->title . ' removido com sucesso.');

        return $this->redirect($this->module . 'index');
    }

    /**
     * Include author into book.
     *
     * @param BookAuthorRequest $request The request data.
     * @param Book $book The book record.
     */
    public function addAuthor(BookAuthorRequest $request, Book $book): JsonResponse
    {
        $author = Author::find($request->author_id);

        if (!$author) {
            return $this->error('Autor inválido.');
        } elseif ($book->authors()->where('author_id', $author->id)->exists()) {
            return $this->error('O autor selecionado já pertence a este livro.');
        }

        $book->authors()->attach($author->id);
        session()->flash('success', 'Author ' . $author->author_name . ' adicionado com sucesso.');

        return $this->redirect($this->module . 'edit', $book->id);
    }

    /**
     * Remove author from book.
     *
     * @param Book $book The book record.
     * @param Author $author The author record.
     */
    public function removeAuthor(Book $book, Author $author)
    {
        if (!$book->authors()->where('author_id', $author->id)->exists()) {
            return $this->error('O autor não pertence a este livro.');
        }

        $book->authors()->detach($author->id);
        session()->flash('success', 'Author ' . $author->author_name . ' removido com sucesso.');

        return $this->redirect($this->module . 'edit', $book->id);
    }

    /**
     * Include subject into book.
     *
     * @param BookSubjectRequest $request The request data.
     * @param Book $book The book record.
     */
    public function addSubject(BookSubjectRequest $request, Book $book): JsonResponse
    {
        $subject = Subject::find($request->subject_id);

        if (!$subject) {
            return $this->error('Assunto inválido.');
        } elseif ($book->subjects()->where('subject_id', $subject->id)->exists()) {
            return $this->error('O assunto selecionado já pertence a este livro.');
        }

        $book->subjects()->attach($subject->id);
        session()->flash('success', 'Assunto ' . $subject->description . ' adicionado com sucesso.');

        return $this->redirect($this->module . 'edit', $book->id);
    }

    /**
     * Remove subject from book.
     *
     * @param Book $book The book record.
     * @param Subject $subject The subject record.
     */
    public function removeSubject(Book $book, Subject $subject)
    {
        if (!$book->subjects()->where('subject_id', $subject->id)->exists()) {
            return $this->error('O assunto não pertence a este livro.');
        }

        $book->subjects()->detach($subject->id);
        session()->flash('success', 'Assunto ' . $subject->description . ' removido com sucesso.');

        return $this->redirect($this->module . 'edit', $book->id);
    }
}
