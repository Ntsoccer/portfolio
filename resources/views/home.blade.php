@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

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
                          <tr>
                            <th scope="row"><a href="{{ route('users.index') }}">ユーザ名</a></th>
                            <td>体重</td>
                            <td>重量</td>
                            <td>Todo</td>
                          </tr>
                          <tr>
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
