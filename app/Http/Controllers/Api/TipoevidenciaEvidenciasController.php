<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Tipoevidencia;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvidenciaResource;
use App\Http\Resources\EvidenciaCollection;

class TipoevidenciaEvidenciasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('view', $tipoevidencia);

        $search = $request->get('search', '');

        $evidencias = $tipoevidencia
            ->evidencias()
            ->search($search)
            ->latest()
            ->paginate();

        return new EvidenciaCollection($evidencias);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('create', Evidencia::class);

        $validated = $request->validate([
            'url' => ['required', 'url'],
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $evidencia = $tipoevidencia->evidencias()->create($validated);

        return new EvidenciaResource($evidencia);
    }
}
