@extends('admin.layouts.app')

@section('title', "Editar produto {$product->name}")

@section('content')
    <h1>Editar produto {{ $product->name }}</h1>

    <form action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data" method="post">
        <!-- Diretiva para definir o verbo da requisição do tipo PUT -->
        @method('PUT')
        @include('admin.pages.products._partials.form')
    </form>
@endsection