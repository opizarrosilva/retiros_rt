<?php

namespace App\Http\Controllers\Api;

use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModificacioneResource;
use App\Http\Resources\ModificacioneCollection;

class RetiroModificacionesController extends Controller
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

        $modificaciones = $retiro
            ->modificaciones()
            ->search($search)
            ->latest()
            ->paginate();

        return new ModificacioneCollection($modificaciones);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Retiro $retiro)
    {
        $this->authorize('create', Modificacione::class);

        $validated = $request->validate([
            'atributo_id' => ['required', 'exists:atributos,id'],
            'glosa' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $modificacione = $retiro->modificaciones()->create($validated);

        return new ModificacioneResource($modificacione);
    }
}
