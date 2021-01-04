@extends('admin.layouts.app')

@section('title', 'Cadastrar novo produto')
@section('content')
    <h1>Cadastrar novo produto</h1>
    
    <!-- Verifica se retornou algum erro na validação, caso sim, imprime os erros na tela -->
    @if ($errors->any())
    <ul>    
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
    @endif

    <!-- Definir o enctype para multipart/form-data para conseguir realizar o upload de arquivos -->
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

        <!-- Criação de input hidden com token necessario para formulario -->
        @csrf

        <input type="text" name="name" placeholder="Nome:" value="{{ old('name') }}">
        <input type="text" name="description" placeholder="Descrição:" value="{{ old('name') }}">
        <input type="file" name="photo">
        <button type="submit">Enviar</button>
        
    </form>
@endsection