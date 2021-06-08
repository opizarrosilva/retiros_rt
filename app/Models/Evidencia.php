<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evidencia extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['url', 'retiro_id', 'tipoevidencia_id', 'user_id'];

    protected $searchableFields = ['*'];

    public function retiro()
    {
        return $this->belongsTo(Retiro::class);
    }

    public function tipoevidencia()
    {
        return $this->belongsTo(Tipoevidencia::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
