<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Agenda;
use Livewire\Component;
use App\Models\Estadoagenda;
use App\Models\Bloquehorario;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class RetiroAgendasDetail extends Component
{
    use AuthorizesRequests;

    public Retiro $retiro;
    public Agenda $agenda;
    public $retiroBloquehorarios = [];
    public $estadoagendas = [];
    public $retiroUsers = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Agenda';

    protected $rules = [
        'agenda.fecha' => ['required', 'date', 'date'],
        'agenda.bloquehorario_id' => ['required', 'exists:bloquehorarios,id'],
        'agenda.glosa' => ['required', 'max:255', 'string'],
        'agenda.estadoagenda_id' => ['required', 'exists:estadoagendas,id'],
        'agenda.user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Retiro $retiro)
    {
        $this->retiro = $retiro;
        //$this->retiroBloquehorarios = Bloquehorario::pluck('horafin', 'horafin', 'id');
        $this->retiroBloquehorarios = Bloquehorario::all();
        $this->estadoagendas = Estadoagenda::pluck('glosa','id');
        //$this->retiroUsers = User::pluck('name', 'id');
        $this->retiroUsers = User::where('id',Auth::user()->id)->pluck('name', 'id');
        $this->resetAgenda();
    }

    public function resetAgenda()
    {
        $this->agenda = new Agenda();
        $this->agenda->user_id = Auth::user()->id; 
    }

    public function newAgenda()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.retiro_agendas.new_title');
        $this->resetAgenda();

        $this->showModal();
    }

    public function editAgenda(Agenda $agenda)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.retiro_agendas.edit_title');
        $this->agenda = $agenda;
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

        if (!$this->agenda->retiro_id) {
            $this->authorize('create', Agenda::class);

            $this->agenda->retiro_id = $this->retiro->id;
        } else {
            $this->authorize('update', $this->agenda);
        }

        $this->agenda->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Agenda::class);

        Agenda::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetAgenda();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->retiro->agendas as $agenda) {
            array_push($this->selected, $agenda->id);
        }
    }

    public function render()
    {
        return view('livewire.retiro-agendas-detail', [
            'agendas' => $this->retiro->agendas()->paginate(20),
        ]);
    }
}
