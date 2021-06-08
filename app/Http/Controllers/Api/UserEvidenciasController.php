<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EvidenciaResource;
use App\Http\Resources\EvidenciaCollection;

class UserEvidenciasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $evidencias = $user
            ->evidencias()
            ->search($search)
            ->latest()
            ->paginate();

        return new EvidenciaCollection($evidencias);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Evidencia::class);

        $validated = $request->validate([
            'tipoevidencia_id' => ['required', 'exists:tipoevidencias,id'],
            'url' => ['required', 'url'],
            'retiro_id' => ['required', 'exists:retiros,id'],
        ]);

        $evidencia = $user->evidencias()->create($validated);

        return new EvidenciaResource($evidencia);
    }
}
