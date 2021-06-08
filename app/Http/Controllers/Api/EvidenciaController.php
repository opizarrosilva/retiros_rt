<?php

namespace App\Http\Controllers\Api;

use App\Models\Evidencia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvidenciaResource;
use App\Http\Resources\EvidenciaCollection;
use App\Http\Requests\EvidenciaStoreRequest;
use App\Http\Requests\EvidenciaUpdateRequest;

class EvidenciaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Evidencia::class);

        $search = $request->get('search', '');

        $evidencias = Evidencia::search($search)
            ->latest()
            ->paginate();

        return new EvidenciaCollection($evidencias);
    }

    /**
     * @param \App\Http\Requests\EvidenciaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EvidenciaStoreRequest $request)
    {
        $this->authorize('create', Evidencia::class);

        $validated = $request->validated();

        $evidencia = Evidencia::create($validated);

        return new EvidenciaResource($evidencia);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Evidencia $evidencia)
    {
        $this->authorize('view', $evidencia);

        return new EvidenciaResource($evidencia);
    }

    /**
     * @param \App\Http\Requests\EvidenciaUpdateRequest $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function update(
        EvidenciaUpdateRequest $request,
        Evidencia $evidencia
    ) {
        $this->authorize('update', $evidencia);

        $validated = $request->validated();

        $evidencia->update($validated);

        return new EvidenciaResource($evidencia);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Evidencia $evidencia)
    {
        $this->authorize('delete', $evidencia);

        $evidencia->delete();

        return response()->noContent();
    }
}
