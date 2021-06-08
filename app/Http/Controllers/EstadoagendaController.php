<?php

namespace App\Http\Controllers;

use App\Models\Estadoagenda;
use Illuminate\Http\Request;
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
            ->paginate(5);

        return view(
            'app.estadoagendas.index',
            compact('estadoagendas', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Estadoagenda::class);

        return view('app.estadoagendas.create');
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

        return redirect()
            ->route('estadoagendas.edit', $estadoagenda)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Estadoagenda $estadoagenda)
    {
        $this->authorize('view', $estadoagenda);

        return view('app.estadoagendas.show', compact('estadoagenda'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Estadoagenda $estadoagenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Estadoagenda $estadoagenda)
    {
        $this->authorize('update', $estadoagenda);

        return view('app.estadoagendas.edit', compact('estadoagenda'));
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

        return redirect()
            ->route('estadoagendas.edit', $estadoagenda)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('estadoagendas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
