<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\LlamadoResource;
use App\Http\Resources\LlamadoCollection;

class UserLlamadosController extends Controller
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

        $llamados = $user
            ->llamados()
            ->search($search)
            ->latest()
            ->paginate();

        return new LlamadoCollection($llamados);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Llamado::class);

        $validated = $request->validate([
            'estadollamado_id' => ['required', 'exists:estadollamados,id'],
            'retiro_id' => ['required', 'exists:retiros,id'],
        ]);

        $llamado = $user->llamados()->create($validated);

        return new LlamadoResource($llamado);
    }
}
