<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// import Image model
use App\Models\Image;
// import auth facade
use Auth;
// import validator
use Validator;
// import Alert
Use Alert;
// import storage facade
use Storage;

class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        $userlog = Auth::user();
        return view('image.upload',compact('userlog'));
    }

    public function store(Request $request)
    {
        // model images
        $image = new Image;
        $array_files_validacion = [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => ['required'],
        ];

        $validator = Validator::make($request->all(), $array_files_validacion);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $name = request()->image->getClientOriginalName();
        $ext = request()->image->getClientOriginalExtension();
        $image->image_path = request()->image->storeAs('users/'.Auth::user()->id.'/content', Auth::user()->id.'_'.$name.$ext,'public');
        if ($image->image_path){
            $image->user_id = Auth::user()->id;
            $image->description = $request->description;
            if ($image->save()) {
                Alert::success('Carga Exitosa', 'Se ha subido tu imagen correctamente');

                return redirect()->route('home');
            } else {
                Alert::warning('Error al guardar la información', 'Por favor intenta nuevamente.');
            }
        } else {
            Alert::danger('Ha ocurrido un problema al guardar el archivo', 'Mensaje del sistema');
            return redirect()->back();
        }
    }
}   
