<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthorRequest;
use App\Models\Author;
use App\Traits\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthorsController
{
    use Response;

    private string $module = 'authors.';
    private array $fillable = ['name'];

    /**
     * Listing authors.
     *
     * @param Request $request The request data.
     */
    public function index(Request $request): View
    {
        $authors = Author::when($request->filled('filter_name'), fn ($query) =>
            $query->where('name', 'like', '%' . $request->filter_name . '%')
        )
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view($this->module . 'index', compact('authors'));
    }

    /**
     * Show form to create a record.
     */
    public function create(): View
    {
        return view($this->module . 'form');
    }

    /**
     * Store author request data.
     *
     * @param AuthorRequest $request The form request data.
     */
    public function store(AuthorRequest $request): JsonResponse
    {
        $author = Author::create($request->only($this->fillable));

        if (!$author) {
            return $this->error('Erro ao criar autor.');
        }

        session()->flash('success', 'Autor ' . $author->name . ' criado com sucesso.');

        return $this->redirect($this->module . 'edit', $author->id);
    }

    /**
     * Show form edition data.
     */
    public function edit(Author $author): View
    {
        return view($this->module . 'form', compact('author'));
    }

    /**
     * Update a author data.
     *
     * @param AuthorRequest $request The request data.
     * @param Author $author The author record.
     */
    public function update(AuthorRequest $request, Author $author): JsonResponse
    {
        if (!$author->update($request->only($this->fillable))) {
            return $this->error('Erro ao atualizar author.');
        }

        session()->flash('success', 'Author ' . $author->name . ' atualizado com sucesso.');

        return $this->redirect($this->module . 'edit', $author->id);
    }

    /**
     * Remove an author.
     *
     * @param Author $author The author record.
     */
    public function destroy(Author $author): JsonResponse
    {
        if (!$author->delete()) {
            return $this->error('Erro ao remover author.');
        }

        session()->flash('success', 'Author ' . $author->name . ' removido com sucesso.');

        return $this->redirect($this->module . 'index');
    }
}
