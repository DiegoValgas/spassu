@extends('base')

@section('content')
    <div class="container">
        @include('breadcrumb', [
            'breadcrumbs' => [['title' => 'Autores', 'url' => '']],
        ])

        <x-filter
            addLink="{{ route('authors.create') }}"
            addDescription="Adicionar Autor"
            formAction="{{ route('authors.index') }}"
        >
            <div class="row pt-3">
                <div class="col-md-12 mb-3">
                    <label for="filterName" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="filterName" name="filter_name" value="{{ request('filter_name') }}"
                        placeholder="">
                </div>
            </div>
        </x-filter>

        <div class="mb-2">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Cadastro</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr>
                            <th scope="row">{{ $author->id }}</th>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->created_at->format('d/m/Y') }}</td>
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
                                                    href="{{ route('authors.edit', $author->id)}} ">
                                                    <i class="ph ph-pencil"></i> Editar
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a href="{{ route('authors.destroy', $author->id) }}"
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

        {{ $authors->appends(request()->query())->links() }}
    </div>
@endsection
