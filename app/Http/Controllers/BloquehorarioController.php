<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bloquehorario;
use App\Http\Requests\BloquehorarioStoreRequest;
use App\Http\Requests\BloquehorarioUpdateRequest;

class BloquehorarioController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Bloquehorario::class);

        $search = $request->get('search', '');

        $bloquehorarios = Bloquehorario::search($search)
            ->latest()
            ->paginate(5);

        return view(
            'app.bloquehorarios.index',
            compact('bloquehorarios', 'search')
        );
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Bloquehorario::class);

        return view('app.bloquehorarios.create');
    }

    /**
     * @param \App\Http\Requests\BloquehorarioStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloquehorarioStoreRequest $request)
    {
        $this->authorize('create', Bloquehorario::class);

        $validated = $request->validated();

        $bloquehorario = Bloquehorario::create($validated);

        return redirect()
            ->route('bloquehorarios.edit', $bloquehorario)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('view', $bloquehorario);

        return view('app.bloquehorarios.show', compact('bloquehorario'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('update', $bloquehorario);

        return view('app.bloquehorarios.edit', compact('bloquehorario'));
    }

    /**
     * @param \App\Http\Requests\BloquehorarioUpdateRequest $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function update(
        BloquehorarioUpdateRequest $request,
        Bloquehorario $bloquehorario
    ) {
        $this->authorize('update', $bloquehorario);

        $validated = $request->validated();

        $bloquehorario->update($validated);

        return redirect()
            ->route('bloquehorarios.edit', $bloquehorario)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bloquehorario $bloquehorario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bloquehorario $bloquehorario)
    {
        $this->authorize('delete', $bloquehorario);

        $bloquehorario->delete();

        return redirect()
            ->route('bloquehorarios.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
