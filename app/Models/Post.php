<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected function timeToRead(): Attribute
    {
        return Attribute::make(
            get: fn ($value, array $attributes) => (
                $value = ceil (str_word_count(strip_tags($attributes['content'])) / 200 )
            )
        );
    }

    protected function title(): Attribute //name column in db, convention db_column_name = dbColumnName()
    {
        return Attribute::make(
            set: fn (string $value) => rtrim($value, '.'), // set: A mutator transforms an Eloquent attribute value when it is set
        );
    }
}
