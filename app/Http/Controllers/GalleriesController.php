<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Http\Requests\GalleryRequest;
use Illuminate\Http\Request;

class GalleriesController extends Controller
{
    public function __construct() {
        //neautentifikovan user moze samo da vidi listu galerija i galeriju
        $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $requestTitle = $request->input('title');
        // $take = $request->input('take');
        // $skip = $request->input('skip');
        // if($requestTitle) {
        //     return Gallery::search($requestTitle, $take, $skip);
        // }

        // return Gallery::take($take)->skip($skip)->latest()->get();
        return Gallery::all();
    }

    // /**
    //  * Show the form for creating a new resource.
    //  *
    //  * @return \Illuminate\Http\Response
    //  */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        return Gallery::create(
            $request->only([
                'title', 'description'
            ])
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return $gallery;
    }

    // /**
    //  * Show the form for editing the specified resource.
    //  *
    //  * @param  \App\Gallery  $gallery
    //  * @return \Illuminate\Http\Response
    //  */
    // public function edit(Gallery $gallery)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update($request->only('title', 'description'));
        return $gallery;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return $gallery;
    }
}
