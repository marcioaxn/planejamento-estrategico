<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Entrega;
use Illuminate\Support\Str;

class EntregasLivewire extends Component
{
    public $entregas;
    public $cod_entrega;
    public $descricao;
    public $percentual;
    public $cod_plano_de_acao;
    public $cod_objetivo_estrategico;

    public $isEditing = false;

    protected $rules = [
        'descricao' => 'required|string|max:255',
        'percentual' => 'required|numeric|min:0|max:100',
        'cod_plano_de_acao' => 'nullable|uuid|exists:pei.tab_plano_de_acao,cod_plano_de_acao',
        'cod_objetivo_estrategico' => 'nullable|uuid|exists:pei.tab_objetivo_estrategico,cod_objetivo_estrategico',
    ];

    public function render()
    {
        $this->entregas = Entrega::all();
        return view('livewire.entrega-component');
    }

    public function resetFields()
    {
        $this->cod_entrega = null;
        $this->descricao = '';
        $this->percentual = 0;
        $this->cod_plano_de_acao = null;
        $this->cod_objetivo_estrategico = null;
        $this->isEditing = false;
    }

    public function create()
    {
        $this->validate();

        Entrega::create([
            'cod_entrega' => Str::uuid(),
            'descricao' => $this->descricao,
            'percentual' => $this->percentual,
            'cod_plano_de_acao' => $this->cod_plano_de_acao,
            'cod_objetivo_estrategico' => $this->cod_objetivo_estrategico,
        ]);

        session()->flash('success', 'Entrega criada com sucesso!');
        $this->resetFields();
    }

    public function edit($id)
    {
        $entrega = Entrega::findOrFail($id);
        $this->cod_entrega = $entrega->cod_entrega;
        $this->descricao = $entrega->descricao;
        $this->percentual = $entrega->percentual;
        $this->cod_plano_de_acao = $entrega->cod_plano_de_acao;
        $this->cod_objetivo_estrategico = $entrega->cod_objetivo_estrategico;
        $this->isEditing = true;
    }

    public function update()
    {
        $this->validate();

        $entrega = Entrega::findOrFail($this->cod_entrega);
        $entrega->update([
            'descricao' => $this->descricao,
            'percentual' => $this->percentual,
            'cod_plano_de_acao' => $this->cod_plano_de_acao,
            'cod_objetivo_estrategico' => $this->cod_objetivo_estrategico,
        ]);

        session()->flash('success', 'Entrega atualizada com sucesso!');
        $this->resetFields();
    }

    public function destroy($id)
    {
        Entrega::findOrFail($id)->delete();
        session()->flash('success', 'Entrega deletada com sucesso!');
    }
}
