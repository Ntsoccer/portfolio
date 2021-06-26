<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todos;
use Auth;

class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        //
        $user_id=request('user_id');
        $todos_data=Todos::where('user_id',$user_id)->get();

        return view('data.todos.index', compact('todos_data', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('data.todos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $todos=new Todos;
        $todos->complete=$request->input('complete');
        $todos->todo=$request->input('todo');
        $todos->user_id=request('user_id');
        $todos->save();

        return redirect()->route('data.todos.index', ['user_id' => request('user_id')]);
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
        $todos=Todos::find($id);
        return view('data.todos.edit', compact('todos'));
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
        $todos=Todos::find($request->id);
        if($todos->complete == 0){
          $todos->update(['complete' => 1]);
        }else{
          $todos->update(['complete' => 0]);
        }

        return redirect()->route('data.todos.index', ['user_id' => request('user_id')]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $todos=Todos::find($request->id);
        $todos->delete();
        
        return redirect()->route('data.todos.index', ['user_id' => request('user_id')]);
    }
}