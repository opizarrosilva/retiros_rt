<?php

namespace App\Http\Controllers\Api;

use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\AgendaCollection;

class RetiroAgendasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Retiro $retiro)
    {
        $this->authorize('view', $retiro);

        $search = $request->get('search', '');

        $agendas = $retiro
            ->agendas()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgendaCollection($agendas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Retiro $retiro)
    {
        $this->authorize('create', Agenda::class);

        $validated = $request->validate([
            'fecha' => ['required', 'date', 'date'],
            'bloquehorario_id' => ['required', 'exists:bloquehorarios,id'],
            'glosa' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $agenda = $retiro->agendas()->create($validated);

        return new AgendaResource($agenda);
    }
}
