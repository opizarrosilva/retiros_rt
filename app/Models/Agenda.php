<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Agenda extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'fecha',
        'glosa',
        'bloquehorario_id',
        'retiro_id',
        'user_id',
        'estadoagenda_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'agendas';

    protected $casts = [
        'fecha' => 'date',
    ];

    public function bloquehorario()
    {
        return $this->belongsTo(Bloquehorario::class);
    }

    public function retiro()
    {
        return $this->belongsTo(Retiro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estadoagenda()
    {
        return $this->belongsTo(Estadoagenda::class);
    }
}
