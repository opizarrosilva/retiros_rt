<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\Bloquehorario;
use App\Http\Controllers\Controller;
use App\Http\Resources\BloquehorarioResource;
use App\Http\Resources\BloquehorarioCollection;
use App\Http\Requests\BloquehorarioStoreRequest;
use App\Http\Requests\BloquehorarioUpdateRequest;

class BloquehorarioController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Bloquehorario::class);

        $search = $request->get('search', '');

        $bloquehorarios = Bloquehorario::search($search)
            ->latest()
            ->paginate();

        return new BloquehorarioCollection($bloquehorarios);
    }

    /**
     * @param \App\Http\Requests\BloquehorarioStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloquehorarioStoreRequest $request)
    {
        $this->authorize('create', Bloquehorario::class);

        $validated = $request->validated();

        $bloquehorario = Bloquehorario::create($validated);

        return new BloquehorarioResource($bloquehorario);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('view', $bloquehorario);

        return new BloquehorarioResource($bloquehorario);
    }

    /**
     * @param \App\Http\Requests\BloquehorarioUpdateRequest $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function update(
        BloquehorarioUpdateRequest $request,
        Bloquehorario $bloquehorario
    ) {
        $this->authorize('update', $bloquehorario);

        $validated = $request->validated();

        $bloquehorario->update($validated);

        return new BloquehorarioResource($bloquehorario);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('delete', $bloquehorario);

        $bloquehorario->delete();

        return response()->noContent();
    }
}
