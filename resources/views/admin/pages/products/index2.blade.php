<!-- Definição do caminho do template padrão -->
@extends('admin.layouts.app')

<!-- Definição da section title -->
@section('title', 'Gestão de produtos')

<!-- Definição da section content -->
@section('content')
    <h1>Exibindo os produtos</h1>

    <a href="{{ route('products.create') }}">Cadastrar</a>
    <hr>

    <!-- Definição de um componente -->
    @component('admin.components.cards')
        
        Um card de exemplo

        <!-- Definição de um slot -->
        @slot('title')
            <h1>Título Card</h1>
        @endslot

    @endcomponent

    <hr>

    <!-- Exemplo de include passando valores -->
    @include('admin.includes.alerts', ['content' => 'Alerta de preço de produtos'])

    <hr>

    <!-- Exemplo de foreach -->
    @isset($produtos)
        @foreach ($produtos as $p)
            <p class="@if ($loop->last) last @endif">{{ $p }}</p>
        @endforeach
    @endisset

    <hr>

    <!-- Exemplo de forelse (Estrutura de repetição que verifica a possibilidade do array estar vazio) -->
    @forelse ($produtos as $p)
        <p class="@if ($loop->first) last @endif">{{ $p }}</p>
    @empty
        <p>Não existem produtos cadastrados</p>
    @endforelse

    <hr>
    
    <!-- Estrutura de condicional com blade -->
    @if ($teste === '123')
        É igual
    @elseif($teste == 123)
        É igual a 123
    @else
        É diferente
    @endif

    <!-- Estrutura inverso ao if, verificando se a expressão é falsa -->
    @unless ($teste === '123')
        É falso
    @else
        É verdadeiro
    @endunless

    <!-- Verifica se a variável foi definida -->
    @isset($teste2)
        {{ $teste2 }}
    @else
    @endisset

    <!-- Verifica se a variável está vazia -->
    @empty($teste3)
        Vazio 
    @else
    @endempty

    <!-- Verifica se o usuário está logado -->
    @auth
        <p>Autentificado</p>
    @else
        <p>Não está autentificado</p>   
    @endauth

    <!-- Verifica se o usuário não está logado -->
    @guest
        <p>Não autentificado</p>
    @else
        <p>Está autentificado</p>
    @endguest

    <!-- Estrutura de repetição do switch case -->
    @switch($teste)
        @case(1)
            Igual a 1
            @break
        @case(2)
            Igual a 2
            @break
        @case(3)
            Igual a 3
            @break
        @case(123)
            Igual a 123
            @break
        @default
            Default
    @endswitch

@endsection

<!-- Envio do conteúdo para o stack definido no template principal -->
@push('styles')
    <style>
        .last{background: #CCC;}
    </style>
@endpush

@push('scripts')
    <script>
        document.body.style.background = '#efefef';
    </script>
@endpush