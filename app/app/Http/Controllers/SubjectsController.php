<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubjectRequest;
use App\Models\Subject;
use App\Traits\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SubjectsController
{
    use Response;

    private string $module = 'subjects.';
    private array $fillable = ['description'];

    /**
     * Listing subjects.
     *
     * @param Request $request The request data.
     */
    public function index(Request $request): View
    {
        $subjects = Subject::when($request->filled('filter_description'), fn ($query) =>
            $query->where('description', 'like', '%' . $request->filter_description . '%')
        )
        ->orderBy('id', 'desc')
        ->paginate(10);

        return view($this->module . 'index', compact('subjects'));
    }

    /**
     * Show form to create a record.
     */
    public function create(): View
    {
        return view($this->module . 'form');
    }

    /**
     * Store subject request data.
     *
     * @param SubjectRequest $request The form request data.
     */
    public function store(SubjectRequest $request): JsonResponse
    {
        $subject = Subject::create($request->only($this->fillable));

        if (!$subject) {
            return $this->error('Erro ao criar assunto.');
        }

        session()->flash('success', 'Assunto ' . $subject->description . ' criado com sucesso.');

        return $this->redirect($this->module . 'edit', $subject->id);
    }

    /**
     * Show form edition data.
     */
    public function edit(Subject $subject): View
    {
        return view($this->module . 'form', compact('subject'));
    }

    /**
     * Update a subject data.
     *
     * @param SubjectRequest $request The request data.
     * @param Subject $subject The subject record.
     */
    public function update(SubjectRequest $request, Subject $subject): JsonResponse
    {
        if (!$subject->update($request->only($this->fillable))) {
            return $this->error('Erro ao atualizar assunto.');
        }

        session()->flash('success', 'Assunto ' . $subject->description . ' atualizado com sucesso.');

        return $this->redirect($this->module . 'edit', $subject->id);
    }

    /**
     * Remove a subject.
     *
     * @param Subject $subject The subject record.
     */
    public function destroy(Subject $subject): JsonResponse
    {
        if (!$subject->delete()) {
            return $this->error('Erro ao remover assunto.');
        }

        session()->flash('success', 'Assunto ' . $subject->description . ' removido com sucesso.');

        return $this->redirect($this->module . 'index');
    }
}
