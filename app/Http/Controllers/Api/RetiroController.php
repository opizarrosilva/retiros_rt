<?php

namespace App\Http\Controllers\Api;

use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetiroResource;
use App\Http\Resources\RetiroCollection;
use App\Http\Requests\RetiroStoreRequest;
use App\Http\Requests\RetiroUpdateRequest;

class RetiroController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Retiro::class);

        $search = $request->get('search', '');

        $retiros = Retiro::search($search)
            ->latest()
            ->paginate();

        return new RetiroCollection($retiros);
    }

    /**
     * @param \App\Http\Requests\RetiroStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RetiroStoreRequest $request)
    {
        $this->authorize('create', Retiro::class);

        $validated = $request->validated();

        $retiro = Retiro::create($validated);

        return new RetiroResource($retiro);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Retiro $retiro)
    {
        $this->authorize('view', $retiro);

        return new RetiroResource($retiro);
    }

    /**
     * @param \App\Http\Requests\RetiroUpdateRequest $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function update(RetiroUpdateRequest $request, Retiro $retiro)
    {
        $this->authorize('update', $retiro);

        $validated = $request->validated();

        $retiro->update($validated);

        return new RetiroResource($retiro);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Retiro $retiro)
    {
        $this->authorize('delete', $retiro);

        $retiro->delete();

        return response()->noContent();
    }
}
