<?php

namespace App\Http\Controllers;

use App\Models\Post;

use App\Models\PostUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $professores = User::where('level', 'professor')->get();
        return view('post.add_new_post',compact('professores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function save_post(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'title' => 'required',
            'abstract' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'project_url' => 'nullable',
            'call_number' => 'nullable',
            'research_group' => 'nullable',
            'image' => 'required',
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
        $professoresIds = $request->input('professores_ids', []);
    
      
       
       if (isset($request->participa) && !empty($request->participa)) {

            PostUser::create([
                'user_id' => $id_usuario,
                'post_id' => $idPost,
            ]);

            foreach ($professoresIds as $id_usuarios) {
            PostUser::create([
                'user_id' => $id_usuarios,
                'post_id' => $idPost,
            ]);
            }
         } else {
         foreach ($professoresIds as $id_usuarios) {
                        echo "Sem  usuario logado";

                        
                    PostUser::create([
                        'user_id' => $id_usuarios,
                        'post_id' => $idPost,
                    ]);
                    
    }

            
         }

    /*
        $postUser = PostUser::create([
            'user_id' => $id_usuario,
            'post_id' => $idPost,
        ]);
  
        // Verificando se o relacionamento foi salvo
        if (!$postUser) {
        //    return redirect()->route('view.post')->with('sucess','erro ao salvar, tente novamente');
        }

    */
    
        return redirect()->route('view.post')->with('success', 'Postagem publicada com sucesso');
    
        // Ou se quiser usar redirect:
        // return redirect()->back()->with('success', 'Projeto cadastrado com sucesso!');
    }

    public function my_projects()  {

        $user = Auth::user(); 
            //erro do compilador , FUNCIONA PERFEITAMENTE 
        $projetos =  $user->posts;
    
        return view('post.myprojects', compact('projetos'));
        
        
    }

    public function edit_project($id){
        $projeto = Post::findOrFail($id);

        return view('post.view_edit_project', compact('projeto'));
    }


    public function update_project(Request $request, $id)
    {
        $projeto = Post::findOrFail($id);
    
        // Validação (ajuste conforme necessário)
    
        // Atualiza campos simples
        $projeto->title = $request->title;
        $projeto->abstract = $request->abstract;
        $projeto->status = $request->status;
        $projeto->start_date = $request->start_date;
        $projeto->end_date = $request->end_date;
        $projeto->project_url = $request->project_url;
        $projeto->call_number = $request->call_number;
        $projeto->research_group = $request->research_group;
    
        // Tratamento de nova imagem (se houver)
        if ($request->hasFile('image')) {
            // Remove imagem antiga se existir
            if ($projeto->image && Storage::disk('public')->exists($projeto->image)) {
                Storage::disk('public')->delete($projeto->image);
            }
    
            // Salva a nova imagem
            $path = $request->file('image')->store('projetos', 'public');
            $projeto->image = $path;
        }
    
        $projeto->save();

        return redirect()->route('edit.project', $projeto->id)->with('success', 'Informações do projeto atualizada com sucesso!');
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
    public function all_projects()
    {
          $projetos= Post::orderBy('created_at', 'desc')->get();
          return view('post.all_projects',compact('projetos'));
          
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

    public function unique_project($id){

          $project=Post::find($id);

        return view('post.uniqueproject', compact('project'))->with('success', 'Encontrado com sucesso');

    }

    
   public function finish_project($id) {
    $project = Post::find($id);

    if ($project) {
        if ($project->status == "Finalizado") {
            $project->status = "Em andamento";
        } else {
            $project->status = "Finalizado";
        }
        $project->save();

        return redirect()->back()->with('success', 'Status do projeto atualizado com sucesso!');
    }

    return redirect()->back()->with('error', 'Projeto não encontrado.');
    }

    public function delete_project(Request $request) {
     $id = $request->id;
    $project = Post::find($id);
      $projecttitle= $project->title;
    if ($project) {
        $project->delete();
        return redirect()->back()->with('success', 'Projeto: ' . $projecttitle . ' deletado com sucesso');
    }
    }


}
