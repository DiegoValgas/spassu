<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Relatório de livros por autor</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 10px;
            color: #222;
        }

        h1 {
            font-size: 20px;
            margin: 0 0 4px;
        }

        .generated {
            color: #666;
            margin-bottom: 20px;
        }

        h2 {
            font-size: 14px;
            margin: 18px 0 6px;
            padding-bottom: 4px;
            border-bottom: 1px solid #999;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }

        th, td {
            border: 1px solid #bbb;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #eee;
        }

        tr {
            page-break-inside: avoid;
        }
    </style>
</head>
<body>
    <h1>Relatório de livros por autor</h1>
    <div class="generated">Gerado em {{ $generatedAt->format('d/m/Y H:i') }}</div>

    @forelse ($report as $author)
        <h2>{{ $author->name }}</h2>
        <table>
            <thead>
                <tr>
                    <th>Livro</th>
                    <th>Editora</th>
                    <th>Edição</th>
                    <th>Ano de publicação</th>
                    <th>Preço</th>
                    <th>Assuntos</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($author->books as $book)
                    <tr>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->publisher }}</td>
                        <td>{{ $book->edition }}</td>
                        <td>{{ $book->publication_year }}</td>
                        <td>R$ {{ number_format($book->price / 100, 2, ',', '.') }}</td>
                        <td>{{ $book->subjects->isNotEmpty() ? $book->subjects->implode(', ') : 'Sem assunto' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @empty
        <p>Não há livros com autores para exibir.</p>
    @endforelse
</body>
</html>
