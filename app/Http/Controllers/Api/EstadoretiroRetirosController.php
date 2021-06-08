<?php

namespace App\Http\Controllers\Api;

use App\Models\Estadoretiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetiroResource;
use App\Http\Resources\RetiroCollection;

class EstadoretiroRetirosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Estadoretiro $estadoretiro)
    {
        $this->authorize('view', $estadoretiro);

        $search = $request->get('search', '');

        $retiros = $estadoretiro
            ->retiros()
            ->search($search)
            ->latest()
            ->paginate();

        return new RetiroCollection($retiros);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Estadoretiro $estadoretiro)
    {
        $this->authorize('create', Retiro::class);

        $validated = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'fechacarga' => ['required', 'date', 'date'],
            'glosa' => ['required', 'max:255', 'string'],
            'user_id' => ['nullable', 'exists:users,id'],
        ]);

        $retiro = $estadoretiro->retiros()->create($validated);

        return new RetiroResource($retiro);
    }
}
