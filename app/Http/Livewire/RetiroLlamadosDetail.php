<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Retiro;
use App\Models\Bitacora;
use Livewire\Component;
use App\Models\Llamado;
use App\Models\Estadollamado;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class RetiroLlamadosDetail extends Component
{
    use AuthorizesRequests;

    public Retiro $retiro;
    public Llamado $llamado;
    public $retiroEstadollamados = [];
    public $users = [];

    public $selected = [];
    public $editing = false;
    public $allSelected = false;
    public $showingModal = false;

    public $modalTitle = 'New Llamado';


    protected $rules = [
        'llamado.estadollamado_id' => ['required', 'exists:estadollamados,id'],
        'llamado.user_id' => ['required', 'exists:users,id'],
    ];

    public function mount(Retiro $retiro)
    {
        $this->retiro = $retiro;
        $this->retiroEstadollamados = Estadollamado::pluck('glosa', 'id');
        //$this->users = User::pluck('name', 'id');
        $this->users = User::where('id', Auth::user()->id)->pluck('name', 'id');
        $this->resetLlamado();
    }

    public function resetLlamado()
    {
        $this->llamado = new Llamado();
        $this->llamado->user_id = Auth::user()->id;
    }

    public function newLlamado()
    {
        $this->editing = false;
        $this->modalTitle = trans('crud.retiro_llamados.new_title');
        $this->resetLlamado();
        $this->showModal();
    }

    public function editLlamado(Llamado $llamado)
    {
        $this->editing = true;
        $this->modalTitle = trans('crud.retiro_llamados.edit_title');
        $this->llamado = $llamado;
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

        if (!$this->llamado->retiro_id) {
            $this->authorize('create', Llamado::class);

            $this->llamado->retiro_id = $this->retiro->id;
        } else {
            $this->authorize('update', $this->llamado);
        }

        $this->llamado->save();

        //Cambio de estado
        if ($this->llamado->estadollamado_id < 3) {
            if ($this->llamado->estadollamado_id == 1) $estadoretiro = 3;
            if ($this->llamado->estadollamado_id == 2) $estadoretiro = 9;

            $retiroestado = Retiro::find($this->retiro["id"]);
            $retiroestado->estadoretiro_id=$estadoretiro;
            $retiroestado->save();
            $glosabitacora = $this->llamado->estadollamado->glosa;
        } else {
            $glosabitacora = "LLAMADA EXITOSA";
        }

        Bitacora::create([
            'glosa' => $glosabitacora,
            'retiro_id' => $this->retiro["id"],
            'user_id' => Auth::user()->id
        ]);

        $this->hideModal();

        return redirect()->route('retiros.edit', $this->retiro["id"]);
    }

    public function destroySelected()
    {
        $this->authorize('delete-any', Llamado::class);

        Llamado::whereIn('id', $this->selected)->delete();

        $this->selected = [];
        $this->allSelected = false;

        $this->resetLlamado();
    }

    public function toggleFullSelection()
    {
        if (!$this->allSelected) {
            $this->selected = [];
            return;
        }

        foreach ($this->retiro->llamados as $llamado) {
            array_push($this->selected, $llamado->id);
        }
    }

    public function render()
    {
        return view('livewire.retiro-llamados-detail', [
            'llamados' => $this->retiro->llamados()->paginate(20),
        ]);
    }
}
