<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\QueryBuilder\QueryBuilder;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(Product::class, "product");
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $breadcrumbsItems = [
            [
                'name' => 'Products',
                'url' => route('products.index'),
                'active' => true
            ],
        ];

        $q = $request->get('q');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort');

        $products = QueryBuilder::for(Product::class)
            ->allowedSorts(['name'])
            ->where('name', 'like', "%$q%")
            ->latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);

        return view('products.index', [
            'products' => $products,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Productos'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $breadcrumbsItems = [
            [
                'name' => 'Products',
                'url' => route('products.index'),
                'active' => false
            ],
            [
                'name' => 'Create',
                'url' => route('products.create'),
                'active' => true
            ],
        ];

        return view('products.create', [
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Create Product'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = Product::create($request->only('name', 'amount', 'price', 'format'));

        return redirect()->route('products.index')->with('message', 'Producto agregado satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $breadcrumbsItems = [
            [
                'name' => 'products',
                'url' => route('products.index'),
                'active' => false
            ],
            [
                'name' => 'Edit',
                'url' => '#',
                'active' => true
            ],
        ];

        return view('products.edit', [
            'product' => $product,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Edit product',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $product->update($request->only('name', 'amount', 'price', 'format'));
        return redirect()->route('products.index')->with('message', 'Producto actualizado existosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return to_route('products.index')->with('message', 'Producto eliminado satisfactoriamente');
    }
}
