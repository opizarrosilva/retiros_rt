<?php

namespace App\Http\Controllers\Api;

use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LlamadoResource;
use App\Http\Resources\LlamadoCollection;

class RetiroLlamadosController extends Controller
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

        $llamados = $retiro
            ->llamados()
            ->search($search)
            ->latest()
            ->paginate();

        return new LlamadoCollection($llamados);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Retiro $retiro)
    {
        $this->authorize('create', Llamado::class);

        $validated = $request->validate([
            'estadollamado_id' => ['required', 'exists:estadollamados,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $llamado = $retiro->llamados()->create($validated);

        return new LlamadoResource($llamado);
    }
}
