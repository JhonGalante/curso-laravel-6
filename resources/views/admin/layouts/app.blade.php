<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    
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