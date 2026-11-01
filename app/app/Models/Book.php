<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Book extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'title',
        'publisher',
        'edition',
        'price',
        'publication_year',
    ];

    /**
     * Store price in cents as an integer and expose it as a decimal amount.
     */
    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => (float) $value / 100,
            set: function ($value) {
                if ($value === null || $value === '') {
                    return null;
                }

                $normalized = str_replace('.', '', (string) $value);
                $normalized = str_replace(',', '.', $normalized);

                return (int) round((float) $normalized * 100);
            },
        );
    }

    public function authors()
    {
        return $this->belongsToMany(Author::class, 'book_author');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'book_subject');
    }
}
