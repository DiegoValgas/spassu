@extends('base')

@php
    $hasRecord = isset($author->id);
@endphp

@section('content')
    <div class="container">
        @include('breadcrumb', [
            'breadcrumbs' => [
                ['title' => 'Autores', 'url' => route('authors.index')],
                ['title' => $hasRecord ? 'Editar' : 'Criar', 'url' => '']
            ],
        ])

        <x-box>
            <form
                action="{{ $hasRecord ? route('authors.update', $author->id) : route('authors.store') }}"
                method="POST">
                @csrf

                @if($hasRecord)
                    @method('PUT')
                @endif

                <div class="row pt-3">
                    <div class="col-md-12 mb-3">
                        <label for="author_name" class="form-label">Nome</label>
                        <input
                            type="text"
                            class="form-control"
                            id="author_name"
                            name="author_name"
                            value="{{ $hasRecord ? $author->author_name : '' }}"
                        >
                    </div>
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">Salvar</button>
                </div>
            </form>
        </x-box>

    </div>
@endsection

@section('post_scripts')
    <script type="module">
        import { Form } from '/assets/app/lib/form.js';

        /**
         * @description Objects.
         */
        const form = new Form('form');

        form.onSubmit((event) => {
            event.preventDefault();
            window.loading.show();
            form
                .request(form.getData())
                .catch(() => window.loading.hide());
        });
    </script>
@endsection
