<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Modificacione;
use App\Http\Controllers\Controller;
use App\Http\Resources\ModificacioneResource;
use App\Http\Resources\ModificacioneCollection;
use App\Http\Requests\ModificacioneStoreRequest;
use App\Http\Requests\ModificacioneUpdateRequest;

class ModificacioneController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Modificacione::class);

        $search = $request->get('search', '');

        $modificaciones = Modificacione::search($search)
            ->latest()
            ->paginate();

        return new ModificacioneCollection($modificaciones);
    }

    /**
     * @param \App\Http\Requests\ModificacioneStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ModificacioneStoreRequest $request)
    {
        $this->authorize('create', Modificacione::class);

        $validated = $request->validated();

        $modificacione = Modificacione::create($validated);

        return new ModificacioneResource($modificacione);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Modificacione $modificacione)
    {
        $this->authorize('view', $modificacione);

        return new ModificacioneResource($modificacione);
    }

    /**
     * @param \App\Http\Requests\ModificacioneUpdateRequest $request
     * @param \App\Models\Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function update(
        ModificacioneUpdateRequest $request,
        Modificacione $modificacione
    ) {
        $this->authorize('update', $modificacione);

        $validated = $request->validated();

        $modificacione->update($validated);

        return new ModificacioneResource($modificacione);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Modificacione $modificacione)
    {
        $this->authorize('delete', $modificacione);

        $modificacione->delete();

        return response()->noContent();
    }
}
