<?php

namespace App\Http\Controllers;

use App\Models\Estate;
use App\Traits\imageTrait;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use Illuminate\Console\Scheduling\Event;

class EstateController extends Controller
{
    use imageTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $estate = Estate::all();

        return $estate;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request, Estate $estate)
    {

       //  return 'hello';
        //save an estate
        $estate = new Estate();

        $file = '';
        if($request->hasFile('profileImages')){
           $flier = $request->file('profileImages');
           $new_name = rand() . '.' .$flier->getClientOriginalExtension();
           $folder = 'public/uploads';
           $file = $this->uploadSingle($flier, $folder, $new_name);
          // $estate->flier = $file;  
           //dd($file);   
       }

       $imageName = '';
       $urls = '';
       if ($request->hasFile('images')) {
           $images = $request->file('images');

           foreach($images as $image){
           $fileName = Str::random(25) . '.' . $image->getClientOriginalExtension();
           $folder = 'public/uploads/images';
    
           $imageName = $fileName;
           $urls = $this->uploadMutiple($image, $folder, $imageName);
           }
          
          
           
       }

        $estate->name = $request->input('name');
        $estate->location = $request->input('location');
        $estate->description = $request->input('description');
        $estate->size = $request->input('size');
        $estate->price = $request->input('price');
        $estate->furnished = $request->input('furnished');
        $estate->profileImages = $file;
        $estate->images = explode(' ', $urls);
        $estate->amenities = $request->input('amenities');
        $estate->facilities = $request->input('facilities');
           


        $estate->save();

        return $estate;

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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
