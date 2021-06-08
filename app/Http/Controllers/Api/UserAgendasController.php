<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\AgendaCollection;

class UserAgendasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $agendas = $user
            ->agendas()
            ->search($search)
            ->latest()
            ->paginate();

        return new AgendaCollection($agendas);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Agenda::class);

        $validated = $request->validate([
            'fecha' => ['required', 'date', 'date'],
            'bloquehorario_id' => ['required', 'exists:bloquehorarios,id'],
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
        ]);

        $agenda = $user->agendas()->create($validated);

        return new AgendaResource($agenda);
    }
}
