<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Retiro extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'glosa',
        'fechacarga',
        'cliente_id',
        'estadoretiro_id',
        'user_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'fechacarga' => 'datetime',
    ];

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function estadoretiro()
    {
        return $this->belongsTo(Estadoretiro::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function bitacoras()
    {
        return $this->hasMany(Bitacora::class);
    }

    public function modificaciones()
    {
        return $this->hasMany(Modificacione::class);
    }

    public function agendas()
    {
        return $this->hasMany(Agenda::class);
    }

    public function evidencias()
    {
        return $this->hasMany(Evidencia::class);
    }

    public function llamados()
    {
        return $this->hasMany(Llamado::class);
    }
}
