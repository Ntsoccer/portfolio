@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザ一覧</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">ユーザ名</th>
                          <th scope="col">体重</th>
                          <th scope="col">重量</th>
                          <th scope="col">Todo</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($users as $user)
                          <tr>
                            <th scope="row">{{$user->name}}</th>
                            <td><a href="{{route('data.physical.index',['user_id' => $user->id])}}">体重</a></td>
                            <td><a href="{{route('data.weights.index', ['user_id' => $user->id])}}">重量</a></td>
                            <td><a href="{{route('data.todos.index', ['user_id' => $user->id])}}">Todo</a></td>
                          </tr>
                          <tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection