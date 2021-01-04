<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //Padrão de Injeção de dependencia
    protected $request;

    public function __construct(Request $request){
        $this->request = $request;

        //Utilização de middlewares através do controller
        //$this->middleware('auth');

        //Utilização de middleware em métodos especificos
        /*$this->middleware('auth')->only([
            'create', 'store'
        ]);*/

        //Aplicação de middleware em todos os métodos, exceto..
        /*$this->middleware('auth')->except([
            'index', 'show'
        ]);*/
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teste = 123;
        $teste2 = 321;
        $teste3 = [1,2,3,4,5];
        $produtos = ['TV', 'Geladeira', 'Forno', 'Sofá'];

        //Retorna view passando uma variável, podendo passar como um array
        //[ "key" => "valor" ] ou através do método compact()
        return view('admin.pages.products.index', compact('teste', 'teste2', 'teste3', 'produtos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        //Validações dos campos (Método não recomendável)
        //O Correto é a criação do arquivo Request através do artisan (make:request) e definir no método rules
        /*$request->validate([
            'name' => 'required|min:3|max:255',
            'description' => 'nullable|min:3|max:10000',
            'photo' => 'required|image'
        ]);*/
        
        //Mostra todos os parâmetros recebidos da requisição
        //dd($request->all());

        //Mostra os parâmetros especificos recebidos na requisição
        //dd($request->only(['name', 'description']));

        //Pega um parâmetro especifico
        //dd($request->name);

        //Verifica se possui algum campo com o nome informado
        //dd($request->has('teste'));

        //Retorna todos os campos exceto os informados
        //dd($request->except('_token'));

        //Upload local de arquivos para dentro do projeto
        //Alterar em config/filesystems caso necessite trabalhar com upload na pasta public
        //Verifica se o arquivo é válido
        if($request->file('photo')->isValid()){

            //Realiza o armazenamento do arquivo com um nome aleatório
            //$request->photo->store('products');
            
            //Realiza o upload do arquivo com um nome definido
            $nameFile = $request->name . '.' . $request->photo->extension();
            dd($request->photo->storeAs('products', $nameFile));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return "Exibindo o produto $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.products.edit', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dd('Editando produto...');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "Deletando o produto $id";
    }
}
