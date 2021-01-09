<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    //Padrão de Injeção de dependencia
    protected $request;
    protected $repository;

    public function __construct(Request $request, Product $product)
    {
        $this->request = $request;
        $this->repository = $product;

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
        $produtos = Product::paginate();

        //Retorna view passando uma variável, podendo passar como um array
        //[ "key" => "valor" ] ou através do método compact()
        return view('admin.pages.products.index', [
            'products' => $produtos
        ]);
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
        //if($request->file('photo')->isValid()){

        //Realiza o armazenamento do arquivo com um nome aleatório
        //$request->photo->store('products');

        //Realiza o upload do arquivo com um nome definido
        //$nameFile = $request->name . '.' . $request->photo->extension();
        //dd($request->photo->storeAs('products', $nameFile));

        //}

        $data = $request->only('name', 'description', 'price');

        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }

        $this->repository->create($data);

        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Retorna um único registro que corresponde a condição do where
        //$product = Product::where('id', $id)->first();

        if (!$product = $this->repository->find($id)) return redirect()->back();

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!$product = $this->repository->find($id)) return redirect()->back();

        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StoreUpdateProductRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        if (!$product = $this->repository->find($id)) return redirect()->back();

        $data = $request->all();

        //Verifica se existe algum arquivo no campo image e verifica se o arquivo upado é valido
        if ($request->hasFile('image') && $request->image->isValid()) {

            //Verifica se existe algum arquivo no campo image e verifica se este arquivo existe salvo localmente
            if ($product->image && Storage::exists($product->image)) {
                //Deleta um arquivo salvo localmente
                Storage::delete($product->image);
            }

            //Armazena o caminho da imagem inserida pelo usuario
            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }

        //Atualiza um registro no banco
        $product->update($data);

        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->repository->where('id', $id)->first();
        if (!$product)
            return redirect()->back();

        //Deleta um registro no banco
        //Verifica se existe algum arquivo no campo image e verifica se este arquivo existe salvo localmente
        if ($product->image && Storage::exists($product->image)) {
            //Deleta um arquivo salvo localmente
            Storage::delete($product->image);
        }
        
        $product->delete();

        return redirect()->route('products.index');
    }

    /**
     * Search Products
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);

        return view('admin.pages.products.index', [
            'products' => $products,
            'filters' => $filters
        ]);
    }
}
