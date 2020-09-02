@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if(Auth::check())
                        <div class="alert alert-info">Balance : {{$balance}}</div>
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <form method="POST" action="{{route('add_balance')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="balance" class="form-control" placeholder="Add balance">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                <form method="POST" action="{{route('add_deposit')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="deposite" class="form-control" placeholder="Add deposite">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                            </div>
                        </div>
                        @if(isset($error))
                        <div class="alert alert-danger">
                            {{$error}}
                        </div>
                        @endif
                    @else
                        <div class="alert alert-danger">
                            You need to register to view this info
                        </div>
                        <a class="w-100 btn btn-primary" href="{{route('register')}}">Register</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
