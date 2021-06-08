<?php

namespace App\Http\Controllers\Api;

use App\Models\Agenda;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\AgendaResource;
use App\Http\Resources\AgendaCollection;
use App\Http\Requests\AgendaStoreRequest;
use App\Http\Requests\AgendaUpdateRequest;

class AgendaController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Agenda::class);

        $search = $request->get('search', '');

        $agendas = Agenda::search($search)
            ->latest()
            ->paginate();

        return new AgendaCollection($agendas);
    }

    /**
     * @param \App\Http\Requests\AgendaStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(AgendaStoreRequest $request)
    {
        $this->authorize('create', Agenda::class);

        $validated = $request->validated();

        $agenda = Agenda::create($validated);

        return new AgendaResource($agenda);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Agenda $agenda)
    {
        $this->authorize('view', $agenda);

        return new AgendaResource($agenda);
    }

    /**
     * @param \App\Http\Requests\AgendaUpdateRequest $request
     * @param \App\Models\Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function update(AgendaUpdateRequest $request, Agenda $agenda)
    {
        $this->authorize('update', $agenda);

        $validated = $request->validated();

        $agenda->update($validated);

        return new AgendaResource($agenda);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Agenda $agenda)
    {
        $this->authorize('delete', $agenda);

        $agenda->delete();

        return response()->noContent();
    }
}
