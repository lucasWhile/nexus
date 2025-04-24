<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function view_add_user_create(Request $request)
    {
        return view('user.add_new_user');
    }

    public function date_add_new_user(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'level' => 'required',
            'cpf' => 'required',
            'lattes_url' => 'nullable',
        ]);
    
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'level' => $validated['level'],
            'cpf' => $validated['cpf'],
            'status' => true, 
        ]);
    
        // Se for professor, salva perfil com Lattes
        if ($validated['level'] === 'professor') {
            Profile::create([
                'lattes_url' => $validated['lattes_url'],
                'user_id' => $user->id,
            ]);
        }
    
        return redirect()->back()->with('success', 'Usuário cadastrado com sucesso!');
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
    public function edit_user(string $id)
    {
        $user=User::find($id);
        return view('user.edit_user',compact('user'));
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function edit_save(Request $request)
    {
  

        // Atualiza os campos
      
            $user = User::findOrFail($request->id);
           
        
            // Atualiza os campos somente se vierem preenchidos
            if (!empty($request->name)) {
                $user->name = $request->name;
            }
        
            if (!empty($request->email)) {
                $user->email = $request->email;
            }
        
            if (!empty($request->level)) {
                $user->level = $request->level;
            }
        
            if (!empty($request->cpf)) {
                $user->cpf = $request->cpf;
            }
        
            
            if ($request->filled('lattes_url') && $request->level == 'professor') {
                // Atualiza ou cria o profile vinculado a esse usuário
                $user->profile()->updateOrCreate(
                    [], // condição: o relacionamento já define user_id
                    ['lattes_url' => $request->lattes_url]
                );
            }
        
           
            $user->save();
        
      
  
     
    
        // Redireciona com mensagem de sucesso
       return redirect()->route('edit.user',$user->id)->with('success', 'Usuário atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function view_login()
    {
        return view('user.login');
    }


    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Este e-mail não está cadastrado.',
            ])->onlyInput('email');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->withErrors([
                'password' => 'Senha incorreta.',
            ])->onlyInput('email');
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('index'); 
    }

    public function list_users (Request $request){
        $users=User::all();
        return view('user.list_users',compact('users'));
    }

    public function user_disable(Request $request){
        $id_user=$request->id;
        echo $id_user;
        $user = User::find($id_user);

        if( $user->status == false){
            $user->status = true;
            $user->save();
            return back()->with('success', 'Usuário reativado com sucesso!');
        }
        else{
            $user->status = false;
            $user->save();
            return back()->with('success', 'Usuário desativado com sucesso!');
        }
      
    
       
        
    }


}
