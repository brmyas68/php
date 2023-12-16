<?php

namespace App\Http\Controllers;

use App\Repositories\MySQL\CityRepository\InterfaceCityRepository;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private InterfaceCityRepository $interfaceCityRepository;

    public function __construct(InterfaceCityRepository $interfaceCityRepository){
        $this->interfaceCityRepository = $interfaceCityRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display a listing of the resource.
     */
    public function citiesByProvince(int $provinceId)
    {
        $cities=$this->interfaceCityRepository->getByProvinceId($provinceId)->get();
        return $cities;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
