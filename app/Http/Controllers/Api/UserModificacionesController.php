<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModificacioneResource;
use App\Http\Resources\ModificacioneCollection;

class UserModificacionesController extends Controller
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

        $modificaciones = $user
            ->modificaciones()
            ->search($search)
            ->latest()
            ->paginate();

        return new ModificacioneCollection($modificaciones);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Modificacione::class);

        $validated = $request->validate([
            'atributo_id' => ['required', 'exists:atributos,id'],
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
        ]);

        $modificacione = $user->modificaciones()->create($validated);

        return new ModificacioneResource($modificacione);
    }
}
