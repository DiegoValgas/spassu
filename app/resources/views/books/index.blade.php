@extends('base')

@section('content')
    <div class="container">
        @include('breadcrumb', [
            'breadcrumbs' => [['title' => 'Livros', 'url' => '']],
        ])

        <x-filter
            addLink="{{ route('books.create') }}"
            addDescription="Adicionar Livro"
            formAction="{{ route('books.index') }}"
        >
            <div class="row pt-3">
                <div class="col-md-6 mb-3">
                    <label for="filterTitle" class="form-label">Título</label>
                    <input type="text" class="form-control" id="filterTitle" name="filter_title" value="{{ request('filter_title') }}"
                        placeholder="">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="filterPublisher" class="form-label">Editora</label>
                    <input type="text" class="form-control" id="filterPublisher" name="filter_publisher" value="{{ request('filter_publisher') }}"
                        placeholder="">
                </div>
            </div>
        </x-filter>

        <div class="mb-2">
            <table class="table border">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Título</th>
                        <th scope="col">Editora</th>
                        <th scope="col">Edição</th>
                        <th scope="col">Publicação</th>
                        <th scope="col">Preço</th>
                        <th scope="col">&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <th scope="row">{{ $book->id }}</th>
                            <td>{{ $book->title }}</td>
                            <td>{{ $book->publisher }}</td>
                            <td>{{ $book->edition }}</td>
                            <td>{{ $book->publication_year }}</td>
                            <td>{{ 'R$ ' . number_format($book->price, 2, ',', '.') }}</td>
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
                                                    href="{{ route('books.edit', $book->id)}} ">
                                                    <i class="ph ph-pencil"></i> Editar
                                                </a>
                                            </li>
                                            <li>
                                                <hr class="dropdown-divider">
                                            </li>
                                            <li>
                                                <a href="{{ route('books.destroy', $book->id) }}"
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

        {{ $books->appends(request()->query())->links() }}
    </div>
@endsection
