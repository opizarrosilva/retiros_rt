<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Models\Estadoretiro;
use App\Http\Requests\RetiroStoreRequest;
use App\Http\Requests\RetiroUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Bitacora;

class RetiroController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('view-any', Retiro::class);

        $search = $request->get('search', '');

        $retiros = Retiro::search($search)
            ->latest()
            ->paginate(5);

        return view('app.retiros.index', compact('retiros', 'search'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $this->authorize('create', Retiro::class);

        $clientes = Cliente::pluck('glosa', 'id');
        $estadoretiros = Estadoretiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.retiros.create',
            compact('clientes', 'estadoretiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\RetiroStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RetiroStoreRequest $request)
    {
        $this->authorize('create', Retiro::class);

        $validated = $request->validated();

        $retiro = Retiro::create($validated);

        return redirect()
            ->route('retiros.edit', $retiro)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Retiro $retiro)
    {
        $this->authorize('view', $retiro);

        return view('app.retiros.show', compact('retiro'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Retiro $retiro)
    {
        $this->authorize('update', $retiro);

        $clientes = Cliente::pluck('glosa', 'id');
        $estadoretiros = Estadoretiro::pluck('glosa', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.retiros.edit',
            compact('retiro', 'clientes', 'estadoretiros', 'users')
        );
    }

    /**
     * @param \App\Http\Requests\RetiroUpdateRequest $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function update(RetiroUpdateRequest $request, Retiro $retiro)
    {
        $this->authorize('update', $retiro);

        $validated = $request->validated();

        //BITACORA - Registro        
        if (isset($validated["user_id"])) {
            
            //Cambio de usuario no altera el estado actual
            if ($retiro->user_id != "" && $retiro->user_id != $validated["user_id"]) {
                Bitacora::create([
                    'glosa' => 'CAMBIO DE RESPONSABLE',
                    'retiro_id' => $retiro->id,
                    'user_id' => Auth::user()->id
                ]);
            } 
            
            if ($retiro->user_id == "" && $validated["user_id"]!="") {
                //Asignar Usuario
                Bitacora::create([
                    'glosa' => 'RESPONSABLE ASIGNADO',
                    'retiro_id' => $retiro->id,
                    'user_id' => Auth::user()->id
                ]);

                //Cambiar estado
                $validated["estadoretiro_id"]=2;
            }
        }

        $retiro->update($validated);

        return redirect()
            ->route('retiros.edit', $retiro)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Retiro $retiro)
    {
        $this->authorize('delete', $retiro);

        $retiro->delete();

        return redirect()
            ->route('retiros.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
