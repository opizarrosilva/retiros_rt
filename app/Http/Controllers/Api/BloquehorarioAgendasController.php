<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bloquehorario;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\AgendaCollection;

class BloquehorarioAgendasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('view', $bloquehorario);

        $search = $request->get('search', '');

        $agendas = $bloquehorario
            ->agendas()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgendaCollection($agendas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('create', Agenda::class);

        $validated = $request->validate([
            'fecha' => ['required', 'date', 'date'],
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $agenda = $bloquehorario->agendas()->create($validated);

        return new AgendaResource($agenda);
    }
}
