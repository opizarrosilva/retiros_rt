<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Llamado extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['estadollamado_id', 'retiro_id', 'user_id'];

    protected $searchableFields = ['*'];

    public function estadollamado()
    {
        return $this->belongsTo(Estadollamado::class);
    }

    public function retiro()
    {
        return $this->belongsTo(Retiro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
