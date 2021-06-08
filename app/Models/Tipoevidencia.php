<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tipoevidencia extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['glosa'];

    protected $searchableFields = ['*'];

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class);
    }
}
