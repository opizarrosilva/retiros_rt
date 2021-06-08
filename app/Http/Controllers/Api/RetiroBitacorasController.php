<?php

namespace App\Http\Controllers\Api;

use App\Models\Retiro;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BitacoraResource;
use App\Http\Resources\BitacoraCollection;

class RetiroBitacorasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Retiro $retiro)
    {
        $this->authorize('view', $retiro);

        $search = $request->get('search', '');

        $bitacoras = $retiro
            ->bitacoras()
            ->search($search)
            ->latest()
            ->paginate();

        return new BitacoraCollection($bitacoras);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Retiro $retiro
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Retiro $retiro)
    {
        $this->authorize('create', Bitacora::class);

        $validated = $request->validate([
            'glosa' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $bitacora = $retiro->bitacoras()->create($validated);

        return new BitacoraResource($bitacora);
    }
}
