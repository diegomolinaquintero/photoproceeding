<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// import user model
use App\Models\User;
// import auth facade
use Auth;
// import validator
use Validator;
// import Alert
Use Alert;
// import storage facade
use Storage;




class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userlog = Auth::user();
        return view('user.index',compact('userlog'));
    }

    public function config () {
        $userlog = Auth::user();
        return view('user.config', compact('userlog'));
    }


    public function update(Request $request)
    {
        $user = User::find(Auth::user()->id);
        if ($user) {
            $array_files_validacion = [
                'name' => ['required'],
                'surname' => ['required'],
                'email' => ['required', 'email'],
                'nick' => ['required'],
                'image' => 'file|mimes:jpeg,jpg,bmp,png,avi,mpeg,mp4,pdf|max:20000',
            ];
            if ($user->nick != $request->nick) {
                array_push($array_files_validacion['nick'], 'unique:users');
            }

            if ($user->email != $request->email) {
                array_push($array_files_validacion['email'], 'unique:users');
            }

            $validator = Validator::make($request->all(), $array_files_validacion);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // $ruta = request()->image->store('public/users/'.Auth::user()->id);

            // dd($ruta);
            if (is_null($request->image)) {
                $user->fill($request->input());
                if ($user->save()) {
                    Alert::success('Actualización correcta', 'Se ha actualizado la información correctamente');

                    return redirect()->route('configuracion');
                } else {
                    Alert::warning('Error al guardar la información', 'Por favor intenta nuevamente.');
                }
            } else {
                // $name = request()->image->getClientOriginalName();
                $ext = request()->image->getClientOriginalExtension();
                $user->image = request()->image->storeAs('users/'.Auth::user()->id, Auth::user()->id.'.'.$ext,'public');
                if ($user->image){
                    // $ruta = request()->image->store('public/users/'.Auth::user()->id);
                    $user->name = $request->name;
                    $user->surname = $request->surname;
                    $user->nick = $request->nick;
                    $user->email = $request->email;
                    // $user->image = $ruta;
                    if ($user->save()) {
                        Alert::success('Actualización correcta', 'Se ha actualizado la información correctamente');
        
                        return redirect()->route('configuracion');
                    } else {
                        Alert::warning('Error al guardar la información', 'Por favor intenta nuevamente.');
                    }
                } else {
                    Alert::danger('Ha ocurrido un problema al guardar el archivo', 'Mensaje del sistema');
                    return redirect()->back();
                }    
            }
            
        } else {
            Alert::warning('Error al guardar la información', 'Por favor intenta nuevamente.');
            return redirect()->back();
        }
    }
}
