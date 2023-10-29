<?php

namespace App\Http\Controllers;

use App\Models\Area;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class AreaController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(Area::class, 'area');
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
                'name' => 'Areas',
                'url' => route('areas.index'),
                'active' => true
            ],
        ];

        $q = $request->get('q');
        $perPage = $request->get('per_page', 10);
        $sort = $request->get('sort');

        $areas = QueryBuilder::for(area::class)
            ->allowedSorts(['name'])
            ->where('name', 'like', "%$q%")
            ->latest()
            ->paginate($perPage)
            ->appends(['per_page' => $perPage, 'q' => $q, 'sort' => $sort]);

        return view('areas.index', [
            'areas' => $areas,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Areas'
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
                'name' => 'Areas',
                'url' => route('areas.index'),
                'active' => false
            ],
            [
                'name' => 'Create',
                'url' => route('areas.create'),
                'active' => true
            ],
        ];

        return view('areas.create', [
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Create area'
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
        $area = Area::create($request->only('name'));

        return redirect()->route('areas.index')->with('message', 'Area agregada satisfactoriamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Area $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Area $area)
    {
        $breadcrumbsItems = [
            [
                'name' => 'areas',
                'url' => route('areas.index'),
                'active' => false
            ],
            [
                'name' => 'Edit',
                'url' => '#',
                'active' => true
            ],
        ];

        return view('areas.edit', [
            'area' => $area,
            'breadcrumbItems' => $breadcrumbsItems,
            'pageTitle' => 'Edit area',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Area $area)
    {
        $area->update($request->only('name'));
        return redirect()->route('areas.index')->with('message', 'Area actualizada existosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Area  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Area $area)
    {
        
        $area->delete();

        return to_route('areas.index')->with('message', 'Area eliminada satisfactoriamente');
    }
}
