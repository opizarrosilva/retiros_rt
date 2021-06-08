<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Retiro;
use Livewire\Component;
use App\Models\Atributo;
use App\Models\Modificacione;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class RetiroModificacionesDetail extends Component
{
    use AuthorizesRequests;

    public Retiro $retiro;
    public Modificacione $modificacione;
    public $retiroAtributos = [];
    public $users = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Modificacione';

    protected $rules = [
        'modificacione.atributo_id' => ['required', 'exists:atributos,id'],
        'modificacione.glosa' => ['required', 'max:255', 'string'],
        'modificacione.user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Retiro $retiro)
    {
        $this->retiro = $retiro;
        $this->retiroAtributos = Atributo::pluck('glosa', 'id');
        $this->users = User::pluck('name', 'id');
        $this->users = User::where('id',Auth::user()->id)->pluck('name', 'id');
        $this->resetModificacione();
    }

    public function resetModificacione()
    {
        $this->modificacione = new Modificacione();
        $this->modificacione->user_id=Auth::user()->id;
    }

    public function newModificacione()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.retiro_modificaciones.new_title');
        $this->resetModificacione();

        $this->showModal();
    }

    public function editModificacione(Modificacione $modificacione)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.retiro_modificaciones.edit_title');
        $this->modificacione = $modificacione;
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

        if (!$this->modificacione->retiro_id) {
            $this->authorize('create', Modificacione::class);

            $this->modificacione->retiro_id = $this->retiro->id;
        } else {
            $this->authorize('update', $this->modificacione);
        }

        $this->modificacione->save();

        $this->hideModal();
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Modificacione::class);

        Modificacione::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetModificacione();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->retiro->modificaciones as $modificacione) {
            array_push($this->selected, $modificacione->id);
        }
    }

    public function render()
    {
        return view('livewire.retiro-modificaciones-detail', [
            'modificaciones' => $this->retiro->modificaciones()->paginate(20),
        ]);
    }
}
