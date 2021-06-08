<?php

namespace App\Http\Controllers\Api;

use App\Models\Atributo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModificacioneResource;
use App\Http\Resources\ModificacioneCollection;

class AtributoModificacionesController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Atributo $atributo)
    {
        $this->authorize('view', $atributo);

        $search = $request->get('search', '');

        $modificaciones = $atributo
            ->modificaciones()
            ->search($search)
            ->latest()
            ->paginate();

        return new ModificacioneCollection($modificaciones);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Atributo $atributo)
    {
        $this->authorize('create', Modificacione::class);

        $validated = $request->validate([
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $modificacione = $atributo->modificaciones()->create($validated);

        return new ModificacioneResource($modificacione);
    }
}
