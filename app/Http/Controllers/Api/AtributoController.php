<?php

namespace App\Http\Controllers\Api;

use App\Models\Atributo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AtributoResource;
use App\Http\Resources\AtributoCollection;
use App\Http\Requests\AtributoStoreRequest;
use App\Http\Requests\AtributoUpdateRequest;

class AtributoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Atributo::class);

        $search = $request->get('search', '');

        $atributos = Atributo::search($search)
            ->latest()
            ->paginate();

        return new AtributoCollection($atributos);
    }

    /**
     * @param \App\Http\Requests\AtributoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtributoStoreRequest $request)
    {
        $this->authorize('create', Atributo::class);

        $validated = $request->validated();

        $atributo = Atributo::create($validated);

        return new AtributoResource($atributo);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Atributo $atributo)
    {
        $this->authorize('view', $atributo);

        return new AtributoResource($atributo);
    }

    /**
     * @param \App\Http\Requests\AtributoUpdateRequest $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function update(AtributoUpdateRequest $request, Atributo $atributo)
    {
        $this->authorize('update', $atributo);

        $validated = $request->validated();

        $atributo->update($validated);

        return new AtributoResource($atributo);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Atributo $atributo)
    {
        $this->authorize('delete', $atributo);

        $atributo->delete();

        return response()->noContent();
    }
}
