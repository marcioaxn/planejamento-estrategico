<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use \Illuminate\Session\SessionManager;

ini_set('memory_limit', '7096M');
ini_set('max_execution_time', 9900);
set_time_limit(900000000);

class ShowDashboard extends Component
{

    use WithPagination;

    public $ano = null;

    public function mount(SessionManager $session, $ano)
    {
        $this->ano = $ano;

        $session->put("ano", $this->ano);
    }

    public function render($ano = '')
    {

        $ano = $this->ano;



        return view('livewire.show-dashboard',['ano' => $ano])
        ->layout('layouts.app',['ano' => $ano]);
    }
}
