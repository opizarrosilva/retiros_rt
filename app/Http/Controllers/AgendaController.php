<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Agenda;
use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Models\Bloquehorario;
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
            ->paginate(5);

        return view('app.agendas.index', compact('agendas', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Agenda::class);

        $bloquehorarios = Bloquehorario::pluck('id', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.agendas.create',
            compact('bloquehorarios', 'retiros', 'users')
        );
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

        return redirect()
            ->route('agendas.edit', $agenda)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Agenda $agenda)
    {
        $this->authorize('view', $agenda);

        return view('app.agendas.show', compact('agenda'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Agenda $agenda
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Agenda $agenda)
    {
        $this->authorize('update', $agenda);

        $bloquehorarios = Bloquehorario::pluck('id', 'id');
        $retiros = Retiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.agendas.edit',
            compact('agenda', 'bloquehorarios', 'retiros', 'users')
        );
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

        return redirect()
            ->route('agendas.edit', $agenda)
            ->withSuccess(__('crud.common.saved'));
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

        return redirect()
            ->route('agendas.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
