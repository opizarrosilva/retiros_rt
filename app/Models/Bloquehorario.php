<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bloquehorario extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['horainicio', 'horafin'];

    protected $searchableFields = ['*'];

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }
}
