<?php

namespace App\Http\Controllers;

use App\Models\Atributo;
use Illuminate\Http\Request;
use App\Http\Requests\AtributoStoreRequest;
use App\Http\Requests\AtributoUpdateRequest;

class AtributoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Atributo::class);

        $search = $request->get('search', '');

        $atributos = Atributo::search($search)
            ->latest()
            ->paginate(5);

        return view('app.atributos.index', compact('atributos', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Atributo::class);

        return view('app.atributos.create');
    }

    /**
     * @param \App\Http\Requests\AtributoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AtributoStoreRequest $request)
    {
        $this->authorize('create', Atributo::class);

        $validated = $request->validated();

        $atributo = Atributo::create($validated);

        return redirect()
            ->route('atributos.edit', $atributo)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Atributo $atributo)
    {
        $this->authorize('view', $atributo);

        return view('app.atributos.show', compact('atributo'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Atributo $atributo)
    {
        $this->authorize('update', $atributo);

        return view('app.atributos.edit', compact('atributo'));
    }

    /**
     * @param \App\Http\Requests\AtributoUpdateRequest $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function update(AtributoUpdateRequest $request, Atributo $atributo)
    {
        $this->authorize('update', $atributo);

        $validated = $request->validated();

        $atributo->update($validated);

        return redirect()
            ->route('atributos.edit', $atributo)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Atributo $atributo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Atributo $atributo)
    {
        $this->authorize('delete', $atributo);

        $atributo->delete();

        return redirect()
            ->route('atributos.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
