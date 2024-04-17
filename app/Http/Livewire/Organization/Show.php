<?php

namespace App\Http\Livewire\Organization;

use Livewire\Component;
use App\Models\Organization;
use Livewire\WithPagination;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class Show extends Component
{

    use WithPagination;

    public $nom_organizacao = null;
    public $totalRecords;
    public $loadAmount = 2;

    public function loadMore()
    {
        $this->loadAmount += 2;
    }

    public function mount()
    {
        $totalOrganizacoes = Organization::orderBy('nom_organizacao');

        if (isset($this->nom_organizacao) && !is_null($this->nom_organizacao) && $this->nom_organizacao != '') {
            $totalOrganizacoes = $totalOrganizacoes->where('nom_organizacao', 'LIKE', '%' . $this->nom_organizacao . '%');;
        }

        $totalOrganizacoes = $totalOrganizacoes->count();

        $this->totalRecords = $totalOrganizacoes;
    }

    public function render()
    {

        $nom_organizacao = $this->nom_organizacao;

        $organization = Organization::orderBy('nom_organizacao');

        if (isset($this->nom_organizacao) && !is_null($this->nom_organizacao) && $this->nom_organizacao != '') {

            $organization = $organization->where('nom_organizacao', 'LIKE', '%' . $this->nom_organizacao . '%');
        }

        $organization = $organization->get();

        return view('livewire.organization.show')
        ->with('organization',$organization);
    }
}
