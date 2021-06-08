<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Retiro;
use Livewire\Component;
use App\Models\Evidencia;
use App\Models\Tipoevidencia;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class RetiroEvidenciasDetail extends Component
{
    use AuthorizesRequests;

    public Retiro $retiro;
    public Evidencia $evidencia;
    public $retiroTipoevidencias = [];
    public $users = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Evidencia';

    protected $rules = [
        'evidencia.tipoevidencia_id' => [
            'required',
            'exists:tipoevidencias,id',
        ],
        'evidencia.url' => ['required', 'url'],
        'evidencia.user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Retiro $retiro)
    {
        $this->retiro = $retiro;
        $this->retiroTipoevidencias = Tipoevidencia::pluck('glosa', 'id');
        //$this->users = User::pluck('name', 'id');
        $this->users = User::where('id',Auth::user()->id)->pluck('name', 'id');
        $this->resetEvidencia();
    }

    public function resetEvidencia()
    {
        $this->evidencia = new Evidencia();
        $this->evidencia->user_id = Auth::user()->id;
    }

    public function newEvidencia()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.retiro_evidencias.new_title');
        $this->resetEvidencia();

        $this->showModal();
    }

    public function editEvidencia(Evidencia $evidencia)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.retiro_evidencias.edit_title');
        $this->evidencia = $evidencia;
        $this->showModal();
    }

    public function showModal()
    {
        $this->resetErrorBag();
        $this->showingModal = true;
    }

    public function hideModal()
    {
        $this->showingModal = false;
    }

    public function save()
    {
        $this->validate();

        if (!$this->evidencia->retiro_id) {
            $this->authorize('create', Evidencia::class);

            $this->evidencia->retiro_id = $this->retiro->id;
        } else {
            $this->authorize('update', $this->evidencia);
        }

        $this->evidencia->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Evidencia::class);

        Evidencia::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetEvidencia();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->retiro->evidencias as $evidencia) {
            array_push($this->selected, $evidencia->id);
        }
    }

    public function render()
    {
        return view('livewire.retiro-evidencias-detail', [
            'evidencias' => $this->retiro->evidencias()->paginate(20),
        ]);
    }
}
