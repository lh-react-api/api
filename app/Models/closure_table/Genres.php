<?php
namespace App\Models\closure_table;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class Genres extends ClosureBaseModel
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'genres';

    protected $fillable = [
        'name',
        'parent_id',
        'position',
        'information',
        'image',
    ];

    protected $searches = [
        'name' => 'like',
        'position' => 'eq',
    ];

    /**
     * ClosureTable model instance.
     *
     * @var \App\Models\closure_table\GenresClosure
     */
    protected $closure = 'App\Models\closure_table\GenresClosure';

    public function scopeSearchIndex(Builder $query, Request $request): Builder
    {
        $query->searchByDefined($request);
        $query->orderBy('created_at', 'desc');
        return $query;
    }
}
