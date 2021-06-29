<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Physical;
use Auth;
use App\User;

class PhysicalController extends Controller
{   
    public $sorting;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
        //
        $date=$request->input('date');
        $user_id=request('user_id');
        $physical_id=optional(Physical::where('user_id',$user_id)->select('id')->first())->id;

        if($date == 'new'){
          $physical_data= Physical::where('user_id',$user_id)->orderBy('updated_at', 'desc')->get();    
        }
        elseif($date == 'old'){
          $physical_data=Physical::where('user_id',$user_id)->orderBy('updated_at', 'asc')->get();
        }
        else{
          $physical_data = Physical::where('user_id',$user_id)->orderBy('created_at', 'desc')->get();
        }

        $users = User::All();
        $display=optional(Physical::where('user_id', $user_id)->where('id', $physical_id)->select('is_display')->first());

        return view('data.physical.index', compact('physical_data', 'user_id', 'users', 'physical_id', 'display'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('data.physical.create');
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
        $physical=new Physical;
        $physical->height=$request->input('height');
        $physical->weight=$request->input('weight');
        $physical->bmi=$physical->weight/($physical->height/100)/($physical->height/100);
        $physical->user_id=request('user_id');
        $physical->save();

        return redirect()->route('data.physical.index', ['user_id' => request('user_id')]);
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
        $physical=Physical::find($id);
        return view('data.physical.edit', compact('physical'));
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
        $physical=Physical::find($request->id);
        $physical->user_id=request('user_id');
        $physical->height=$request->input('height');
        $physical->weight=$request->input('weight');
        $physical->bmi=$physical->weight/($physical->height/100)/($physical->height/100);
        $physical->save();

        return redirect()->route('data.physical.index', ['user_id' => request('user_id')]);
    }

    public function displayUpdate(Request $request, $user_id)
    {
        //
        $id=Physical::where('user_id', $user_id)->select('id')->first()->id;
        $physical=Physical::where('user_id', $user_id)->where('id', $id)->first();
        $user_id=request('user_id');
        $display=Physical::where('user_id', $user_id)->where('id', $id)->select('is_display')->first();
        if($display->is_display == 0){
          $physical->is_display=1;
          $physical->save();
        }else{
          $physical->is_display=0;
          $physical->save();
        };
        return redirect()->route('data.physical.index', ['user_id' => request('user_id')]);
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
        $physical=Physical::find($request->id);
        $physical->delete();
        
        return redirect()->route('data.physical.index', ['user_id' => request('user_id')]);
    }
}