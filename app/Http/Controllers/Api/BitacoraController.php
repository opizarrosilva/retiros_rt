<?php

namespace App\Http\Controllers\Api;

use App\Models\Bitacora;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BitacoraResource;
use App\Http\Resources\BitacoraCollection;
use App\Http\Requests\BitacoraStoreRequest;
use App\Http\Requests\BitacoraUpdateRequest;

class BitacoraController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Bitacora::class);

        $search = $request->get('search', '');

        $bitacoras = Bitacora::search($search)
            ->latest()
            ->paginate();

        return new BitacoraCollection($bitacoras);
    }

    /**
     * @param \App\Http\Requests\BitacoraStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BitacoraStoreRequest $request)
    {
        $this->authorize('create', Bitacora::class);

        $validated = $request->validated();

        $bitacora = Bitacora::create($validated);

        return new BitacoraResource($bitacora);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bitacora $bitacora)
    {
        $this->authorize('view', $bitacora);

        return new BitacoraResource($bitacora);
    }

    /**
     * @param \App\Http\Requests\BitacoraUpdateRequest $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function update(BitacoraUpdateRequest $request, Bitacora $bitacora)
    {
        $this->authorize('update', $bitacora);

        $validated = $request->validated();

        $bitacora->update($validated);

        return new BitacoraResource($bitacora);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bitacora $bitacora)
    {
        $this->authorize('delete', $bitacora);

        $bitacora->delete();

        return response()->noContent();
    }
}
