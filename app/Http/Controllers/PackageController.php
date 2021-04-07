<?php

namespace App\Http\Controllers;

use App\Shopifypackages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $packages = Shopifypackages::latest()->get();
        return view('welcome',[
            'packages'=>$packages
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
        $packages = Shopifypackages::latest()->get();
        return $packages;
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
        Shopifypackages::create($request->all());
        $packages = Shopifypackages::latest()->get();
        return $packages;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $packages = Shopifypackages::find($id);
        return(
            [
                'modify_packages'=>$packages,
                'id'=>$id
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $get, $id)
    {

        $this->validate($get, [
            "name" => "required",
            "type" => "required",
            "price" =>"required",
            
        ], [
            "name.required" => "Please enter Name",
            "type.required" => "Please enter Type",
            "price.required" => 'Enter your Price',
           
        ]);

        
        $user = Shopifypackages::find($id);
        $user->name = $get['name'];
        $user->type = $get['type'];
        $user->price = $get['price'];
        
        $user->save();

        
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $package = Shopifypackages::find($id);
        $package->delete();
        return $package;
    }
}
