<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Estadollamado;
use App\Http\Requests\EstadollamadoStoreRequest;
use App\Http\Requests\EstadollamadoUpdateRequest;

class EstadollamadoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Estadollamado::class);

        $search = $request->get('search', '');

        $estadollamados = Estadollamado::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.estadollamados.index',
            compact('estadollamados', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Estadollamado::class);

        return view('app.estadollamados.create');
    }

    /**
     * @param \App\Http\Requests\EstadollamadoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EstadollamadoStoreRequest $request)
    {
        $this->authorize('create', Estadollamado::class);

        $validated = $request->validated();

        $estadollamado = Estadollamado::create($validated);

        return redirect()
            ->route('estadollamados.edit', $estadollamado)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('view', $estadollamado);

        return view('app.estadollamados.show', compact('estadollamado'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('update', $estadollamado);

        return view('app.estadollamados.edit', compact('estadollamado'));
    }

    /**
     * @param \App\Http\Requests\EstadollamadoUpdateRequest $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function update(
        EstadollamadoUpdateRequest $request,
        Estadollamado $estadollamado
    ) {
        $this->authorize('update', $estadollamado);

        $validated = $request->validated();

        $estadollamado->update($validated);

        return redirect()
            ->route('estadollamados.edit', $estadollamado)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadollamado $estadollamado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Estadollamado $estadollamado)
    {
        $this->authorize('delete', $estadollamado);

        $estadollamado->delete();

        return redirect()
            ->route('estadollamados.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
