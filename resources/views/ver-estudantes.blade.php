@extends('layout.app')
@section('content')
<?php $l= 0; ?>

<div class="container">
<h2 class="text-center">Crud Laravel </h2>
<a class="btn btn-secondary btn-sm" href="/add-estudante">Novo Estudante</a>

@if(count($estudantes) > 0)
   <table class="table table-striped table-hover table-sm">
        <thead><th>N°</th><th>Perfil do Aluno</th><th>Detalhes Contato</th><th>Ação</th></thead>   
        <tbody>
        @foreach($estudantes as $a)
        <?php $l++; ?>
        <tr>
        <td>{$l}</td>

        <td>
        <div class="row">
            <div class="col-6">
            <img class="img-fluid" src="{asset($a->imagem_perfil)}"/>
            </div>

            <div class="col-6">
            <h5><b>Nome: </b>{$a->nome} {$a->nome_meio} {$a->sobrenome}</h5>
            <h5>
                <b>Data Nascimento: </b>
                {$a->data_nascimento}
            </h5>
            <h5>
                <b>Qualificação: </b>
                {$a->qualificacao}
            </h5>
            </div>
        </div>
        </td>
        <td>
            <h5>
            <b>Email: </b>
            {$a->email}
            </h5>
            <h5>
            <b>Celular: </b>
            {$a->contato}
            </h5>
        </td>
        <td>
        <div class="row">
            <a class="btn btn-primary btn-sm" href="/editar/estudante/{$a->id}">Editar</a>
            <a class="btn btn-danger btn-sm" href="/deletar-estudante/{$a->id}" onclick="return confirm('Você tem certeza que quer deletar{$a->nome} {$a->meio_nome} {$a->sobrenome} perfil');">Deletar</a>
        </div>
        </td>
        </tr>
        @endforeach
        </tbody>
   </table>
@else
<h5 class="text-center p-5">Não há registros</h5>
@endif
@endsection
