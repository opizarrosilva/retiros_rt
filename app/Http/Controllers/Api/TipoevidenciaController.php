<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Tipoevidencia;
use App\Http\Controllers\Controller;
use App\Http\Resources\TipoevidenciaResource;
use App\Http\Resources\TipoevidenciaCollection;
use App\Http\Requests\TipoevidenciaStoreRequest;
use App\Http\Requests\TipoevidenciaUpdateRequest;

class TipoevidenciaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Tipoevidencia::class);

        $search = $request->get('search', '');

        $tipoevidencias = Tipoevidencia::search($search)
            ->latest()
            ->paginate();

        return new TipoevidenciaCollection($tipoevidencias);
    }

    /**
     * @param \App\Http\Requests\TipoevidenciaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoevidenciaStoreRequest $request)
    {
        $this->authorize('create', Tipoevidencia::class);

        $validated = $request->validated();

        $tipoevidencia = Tipoevidencia::create($validated);

        return new TipoevidenciaResource($tipoevidencia);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('view', $tipoevidencia);

        return new TipoevidenciaResource($tipoevidencia);
    }

    /**
     * @param \App\Http\Requests\TipoevidenciaUpdateRequest $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function update(
        TipoevidenciaUpdateRequest $request,
        Tipoevidencia $tipoevidencia
    ) {
        $this->authorize('update', $tipoevidencia);

        $validated = $request->validated();

        $tipoevidencia->update($validated);

        return new TipoevidenciaResource($tipoevidencia);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('delete', $tipoevidencia);

        $tipoevidencia->delete();

        return response()->noContent();
    }
}
