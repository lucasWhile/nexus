<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $posts= Post::orderBy('created_at', 'desc')->get();
        $postsAle = Post::orderBy('created_at', 'desc')->take(3)->inRandomOrder()->get();

        return view('user.index',compact('posts','postsAle'));
    } 
    public function view_post()
    {
        return view('post.add_new_post');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function save_post(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'title' => 'required|string',
            'abstract' => 'required',
            'status' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'project_url' => 'nullable',
            'call_number' => 'nullable',
            'research_group' => 'nullable',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);
    
        // Upload da imagem usando Storage
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('imagens_projetos', 'public');
        } else {
            return response()->json(['error' => 'Imagem não enviada'], 400);
        }
    
        // Salvando no banco
        $post = Post::create([
            'title' => $validated['title'],
            'abstract' => $validated['abstract'],
            'status' => $validated['status'],
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'],
            'project_url' => $validated['project_url'],
            'call_number' => $validated['call_number'],
            'research_group' => $validated['research_group'],
            'image' => $path ?? null,
        ]);
    
        // Verificando se o Post foi salvo
        if (!$post) {
            return redirect()->route('view.post')->with('sucess','erro ao salvar, tente novamente');
        }
    
        $idPost = $post->id;
        $id_usuario = Auth::user()->id;
    
        $postUser = PostUser::create([
            'user_id' => $id_usuario,
            'post_id' => $idPost,
        ]);
    
        // Verificando se o relacionamento foi salvo
        if (!$postUser) {
            return redirect()->route('view.post')->with('sucess','erro ao salvar, tente novamente');
        }
    
        return redirect()->route('view.post')->with('success', 'Postagem publicada com sucesso');
    
        // Ou se quiser usar redirect:
        // return redirect()->back()->with('success', 'Projeto cadastrado com sucesso!');
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
