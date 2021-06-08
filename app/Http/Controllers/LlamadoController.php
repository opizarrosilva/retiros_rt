<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Llamado;
use Illuminate\Http\Request;
use App\Models\Estadollamado;
use App\Http\Requests\LlamadoStoreRequest;
use App\Http\Requests\LlamadoUpdateRequest;

class LlamadoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Llamado::class);

        $search = $request->get('search', '');

        $llamados = Llamado::search($search)
            ->latest()
            ->paginate(5);

        return view('app.llamados.index', compact('llamados', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Llamado::class);

        $estadollamados = Estadollamado::pluck('glosa', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.llamados.create',
            compact('estadollamados', 'retiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\LlamadoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LlamadoStoreRequest $request)
    {
        $this->authorize('create', Llamado::class);

        $validated = $request->validated();

        $llamado = Llamado::create($validated);

        return redirect()
            ->route('llamados.edit', $llamado)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Llamado $llamado)
    {
        $this->authorize('view', $llamado);

        return view('app.llamados.show', compact('llamado'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Llamado $llamado)
    {
        $this->authorize('update', $llamado);

        $estadollamados = Estadollamado::pluck('glosa', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.llamados.edit',
            compact('llamado', 'estadollamados', 'retiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\LlamadoUpdateRequest $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function update(LlamadoUpdateRequest $request, Llamado $llamado)
    {
        $this->authorize('update', $llamado);

        $validated = $request->validated();

        $llamado->update($validated);

        return redirect()
            ->route('llamados.edit', $llamado)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Llamado $llamado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Llamado $llamado)
    {
        $this->authorize('delete', $llamado);

        $llamado->delete();

        return redirect()
            ->route('llamados.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
