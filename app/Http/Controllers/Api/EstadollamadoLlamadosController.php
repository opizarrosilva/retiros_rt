<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Estadollamado;
use App\Http\Controllers\Controller;
use App\Http\Resources\LlamadoResource;
use App\Http\Resources\LlamadoCollection;

class EstadollamadoLlamadosController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('view', $estadollamado);

        $search = $request->get('search', '');

        $llamados = $estadollamado
            ->llamados()
            ->search($search)
            ->latest()
            ->paginate();

        return new LlamadoCollection($llamados);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('create', Llamado::class);

        $validated = $request->validate([
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $llamado = $estadollamado->llamados()->create($validated);

        return new LlamadoResource($llamado);
    }
}
