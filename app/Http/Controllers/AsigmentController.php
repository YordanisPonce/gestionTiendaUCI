<?php

namespace App\Http\Controllers;

use App\Models\AreaProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AsigmentController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(AreaProduct::class, 'area_product');
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
                'name' => 'Asignaciones',
                'url' => route('area-products.index'),
                'active' => true
            ],
        ];

        $q = $request->get('q');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort');

        $asigments = QueryBuilder::for(AreaProduct::class)
            ->allowedSorts(['count'])
            ->with(['area', 'product'])
            ->where(function ($query) use ($q) {
                if ($q) {
                    $ids = Product::where('name', 'like', $q . '%')->get(['id'])->pluck('id')->toArray();
                    $query->whereIn('product_id', $ids);
                }
            })
            ->latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);

        return view('asigment.index', [
            'asigments' => $asigments,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Asignaciones'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Http\Response
     */
    public function show(AreaProduct $areaProduct)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Http\Response
     */
    public function edit(AreaProduct $areaProduct)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AreaProduct $areaProduct)
    {
        if (!$request->amount) {
            return redirect()->back();
        }
        $areaProduct->update(['count' => $request->amount]);
        return redirect()->back()->with('message', 'Asignacion actualizada existosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AreaProduct  $areaProduct
     * @return \Illuminate\Http\Response
     */
    public function destroy(AreaProduct $areaProduct)
    {
        $areaProduct->delete();
        return redirect()->back()->with('message', 'Asignacion eliminada existosamente');
    }
}
