<!-- Verifica se retornou algum erro na validação, caso sim, imprime os erros na tela -->
@if ($errors->any())
<div class="alert alert-warning">
    <ul>    
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif