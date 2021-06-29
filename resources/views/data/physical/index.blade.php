@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @if ($physical_id > 0 && request('user_id')==Auth::id())
    <div class="col-sm-12">
      <span>ユーザ一覧で</span>
      <div>  
        @if ($display->is_display == 1)  
          <form method="POST" id="is_display" action="{{route('data.physical.displayUpdate', ['user_id'=>request('user_id')])}}">
            @csrf
            @method('PUT')
            <input type="radio" name="switch" id="switch1" value="0" onchange="document.forms.is_display.submit()">
            <label for="switch1">表示</label>    
            <input type="radio" name="switch" value="1" id="switch2" checked>
            <label for="switch2">非表示</label>
          </form>
        @else
          <form method="POST" id="is_display" action="{{route('data.physical.displayUpdate', ['user_id'=>request('user_id')])}}">
            @csrf
            @method('PUT')
            <input type="radio" name="switch" id="switch1" value="0" checked>
            <label for="switch1">表示</label>    
            <input type="radio" name="switch" value="1" id="switch2" onchange="document.forms.is_display.submit()">
            <label for="switch2">非表示</label>
          </form>
        @endif
      </div>
    </div>          
    @endif
    <div class="col-md-12 col-sm-12">
      <div class="table-scroll">
      <div class="table-type3">
        <div class="thead">
          <div class="tr">
            <div class="th">身長</div>
            <div class="th">体重</div>
            <div class="th">BMI</div>
            <div class="th">
              <form method="GET" id="is_selected" action="{{route('data.physical.index', ['user_id' => request('user_id')])}}">
              <select name="date" onchange="document.forms.is_selected.submit()">
                <option value="day" disabled selected>日付</option>
                <option value="new"
                @if (Request::get('date') == 'new')
                    selected
                @endif>新しい順</option>
                <option value="old"
                @if (Request::get('date') == 'old')
                  selected
                @endif>古い順</option>
              </select>
            </form>
            </div>
            <div class="th"></div>
            <div class="th"></div>
            <div class="th"></div>
          </div>
        </div>
        <div class="tbody">  
          @foreach($physical_data as $physical)   
            <div class="tr">
              <form class="update" method="POST" action="{{route('data.physical.update', ['id'=>$physical->id,'user_id'=>request('user_id')])}}">
                @csrf
                @method('PUT')
              <div class="td" label="ヘッダー1"><input type="number" class="input-sm" name="height" value="{{$physical->height}}" style="width: 50px"></div>
              <div class="td" label="ヘッダー2"><input type="number" class="input-sm" name="weight" value="{{$physical->weight}}" style="width: 40px"></div>
              <div class="td" label="ヘッダー3">{{$physical->bmi}}</div>
              <div class="td" label="ヘッダー4">
                @if ($physical->updated_at)
                {{$physical->updated_at->format('Y年m月d日')}}              
                @else
                {{$physical->created_at->format('Y年m月d日')}}
                @endif
              </div>
              <div class="td" label="ヘッダー5">
                @if (request('user_id') == Auth::user()->id)
                <input class="btn btn-info" type="submit" value="更新">   
                @endif
              </div> 
              </form>                 
              <div class="td" label="ヘッダー6">
                @if (request('user_id') == Auth::user()->id)
                <form class="delete" method="POST" action="{{route('data.physical.destroy', ['id'=>$physical->id, 'user_id'=>request('user_id')])}}">
                  @method('DELETE')
                  @csrf
                  <input class="btn btn-danger" type="submit" value="削除">
                </form>
                @endif
              </div>
              <div class="td"></div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
    </div>
    @if (request('user_id') == Auth::user()->id)
    <div class="col-md-12 col-sm-12">
      <form method="POST" action="{{route('data.physical.store', $user_id)}}">
        @csrf
        身長
        <br>
        <input type="number" name="height">&nbsp;cm
        <br>
        体重
        <br>
        <input type="number" name="weight">&nbsp;kg
        <br>
        <br>
        <input class="btn btn-info" type="submit" value="登録する">
      </form>
    </div>
    @endif
  </div>
</div>      

@endsection