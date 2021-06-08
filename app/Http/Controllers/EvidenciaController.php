<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Evidencia;
use Illuminate\Http\Request;
use App\Models\Tipoevidencia;
use App\Http\Requests\EvidenciaStoreRequest;
use App\Http\Requests\EvidenciaUpdateRequest;

class EvidenciaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Evidencia::class);

        $search = $request->get('search', '');

        $evidencias = Evidencia::search($search)
            ->latest()
            ->paginate(5);

        return view('app.evidencias.index', compact('evidencias', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Evidencia::class);

        $tipoevidencias = Tipoevidencia::pluck('glosa', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.evidencias.create',
            compact('tipoevidencias', 'retiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\EvidenciaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(EvidenciaStoreRequest $request)
    {
        $this->authorize('create', Evidencia::class);

        $validated = $request->validated();

        $evidencia = Evidencia::create($validated);

        return redirect()
            ->route('evidencias.edit', $evidencia)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Evidencia $evidencia)
    {
        $this->authorize('view', $evidencia);

        return view('app.evidencias.show', compact('evidencia'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Evidencia $evidencia)
    {
        $this->authorize('update', $evidencia);

        $tipoevidencias = Tipoevidencia::pluck('glosa', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.evidencias.edit',
            compact('evidencia', 'tipoevidencias', 'retiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\EvidenciaUpdateRequest $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function update(
        EvidenciaUpdateRequest $request,
        Evidencia $evidencia
    ) {
        $this->authorize('update', $evidencia);

        $validated = $request->validated();

        $evidencia->update($validated);

        return redirect()
            ->route('evidencias.edit', $evidencia)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Evidencia $evidencia
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Evidencia $evidencia)
    {
        $this->authorize('delete', $evidencia);

        $evidencia->delete();

        return redirect()
            ->route('evidencias.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
