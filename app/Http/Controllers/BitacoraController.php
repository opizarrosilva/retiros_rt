<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Bitacora;
use Illuminate\Http\Request;
use App\Http\Requests\BitacoraStoreRequest;
use App\Http\Requests\BitacoraUpdateRequest;

class BitacoraController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Bitacora::class);

        $search = $request->get('search', '');

        $bitacoras = Bitacora::search($search)
            ->latest()
            ->paginate(5);

        return view('app.bitacoras.index', compact('bitacoras', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Bitacora::class);

        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view('app.bitacoras.create', compact('retiros', 'users'));
    }

    /**
     * @param \App\Http\Requests\BitacoraStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BitacoraStoreRequest $request)
    {
        $this->authorize('create', Bitacora::class);

        $validated = $request->validated();

        $bitacora = Bitacora::create($validated);

        return redirect()
            ->route('bitacoras.edit', $bitacora)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Bitacora $bitacora)
    {
        $this->authorize('view', $bitacora);

        return view('app.bitacoras.show', compact('bitacora'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Bitacora $bitacora)
    {
        $this->authorize('update', $bitacora);

        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.bitacoras.edit',
            compact('bitacora', 'retiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\BitacoraUpdateRequest $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function update(BitacoraUpdateRequest $request, Bitacora $bitacora)
    {
        $this->authorize('update', $bitacora);

        $validated = $request->validated();

        $bitacora->update($validated);

        return redirect()
            ->route('bitacoras.edit', $bitacora)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Bitacora $bitacora
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Bitacora $bitacora)
    {
        $this->authorize('delete', $bitacora);

        $bitacora->delete();

        return redirect()
            ->route('bitacoras.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
