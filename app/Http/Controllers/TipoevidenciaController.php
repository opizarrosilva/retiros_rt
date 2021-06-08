<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tipoevidencia;
use App\Http\Requests\TipoevidenciaStoreRequest;
use App\Http\Requests\TipoevidenciaUpdateRequest;

class TipoevidenciaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Tipoevidencia::class);

        $search = $request->get('search', '');

        $tipoevidencias = Tipoevidencia::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.tipoevidencias.index',
            compact('tipoevidencias', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Tipoevidencia::class);

        return view('app.tipoevidencias.create');
    }

    /**
     * @param \App\Http\Requests\TipoevidenciaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(TipoevidenciaStoreRequest $request)
    {
        $this->authorize('create', Tipoevidencia::class);

        $validated = $request->validated();

        $tipoevidencia = Tipoevidencia::create($validated);

        return redirect()
            ->route('tipoevidencias.edit', $tipoevidencia)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('view', $tipoevidencia);

        return view('app.tipoevidencias.show', compact('tipoevidencia'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('update', $tipoevidencia);

        return view('app.tipoevidencias.edit', compact('tipoevidencia'));
    }

    /**
     * @param \App\Http\Requests\TipoevidenciaUpdateRequest $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function update(
        TipoevidenciaUpdateRequest $request,
        Tipoevidencia $tipoevidencia
    ) {
        $this->authorize('update', $tipoevidencia);

        $validated = $request->validated();

        $tipoevidencia->update($validated);

        return redirect()
            ->route('tipoevidencias.edit', $tipoevidencia)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Tipoevidencia $tipoevidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Tipoevidencia $tipoevidencia)
    {
        $this->authorize('delete', $tipoevidencia);

        $tipoevidencia->delete();

        return redirect()
            ->route('tipoevidencias.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
