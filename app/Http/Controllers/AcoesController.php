<?php

namespace App\Http\Controllers;

use Mail;
use Session;
use App\Acoes;
use App\Organizacoes;
use App\User;
use App\Municipios;
use App\Modalidades;
use App\TabVisMdr;
use App\TabCarteiraInvestimentoMdr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Response;
use DB;
use Carbon\Carbon;

class AcoesController extends Controller
{
    public function __construct() {

        $this->middleware('auth');
    }
}
