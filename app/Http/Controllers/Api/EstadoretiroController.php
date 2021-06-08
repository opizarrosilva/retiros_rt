<?php

namespace App\Http\Controllers\Api;

use App\Models\Estadoretiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\EstadoretiroResource;
use App\Http\Resources\EstadoretiroCollection;
use App\Http\Requests\EstadoretiroStoreRequest;
use App\Http\Requests\EstadoretiroUpdateRequest;

class EstadoretiroController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Estadoretiro::class);

        $search = $request->get('search', '');

        $estadoretiros = Estadoretiro::search($search)
            ->latest()
            ->paginate();

        return new EstadoretiroCollection($estadoretiros);
    }

    /**
     * @param \App\Http\Requests\EstadoretiroStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadoretiroStoreRequest $request)
    {
        $this->authorize('create', Estadoretiro::class);

        $validated = $request->validated();

        $estadoretiro = Estadoretiro::create($validated);

        return new EstadoretiroResource($estadoretiro);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Estadoretiro $estadoretiro)
    {
        $this->authorize('view', $estadoretiro);

        return new EstadoretiroResource($estadoretiro);
    }

    /**
     * @param \App\Http\Requests\EstadoretiroUpdateRequest $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function update(
        EstadoretiroUpdateRequest $request,
        Estadoretiro $estadoretiro
    ) {
        $this->authorize('update', $estadoretiro);

        $validated = $request->validated();

        $estadoretiro->update($validated);

        return new EstadoretiroResource($estadoretiro);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Estadoretiro $estadoretiro)
    {
        $this->authorize('delete', $estadoretiro);

        $estadoretiro->delete();

        return response()->noContent();
    }
}
