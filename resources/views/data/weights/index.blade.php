@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-sm-12">
      <div class="sample1Area" id="makeImg">
        ユーザ一覧で
        <input type="radio" name="sample1radio" id="sample1on" checked="">
          <label for="sample1on">表示</label>
        <input type="radio" name="sample1radio" id="sample1off">
          <label for="sample1off">非表示</label>
      </div>
    </div>
    <div class="form-check form-check-inline">
      <input id="radio0" type="radio" class="form-check-input" name="search" value="0" checked>すべて
      <input id="radio1" type="radio" class="form-check-input" name="search" value="1">腕
      <input id="radio2" type="radio" class="form-check-input" name="search" value="2">胸
      <input id="radio3" type="radio" class="form-check-input" name="search" value="3">背中
      <input id="radio4" type="radio" class="form-check-input" name="search" value="4">腹筋
      <input id="radio5" type="radio" class="form-check-input" name="search" value="5">足
    </div>
    <div class="col-md-12 col-sm-12">
      <div class="table-scroll">
      <div class="table-type1">
        <div class="thead">
          <div class="tr">
            <div class="th">部位</div>
            <div class="th">種目</div>
            <div class="th">重量</div>
            <div class="th">
            <form method="GET" id="is_selected" action="{{route('data.weights.index', ['user_id' => request('user_id')])}}">
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
          @foreach($weights_data as $weight)   
            <div class="tr">
              <form class="update" method="POST" action="{{route('data.weights.update', ['id'=>$weight->id,'user_id'=>request('user_id')])}}">
                @csrf
                @method('PUT')
              <div class="td" label="ヘッダー1">
                <select name="parts">
                  @if ($weight->parts == 1)
                  <option value="0" class="arm">                    
                    腕              
                  </option>
                  @elseif ($weight->parts == 2)
                  <option value="0" class="chest">
                    胸
                  </option>
                  @elseif ($weight->parts == 3)
                  <option value="0" class="back">
                    背中
                  </option>
                  @elseif ($weight->parts == 4)
                  <option value="0" class="abu">
                    腹筋
                  </option>
                  @else
                  <option value="0" class="legs">
                    足
                  </option>
                  @endif
                  @if ($weight->parts == 1)
                  <option value="1" style="display:none">腕</option>
                  @else
                  <option value="1">腕</option>
                  @endif
                  @if ($weight->parts == 2)
                  <option value="2" style="display:none">胸</option>
                  @else
                  <option value="2">胸</option>
                  @endif
                  @if ($weight->parts == 3)
                  <option value="3" style="display:none">背中</option>
                  @else
                  <option value="3">背中</option>
                  @endif
                  @if ($weight->parts == 4)
                  <option value="4" style="display:none">腹筋</option>
                  @else
                  <option value="4">腹筋</option>
                  @endif
                  @if ($weight->parts == 5)
                  <option value="5" style="display:none">足</option>
                  @else
                  <option value="5">足</option>
                  @endif
                </select>
              </div>
              <div class="td" label="ヘッダー2"><input type="text" class="input-sm" name="event" value="{{$weight->event}}"></div>
              <div class="td" label="ヘッダー3"><input type="number" class="input-sm" name="weight" value="{{$weight->weight}}" style="width: 60px"></div>
              <div class="td" label="ヘッダー4">
                @if ($weight->updated_at)
                {{$weight->updated_at->format('Y年m月d日')}}
                @else
                {{$weight->created_at->format('Y年m月d日')}}
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
                <form class="delete" method="POST" action="{{route('data.weights.destroy', ['id'=>$weight->id, 'user_id'=>request('user_id')])}}">
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
      <form method="POST" action="{{route('data.weights.store', $user_id)}}">
        @csrf
        部位
        <br>
        <select name="parts">
          <option>選択してください</option>
          <option value="1">腕</option>
          <option value="2">胸</option>
          <option value="3">背中</option>
          <option value="4">腹筋</option>
          <option value="5">足</option>
        </select>
        <br>
        種目
        <br>
        <input type="text" name="event">
        <br>
        重量
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