@extends('base')

@section('content')
    <div class="container">
        @include('breadcrumb', [
            'breadcrumbs' => [['title' => 'Assuntos', 'url' => '']],
        ])

        <x-filter
            addLink="{{ route('subjects.create') }}"
            addDescription="Adicionar Assunto"
            formAction="{{ route('subjects.index') }}"
        >
            <div class="row pt-3">
                <div class="col-md-12 mb-3">
                    <label for="filterDescription" class="form-label">Descrição</label>
                    <input type="text" class="form-control" id="filterDescription" name="filter_description" value="{{ request('filter_description') }}"
                        placeholder="">
                </div>
            </div>
        </x-filter>

        <div class="mb-2">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Cadastro</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($subjects as $subject)
                        <tr>
                            <th scope="row">{{ $subject->id }}</th>
                            <td>{{ $subject->description }}</td>
                            <td>{{ $subject->created_at->format('d/m/Y') }}</td>
                            <td>
                                <div class="d-flex justify-content-end">
                                    <div class="dropdown">
                                        <a class="btn btn-dark pb-0 pt-1" type="button" data-bs-toggle="dropdown"
                                            aria-expanded="false">
                                            <i class="ph ph-gear"></i>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a class="dropdown-item"
                                                    href="{{ route('subjects.edit', $subject->id)}} ">
                                                    <i class="ph ph-pencil"></i> Editar
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a href="{{ route('subjects.destroy', $subject->id) }}"
                                                    class="dropdown-item text-danger" onclick="deleteAction(event)">
                                                    <i class="ph ph-trash"></i> Excluir
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $subjects->appends(request()->query())->links() }}
    </div>
@endsection
