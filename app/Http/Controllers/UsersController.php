<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {               
        $usuarios = User::paginate(20);        
        
        return view('usuarios.index_usuario', ['usuarios'=>$usuarios, 'textoBusqueda'=>'']);
    }

    public function search(Request $request) {

        $usuarios = User::whereRaw('name LIKE "%'.$request->textoBusqueda.'%"')->paginate(20);
        
        return view('usuarios.index_usuario', ['usuarios'=>$usuarios, 'textoBusqueda'=>$request->textoBusqueda]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('usuarios.crear_usuario');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            $rules = [
                'nombre' => 'required',
                'usuario' => 'required',
                'correo' => 'required | email',
                'nacimiento' => 'required | date',
                'password' => 'required'                
            ];

            $messages = [
                'required' => 'El campo :attribute a quedado vacio',
                'email' => 'El campo :attribute no tiene un formato válido',
                'date' => 'La fecha de nacimiento no es válida',
            ];

            $validator = Validator::make($request->all(),$rules, $messages);

            if($validator->fails()) {
                return redirect('usuarios/crear')
                        ->withErrors($validator)
                        ->withInput();
            }

            $extension = $request->file('avatar')->extension();

            $user = new User;

            $user->name = $request->nombre;
            $user->username = $request->usuario;
            $user->email = $request->correo;
            $user->password = \Hash::make($request->password);
            $user->avatar = $request->usuario.'.'.$extension;
            $user->birthday = $request->nacimiento;

            $request->file('avatar')->storeAs('avatares', $user->avatar);

            $user->save();

            return redirect('/usuarios');

        } catch (\Exception $exception) {            
            return redirect('usuarios/crear')            
            ->withErrors([$exception->getMessage()])
            ->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $usuario = User::find($id);

        return view('usuarios.editar_usuario', ['usuario' => $usuario]);
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
        try {

            $rules = [
                'nombre' => 'required',
                'usuario' => 'required',
                'correo' => 'required | email',
                'nacimiento' => 'required | date',                
            ];

            $messages = [
                'required' => 'El campo :attribute a quedado vacio',
                'email' => 'El campo :attribute no tiene un formato válido',
                'date' => 'La fecha de nacimiento no es válida',
            ];

            $validator = Validator::make($request->all(),$rules, $messages);

            if($validator->fails()) {
                return redirect("usuarios/editar/$id")
                        ->withErrors($validator)
                        ->withInput();
            }

            $user = User::find($id);

            $user->name = $request->nombre;
            $user->username = $request->usuario;
            $user->email = $request->correo;

            if(isset($request->cambiar)){
                $user->password = \Hash::make($request->password);    
            }

            if(isset($request->avatar)) {
                $extension = $request->file('avatar')->extension();
                $user->avatar = $request->usuario.'.'.$extension;                
                $request->file('avatar')->storeAs('avatares', $user->avatar);
            }
                        
            $user->birthday = $request->nacimiento;

            $user->save();

            return redirect('/usuarios');

        } catch (\Exception $exception) {            
            return redirect("usuarios/editar/$id")            
            ->withErrors([$exception->getMessage()])
            ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            $user = User::find($request->usuario);
            $user->delete();

            return redirect('/usuarios');
        } catch(\Exception $exception) {
            return redirect("usuarios")            
            ->withErrors([$exception->getMessage()]);            
        }
        
    }
}
