@extends('base')

@php
    $hasRecord = isset($book->id);
@endphp

@section('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
    <div class="container">
        @include('breadcrumb', [
            'breadcrumbs' => [
                ['title' => 'Livros', 'url' => route('books.index')],
                ['title' => $hasRecord ? 'Editar' : 'Criar', 'url' => ''],
            ],
        ])

        <x-box>
            <form action="{{ $hasRecord ? route('books.update', $book->id) : route('books.store') }}" method="POST">
                @csrf

                @if ($hasRecord)
                    @method('PUT')
                @endif

                <div class="row pt-3">
                    <div class="{{ $hasRecord ? 'col-md-6 col-xl-8' : 'col-12' }}">
                        @include('books.fields')
                    </div>

                    @if ($hasRecord)
                        <div class="col-md-6 col-xl-4">
                            @include('books.rel')
                        </div>
                    @endif
                </div>
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-dark">Salvar</button>
                </div>
            </form>
        </x-box>

    </div>
@endsection

@section('footer')
    @if ($hasRecord)
        @include('books.modals')
    @endif
@endsection

@section('post_scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-maskmoney@3.0.2/dist/jquery.maskMoney.min.js"></script>
    <script type="module">
        import { Form } from '/assets/app/lib/form.js';

        // Objects.
        const form = new Form('form');

        // Book form submit action.
        form.onSubmit((event) => {
            event.preventDefault();
            window.loading.show();
            form
                .request(form.getData())
                .catch(() => window.loading.hide());
        });

        // Select actions.
        $(document).ready(function () {
            // Author select.
            $('#filterAuthor').select2({
                dropdownParent: $('#authorModal'),
                placeholder: 'Digite para buscar um author...',
                allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    url: '/authors',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            filter_name: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.data.map(function (author) {
                                return {
                                    id: author.id,
                                    text: author.name
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Subject select.
            $('#filterSubject').select2({
                dropdownParent: $('#subjectModal'),
                placeholder: 'Digite para buscar um assunto...',
                allowClear: true,
                minimumInputLength: 3,
                ajax: {
                    url: '/subjects',
                    dataType: 'json',
                    delay: 250,
                    data: function (params) {
                        return {
                            filter_description: params.term
                        };
                    },
                    processResults: function (data) {
                        return {
                            results: data.data.map(function (subject) {
                                return {
                                    id: subject.id,
                                    text: subject.description
                                };
                            })
                        };
                    },
                    cache: true
                }
            });

            // Add author action
            $('#addAuthor').on('click', function (event) {
                event.preventDefault();

                const author_id = $('#filterAuthor').val();

                if (!author_id) {
                    window.alert.show('Selecione um autor.', 'danger');

                    return;
                }

                window.api.reset();
                window.api.headers.set('Content-Type', 'application/json');
                window.api
                    .setAction($(this).data('route'))
                    .setMethod('PUT')
                    .request({ author_id });
            });

            // Add subject action
            $('#addSubject').on('click', function (event) {
                event.preventDefault();

                const subject_id = $('#filterSubject').val();

                if (!subject_id) {
                    window.alert.show('Selecione um assunto.', 'danger');

                    return;
                }

                window.api.reset();
                window.api.headers.set('Content-Type', 'application/json');
                window.api
                    .setAction($(this).data('route'))
                    .setMethod('PUT')
                    .request({ subject_id });
            });

            // Search field focus.
            $(document).on('select2:open', (e) => {
                setTimeout(() => {
                    const searchField = document.querySelector('.select2-container--open .select2-search__field');

                    if (searchField) {
                        searchField.focus();
                    }
                }, 10);
            });

            // Price mask
            $('#price').maskMoney({
                allowNegative: false,
                thousands: '.',
                decimal: ',',
                affixesStay: true
            }).maskMoney('mask');
        });
    </script>
@endsection
