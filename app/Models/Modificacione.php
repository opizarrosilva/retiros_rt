<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Modificacione extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['glosa', 'retiro_id', 'atributo_id', 'user_id'];

    protected $searchableFields = ['*'];

    public function retiro()
    {
        return $this->belongsTo(Retiro::class);
    }

    public function atributo()
    {
        return $this->belongsTo(Atributo::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
