<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weights;
use Auth;
use Illuminate\Support\Facades\DB;

class WeightsController extends Controller
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

        $date=$request->input('date');

        $weight_id=optional(Weights::where('user_id',$user_id)->select('id')->first())->id;

        if($date == 'new'){
          $weights_data= Weights::where('user_id',$user_id)->orderBy('updated_at', 'desc')->get();    
        }
        elseif($date == 'old'){
          $weights_data=Weights::where('user_id',$user_id)->orderBy('updated_at', 'asc')->get();
        }
        else{
          $weights_data = Weights::where('user_id',$user_id)->orderBy('created_at', 'desc')->get();
        }

        $display=optional(Weights::where('user_id', $user_id)->where('id', $weight_id)->select('is_display')->first());

        return view('data.weights.index', compact('weights_data', 'weight_id', 'user_id', 'display'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $weight=new Weights;
        $weight->parts=$request->input('parts');
        $weight->event=$request->input('event');
        $weight->weight=$request->input('weight');
        $weight->user_id=request('user_id');
        $weight->save();

        return redirect()->route('data.weights.index', ['user_id' => request('user_id')]);
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
        $weight=Weights::find($request->id);
        $weight->user_id=request('user_id');
        $weight->parts=$request->input('parts');
        $weight->event=$request->input('event');
        $weight->weight=$request->input('weight');
        $weight->save();

        return redirect()->route('data.weights.index', ['user_id' => request('user_id')]);
    }

    public function displayUpdate(Request $request, $user_id)
    {
        //
        $id=Weights::where('user_id', $user_id)->select('id')->first()->id;
        $weight=Weights::where('user_id', $user_id)->where('id', $id)->first();
        $user_id=request('user_id');
        $display=Weights::where('user_id', $user_id)->where('id', $id)->select('is_display')->first();
        if($display->is_display == 0){
          $weight->is_display=1;
          $weight->save();
        }else{
          $weight->is_display=0;
          $weight->save();
        };
        return redirect()->route('data.weights.index', ['user_id' => request('user_id')]);
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
        $weight=Weights::find($request->id);
        $weight->delete();
        
        return redirect()->route('data.weights.index', ['user_id' => request('user_id')]);
    }
}