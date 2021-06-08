<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RetiroResource;
use App\Http\Resources\RetiroCollection;

class UserRetirosController extends Controller
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

        $retiros = $user
            ->retiros()
            ->search($search)
            ->latest()
            ->paginate();

        return new RetiroCollection($retiros);
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        $this->authorize('create', Retiro::class);

        $validated = $request->validate([
            'cliente_id' => ['required', 'exists:clientes,id'],
            'estadoretiro_id' => ['required', 'exists:estadoretiros,id'],
            'fechacarga' => ['required', 'date', 'date'],
            'glosa' => ['required', 'max:255', 'string'],
        ]);

        $retiro = $user->retiros()->create($validated);

        return new RetiroResource($retiro);
    }
}
