<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\BitacoraResource;
use App\Http\Resources\BitacoraCollection;

class UserBitacorasController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, User $user)
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $bitacoras = $user
            ->bitacoras()
            ->search($search)
            ->latest()
            ->paginate();

        return new BitacoraCollection($bitacoras);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Bitacora::class);

        $validated = $request->validate([
            'glosa' => ['required', 'max:255', 'string'],
            'retiro_id' => ['required', 'exists:retiros,id'],
        ]);

        $bitacora = $user->bitacoras()->create($validated);

        return new BitacoraResource($bitacora);
    }
}
