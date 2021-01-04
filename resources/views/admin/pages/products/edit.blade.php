@extends('admin.layouts.app')

@section('title', 'Editar produto')
@section('content')
    <h1>Editar produto {{ $id }}</h1>

    <form action="{{ route('products.update', $id) }}" method="post">
        <!-- Diretiva para definir o verbo da requisição do tipo PUT -->
        @method('PUT')

        <!-- Criação de input hidden com token necessario para formulario -->
        @csrf

        <input type="text" name="name" placeholder="Nome:">
        <input type="text" name="description" placeholder="Descrição:">
        <button type="submit">Enviar</button>
        
    </form>
@endsection