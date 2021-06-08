<?php

namespace App\Http\Controllers\Api;

use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvidenciaResource;
use App\Http\Resources\EvidenciaCollection;

class RetiroEvidenciasController extends Controller
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

        $evidencias = $retiro
            ->evidencias()
            ->search($search)
            ->latest()
            ->paginate();

        return new EvidenciaCollection($evidencias);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Retiro $retiro)
    {
        $this->authorize('create', Evidencia::class);

        $validated = $request->validate([
            'tipoevidencia_id' => ['required', 'exists:tipoevidencias,id'],
            'url' => ['required', 'url'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $evidencia = $retiro->evidencias()->create($validated);

        return new EvidenciaResource($evidencia);
    }
}
