<?php

namespace App\Http\Controllers;

use App\Models\Estadoretiro;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view(
            'app.estadoretiros.index',
            compact('estadoretiros', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Estadoretiro::class);

        return view('app.estadoretiros.create');
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

        return redirect()
            ->route('estadoretiros.edit', $estadoretiro)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Estadoretiro $estadoretiro)
    {
        $this->authorize('view', $estadoretiro);

        return view('app.estadoretiros.show', compact('estadoretiro'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoretiro $estadoretiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Estadoretiro $estadoretiro)
    {
        $this->authorize('update', $estadoretiro);

        return view('app.estadoretiros.edit', compact('estadoretiro'));
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

        return redirect()
            ->route('estadoretiros.edit', $estadoretiro)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('estadoretiros.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
