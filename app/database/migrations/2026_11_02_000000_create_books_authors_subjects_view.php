<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(
            <<<SQL
                CREATE VIEW books_authors_subjects AS
                SELECT
                    authors.id AS author_id,
                    authors.author_name,
                    books.id AS book_id,
                    books.title,
                    books.publisher,
                    books.edition,
                    books.publication_year,
                    books.price,
                    subjects.id AS subject_id,
                    subjects.description
                FROM books
                INNER JOIN book_author ON book_author.book_id = books.id
                INNER JOIN authors ON authors.id = book_author.author_id
                INNER JOIN book_subject ON book_subject.book_id = books.id
                INNER JOIN subjects ON subjects.id = book_subject.subject_id
                WHERE books.deleted_at IS NULL
                    AND authors.deleted_at IS NULL
                    AND subjects.deleted_at IS NULL
            SQL
        );
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS books_authors_subjects');
    }
};
