@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row d-flex">
            <div class="col-md-8 justify-content-center">
                <div class="card">
                    <div class="card-header">本会員登録</div>

                    @isset($message)
                        <div class="card-body">
                            {{$message}}
                        </div>
                    @endisset

                    @empty($message)
                        <div class="card-body">
                            <form action="{{ route('register.main_pre_check', ['token' => $email_token]) }}">
                                @csrf


                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>{!! form_label($form->name) !!}</label>
                                            {!! form_widget($form->name) !!}
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        <button type="submit" class="btn btn-primary">
                                            確認画面へ
                                        </button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    @endempty
                </div>
            </div>
        </div>
    </div>
@endsection