<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrganizacaoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    public function index()
    {
        dd("Aqui 6");
    }

    public function create()
    {
        $email = "marcio.xavierneto@gmail.com";
        $nome = "Marcio A. X. Neto";
        $assunto = "Teste";

        Mail::send('email.cadastro', ['name' => 'Marcio', 'textoEmail' => "Texto de teste."], function($message) use($email, $nome, $assunto) {
            $message->to($email, $nome)->subject($assunto);
            $message->from('admin@maxn.com', 'maxn projetos');
        });

        dd("Aqui 6");
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
