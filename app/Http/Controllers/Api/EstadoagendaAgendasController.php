<?php

namespace App\Http\Controllers\Api;

use App\Models\Estadoagenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\AgendaCollection;

class EstadoagendaAgendasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Estadoagenda $estadoagenda)
    {
        $this->authorize('view', $estadoagenda);

        $search = $request->get('search', '');

        $agendas = $estadoagenda
            ->agendas()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgendaCollection($agendas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Estadoagenda $estadoagenda)
    {
        $this->authorize('create', Agenda::class);

        $validated = $request->validate([
            'fecha' => ['required', 'date', 'date'],
            'bloquehorario_id' => ['required', 'exists:bloquehorarios,id'],
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $agenda = $estadoagenda->agendas()->create($validated);

        return new AgendaResource($agenda);
    }
}
