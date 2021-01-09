@extends('admin.layouts.app')

@section('title', 'Cadastrar novo produto')
@section('content')
    <h1>Cadastrar novo produto</h1>

    <!-- Definir o enctype para multipart/form-data para conseguir realizar o upload de arquivos -->
    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" class="form">
        @include('admin.pages.products._partials.form')
    </form>
@endsection