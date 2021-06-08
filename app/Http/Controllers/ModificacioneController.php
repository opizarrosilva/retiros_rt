<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Atributo;
use Illuminate\Http\Request;
use App\Models\Modificacione;
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
            ->paginate(5);

        return view(
            'app.modificaciones.index',
            compact('modificaciones', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Modificacione::class);

        $atributos = Atributo::pluck('glosa', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.modificaciones.create',
            compact('atributos', 'retiros', 'users')
        );
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

        return redirect()
            ->route('modificaciones.edit', $modificacione)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Modificacione $modificacione)
    {
        $this->authorize('view', $modificacione);

        return view('app.modificaciones.show', compact('modificacione'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Modificacione $modificacione
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Modificacione $modificacione)
    {
        $this->authorize('update', $modificacione);

        $atributos = Atributo::pluck('glosa', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.modificaciones.edit',
            compact('modificacione', 'atributos', 'retiros', 'users')
        );
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

        return redirect()
            ->route('modificaciones.edit', $modificacione)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('modificaciones.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
