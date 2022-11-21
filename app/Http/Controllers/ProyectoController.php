<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


use App\Models\Comentario;

use App\Models\Proyecto;
use Illuminate\Http\Request;


use Illuminate\Support\Collection;

class ProyectoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function __construct(){
        $this->middleware('auth')->except(['all','show','home']);
        $this->middleware('verified')->except(['all','show','home']);
    }

    public function home()
    {
        
        $proyectos= Proyecto::with('user')->get();
        $proyectos= $proyectos->whereNotIn('user_id', [Auth::id()]);
        $randoms = $proyectos->random(0);
        $fechados = $proyectos->sortBy([['fecha','desc']]);
        $userLog = Auth::id();
        //return  compact('proyectos');
        return view('index', compact('proyectos', 'randoms', 'fechados','userLog'));
        //return view('/index', compact('proyectos', 'randoms', 'fechados','userLog'));
        //$libros = Libro::all();
        //return view('/libros.listaLibros', compact('libros', 'userLog'));
    }

    public function index()
    {
        $proyectos = Auth::user()->proyectos;
        return view('proyectos.indexProyectos', compact('proyectos'));
        //return view('/index', compact('proyectos', 'userLog'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('proyectos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

     
    public function all()
    {
        $proyectos= Proyecto::with('user')->get();
        $randoms = $proyectos->random(0);
        $fechados = $proyectos->sortBy([['fecha','desc']]);
        $userLog = Auth::id();
        //dd($fechados);
        return  compact('proyectos');
        //return view('/index', compact('proyectos', 'randoms', 'fechados','userLog'));
        //return view('/index', compact('proyectos', 'randoms', 'fechados','userLog'));
        //$libros = Libro::all();
        //return view('/libros.listaLibros', compact('libros', 'userLog'));
    }

    public function store(Request $request)
    {
        //dd($request);
        $request->merge(['user_id'=> Auth::id()]);
        Proyecto::create($request->all());
        return redirect('/proyecto')->with('crear','ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function show(Proyecto $proyecto)
    {
        //dd($proyecto->id);
        $comentarios= Comentario::all();
        $comentarios= $comentarios->where('proyecto_id', $proyecto->id);
        return view('/proyectos.showProyecto', compact('proyecto', 'comentarios'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function edit(Proyecto $proyecto)
    {
        return view('/proyectos.formEdit', compact('proyecto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Proyecto $proyecto)
    {
        Proyecto::where('id', $proyecto->id)->update($request->except(['_token', '_method']));
        return redirect('/proyecto')->with('editar','ok');
        //->with('editar','ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proyecto  $proyecto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Proyecto $proyecto)
    {
        $proyecto->delete();
        return redirect('/proyecto')->with('eliminar','ok');
    }
}
