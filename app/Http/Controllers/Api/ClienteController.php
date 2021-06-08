<?php

namespace App\Http\Controllers\Api;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ClienteResource;
use App\Http\Resources\ClienteCollection;
use App\Http\Requests\ClienteStoreRequest;
use App\Http\Requests\ClienteUpdateRequest;

class ClienteController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Cliente::class);

        $search = $request->get('search', '');

        $clientes = Cliente::search($search)
            ->latest()
            ->paginate();

        return new ClienteCollection($clientes);
    }

    /**
     * @param \App\Http\Requests\ClienteStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClienteStoreRequest $request)
    {
        $this->authorize('create', Cliente::class);

        $validated = $request->validated();

        $cliente = Cliente::create($validated);

        return new ClienteResource($cliente);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cliente $cliente)
    {
        $this->authorize('view', $cliente);

        return new ClienteResource($cliente);
    }

    /**
     * @param \App\Http\Requests\ClienteUpdateRequest $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(ClienteUpdateRequest $request, Cliente $cliente)
    {
        $this->authorize('update', $cliente);

        $validated = $request->validated();

        $cliente->update($validated);

        return new ClienteResource($cliente);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Cliente $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cliente $cliente)
    {
        $this->authorize('delete', $cliente);

        $cliente->delete();

        return response()->noContent();
    }
}
