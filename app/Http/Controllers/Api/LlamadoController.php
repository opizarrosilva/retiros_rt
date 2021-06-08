<?php

namespace App\Http\Controllers\Api;

use App\Models\Llamado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LlamadoResource;
use App\Http\Resources\LlamadoCollection;
use App\Http\Requests\LlamadoStoreRequest;
use App\Http\Requests\LlamadoUpdateRequest;

class LlamadoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Llamado::class);

        $search = $request->get('search', '');

        $llamados = Llamado::search($search)
            ->latest()
            ->paginate();

        return new LlamadoCollection($llamados);
    }

    /**
     * @param \App\Http\Requests\LlamadoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LlamadoStoreRequest $request)
    {
        $this->authorize('create', Llamado::class);

        $validated = $request->validated();

        $llamado = Llamado::create($validated);

        return new LlamadoResource($llamado);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Llamado $llamado)
    {
        $this->authorize('view', $llamado);

        return new LlamadoResource($llamado);
    }

    /**
     * @param \App\Http\Requests\LlamadoUpdateRequest $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function update(LlamadoUpdateRequest $request, Llamado $llamado)
    {
        $this->authorize('update', $llamado);

        $validated = $request->validated();

        $llamado->update($validated);

        return new LlamadoResource($llamado);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Llamado $llamado)
    {
        $this->authorize('delete', $llamado);

        $llamado->delete();

        return response()->noContent();
    }
}
