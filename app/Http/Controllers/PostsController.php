<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::paginate(20);

        return view('posts.index_posts', ['posts'=>$posts, 'textoBusqueda'=>'']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.crear_post');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $rules = [
                'titulo' => 'required',                 
                #'portada' => 'required|mimetypes:image/jpg,image/jpeg,',
                'slug' => 'required',                
                
            ];

            $messages = [
                'required' => 'No se a especificado ningún valor',                
                #'mimetypes' => 'El archivo debe ser de tipo JPG',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails())
            {
                return redirect('posts/crear')
                        ->withErrors($validator)
                        ->withInput();
            }            

            $post = new Post;            
            $post->title = $request->titulo;
            $post->content = $request->contenido;
            $post->slug = $request->slug;

            if($request->file('portada') != null) {
                $post->image = $request->file('portada')->getClientOriginalName();        
                $request->file('portada')->storeAs('portadas', $post->image);
            }
            
            $post->save();            

            return redirect('/posts');

        }catch (\Exception $exception) { 
        return redirect('post/crear')            
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
        $post = Post::find($id);
        return view('posts/preview',['post'=>$post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);

        return view('posts.editar_post', ['post'=> $post]);
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
        try
        {
            $rules = [
                'titulo' => 'required',                 
                #'portada' => 'required|mimetypes:image/jpg,image/jpeg,',
                'slug' => 'required',                
                
            ];

            $messages = [
                'required' => 'No se a especificado ningún valor',                
                #'mimetypes' => 'El archivo debe ser de tipo JPG',
            ];

            $validator = Validator::make($request->all(), $rules, $messages);

            if($validator->fails())
            {
                return redirect('posts/editar')
                        ->withErrors($validator)
                        ->withInput();
            }            

            $post = Post::find($id);            
            $post->title = $request->titulo;
            $post->content = $request->contenido;
            $post->slug = $request->slug;

            if($request->file('portada') != null) {
                $post->image = $request->file('portada')->getClientOriginalName();        
                $request->file('portada')->storeAs('imagenes_portada', $post->portada);
            }
            $post->save();            

            return redirect('/posts');

        }catch (\Exception $exception) {            
        return redirect('posts/editar')            
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
            $post = Post::find($request->post);
            $post->delete();

            return redirect('/posts');
        } catch(\Exception $exception) {
            return redirect("posts")            
            ->withErrors([$exception->getMessage()]);            
        }
    }
}
