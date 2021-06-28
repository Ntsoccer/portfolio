@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    @if ($todo_id > 0 && request('user_id')==Auth::id())
    <div class="col-sm-12">
      <span>ユーザ一覧で</span>
      <div>  
        @if ($display->is_display == 1)  
          <form method="POST" id="is_display" action="{{route('data.todos.displayUpdate', ['user_id'=>request('user_id')])}}">
            @csrf
            @method('PUT')
            <input type="radio" name="switch" id="switch1" value="0" onchange="document.forms.is_display.submit()">
            <label for="switch1">表示</label>    
            <input type="radio" name="switch" value="1" id="switch2" checked>
            <label for="switch2">非表示</label>
          </form>
        @else
          <form method="POST" id="is_display" action="{{route('data.todos.displayUpdate', ['user_id'=>request('user_id')])}}">
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
      <div class="table-type2">
        <div class="thead">
          <div class="tr">
            <div class="th">
              @if (request('user_id') == Auth::user()->id)
                完了
              @endif
            </div>
            <div class="th">すべきこと</div>
            <div class="th"></div>
            <div class="th"></div>
          </div>
        </div>
        <div class="tbody">  
          @foreach($todos_data as $todos)   
            <div class="tr">
              <div class="td" label="ヘッダー1">
                @if (request('user_id') == Auth::user()->id)
                @if ($todos->complete == 1)
                <form method="GET" id="is_checked{{$todos->id}}" action="{{route('data.todos.update', ['id'=>$todos->id,'user_id'=>request('user_id')])}}">
                  @csrf
                  <input id="complete{{$todos->id}}" type="checkbox" name="complete" value="1" checked onchange="document.forms.is_checked{{$todos->id}}.submit()">
                </form>
                @else
                <form method="GET" id="is_checked{{$todos->id}}" action="{{route('data.todos.update', ['id'=>$todos->id,'user_id'=>request('user_id')])}}">
                  @csrf
                  <input id="complete{{$todos->id}}" type="checkbox" name="complete" value="0" onchange="document.forms.is_checked{{$todos->id}}.submit()">
                </form>
                @endif
                @endif
              </div>
              @if ($todos->complete == 1)
              <div class="td" label="ヘッダー2" id="todo{{$todos->id}}" style="text-decoration: line-through">{{$todos->todo}}</div>           
              @else
              <div class="td" label="ヘッダー2" id="todo{{$todos->id}}">{{$todos->todo}}</div>
              @endif
              <div class="td" label="ヘッダー3">
                @if (request('user_id') == Auth::user()->id)
                <form class="delete" method="POST" action="{{route('data.todos.destroy', ['id'=>$todos->id, 'user_id'=>request('user_id')])}}">
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
      <form method="POST" action="{{route('data.todos.store', $user_id)}}">
        @csrf
        <input type="hidden" name="complete" value="0">
        Todo
        <br>
        <input type="text" name="todo" placeholder="すべきこと">
        <br>
        <br>
        <input class="btn btn-info" type="submit" value="登録する">
      </form>
    </div>
    @endif
  </div>
</div>      

@endsection