<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetiroResource;
use App\Http\Resources\RetiroCollection;

class ClienteRetirosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Cliente $cliente)
    {
        $this->authorize('view', $cliente);

        $search = $request->get('search', '');

        $retiros = $cliente
            ->retiros()
            ->search($search)
            ->latest()
            ->paginate();

        return new RetiroCollection($retiros);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Cliente $cliente)
    {
        $this->authorize('create', Retiro::class);

        $validated = $request->validate([
            'estadoretiro_id' => ['required', 'exists:estadoretiros,id'],
            'fechacarga' => ['required', 'date', 'date'],
            'glosa' => ['required', 'max:255', 'string'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $retiro = $cliente->retiros()->create($validated);

        return new RetiroResource($retiro);
    }
}
