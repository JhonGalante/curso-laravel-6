@include('admin.includes.alerts')

<!-- Criação de input hidden com token necessario para formulario -->
@csrf

<div class="form-group">
    <input type="text" class="form-control" name="name" placeholder="Nome:" value="{{ $product->name ?? old('name') }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="description" placeholder="Descrição:" value="{{ $product->description ?? old('description') }}">
</div>
<div class="form-group">
    <input type="text" class="form-control" name="price" placeholder="Preço:" value="{{ $product->price ?? old('price') }}">
</div>
<div class="form-group">
    <input type="file" class="form-control" name="image">
</div>
<div class="form-group">
    <button type="submit" class="btn btn-success">Enviar</button>
</div>