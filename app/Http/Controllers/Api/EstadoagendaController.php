<?php

namespace App\Http\Controllers\Api;

use App\Models\Estadoagenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EstadoagendaResource;
use App\Http\Resources\EstadoagendaCollection;
use App\Http\Requests\EstadoagendaStoreRequest;
use App\Http\Requests\EstadoagendaUpdateRequest;

class EstadoagendaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Estadoagenda::class);

        $search = $request->get('search', '');

        $estadoagendas = Estadoagenda::search($search)
            ->latest()
            ->paginate();

        return new EstadoagendaCollection($estadoagendas);
    }

    /**
     * @param \App\Http\Requests\EstadoagendaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoagendaStoreRequest $request)
    {
        $this->authorize('create', Estadoagenda::class);

        $validated = $request->validated();

        $estadoagenda = Estadoagenda::create($validated);

        return new EstadoagendaResource($estadoagenda);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Estadoagenda $estadoagenda)
    {
        $this->authorize('view', $estadoagenda);

        return new EstadoagendaResource($estadoagenda);
    }

    /**
     * @param \App\Http\Requests\EstadoagendaUpdateRequest $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function update(
        EstadoagendaUpdateRequest $request,
        Estadoagenda $estadoagenda
    ) {
        $this->authorize('update', $estadoagenda);

        $validated = $request->validated();

        $estadoagenda->update($validated);

        return new EstadoagendaResource($estadoagenda);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Estadoagenda $estadoagenda)
    {
        $this->authorize('delete', $estadoagenda);

        $estadoagenda->delete();

        return response()->noContent();
    }
}
