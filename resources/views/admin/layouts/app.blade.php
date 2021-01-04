<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Page</title>

    <!-- Definição de stack styles - onde deverá ser definido todos os styles que será utilizado pela pagina -->
    @stack('styles')
    
</head>
<body>
    <div class="container">
        <!-- Definição do yield content - onde entrará o conteúdo setado na section de mesmo nome -->
        @yield('content')
    </div>

    <!-- Definição de stack scripts - onde deverá ser definido todos os scripts que será utilizado pela pagina -->
    @stack('scripts')

</body>
</html>