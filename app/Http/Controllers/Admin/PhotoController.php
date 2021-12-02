<?php

namespace App\Http\Controllers\Admin;

use App\Album;
use App\Http\Controllers\Controller;
use App\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:photo-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:photo-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Album $album)
    {
        $title = 'Tambah Foto';
        return view('admin.photo.create', compact('title', 'album'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $image = $request->file('file');
        $path = public_path("assets/album/" . $request->name);
        if (!File::exists($path)) {
            File::makeDirectory($path, $mode = 0777, true, true);
        }
        $image_name = '';
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $image_name = time() . '_' . $file->getClientOriginalName();
            $file->move($path, $image_name);
            $photo = new Photo();
            $photo->photo = $image_name;
            $photo->album_id = $request->album_id;
            $photo->status = $request->status;
            $photo->save();
        }

        return response()->json(['success' => $image_name]);
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
    public function destroy(Photo $photo, Request $request)
    {
        $path = public_path("assets\album\\" . $request->album_slug . "\\");
        $path_photo = $path . $photo->photo;
        if (File::exists($path_photo)) {
            unlink($path_photo);
        }
        $photo->delete();
        return redirect()->back()->with('success', 'Foto berhasil dihapus!');
    }
}
