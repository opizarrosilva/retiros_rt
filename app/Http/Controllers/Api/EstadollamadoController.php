<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Estadollamado;
use App\Http\Controllers\Controller;
use App\Http\Resources\EstadollamadoResource;
use App\Http\Resources\EstadollamadoCollection;
use App\Http\Requests\EstadollamadoStoreRequest;
use App\Http\Requests\EstadollamadoUpdateRequest;

class EstadollamadoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Estadollamado::class);

        $search = $request->get('search', '');

        $estadollamados = Estadollamado::search($search)
            ->latest()
            ->paginate();

        return new EstadollamadoCollection($estadollamados);
    }

    /**
     * @param \App\Http\Requests\EstadollamadoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadollamadoStoreRequest $request)
    {
        $this->authorize('create', Estadollamado::class);

        $validated = $request->validated();

        $estadollamado = Estadollamado::create($validated);

        return new EstadollamadoResource($estadollamado);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('view', $estadollamado);

        return new EstadollamadoResource($estadollamado);
    }

    /**
     * @param \App\Http\Requests\EstadollamadoUpdateRequest $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function update(
        EstadollamadoUpdateRequest $request,
        Estadollamado $estadollamado
    ) {
        $this->authorize('update', $estadollamado);

        $validated = $request->validated();

        $estadollamado->update($validated);

        return new EstadollamadoResource($estadollamado);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('delete', $estadollamado);

        $estadollamado->delete();

        return response()->noContent();
    }
}
