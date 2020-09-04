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
                                        <input type="text" name="deposit" class="form-control" placeholder="Add deposite">
                                    </div>
                                    <input type="submit" class="btn btn-primary" value="Submit">
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="alert alert-danger">
                            You need to register to view this info
                        </div>
                        <a class="w-100 btn btn-primary" href="{{route('login')}}">Login</a>
                        <a class="w-100 btn btn-primary mt-2" href="{{route('register')}}">Register</a>
                    @endif
                </div>
            </div>
        </div>
        @if(Auth::check())  
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Deposits</div>

                <div class="card-body">        
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invested</th>
                                        <th>Percent</th>
                                        <th>Accrue</th>
                                        <th>Summ</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($deposits))
                                        @foreach($deposits as $deposit)
                                            <tr>
                                                <th scope="row">{{$deposit->id}}</th>
                                                <td>{{$deposit->invested}}</td>
                                                <td>{{$deposit->percent}}</td>
                                                <td>{{$deposit->duration}}</td>
                                                <td>{{$deposit->sum()}}</td>
                                                <td>{{$deposit->active == 1 ? 'Opened' : 'Closed'}}</td>
                                                <td>{{$deposit->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(Auth::check()) 
        <div class="col-md-8 mt-5">
            <div class="card">
                <div class="card-header">Transactions</div>

                <div class="card-body">    
                        <div class="col-md-12">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Type</th>
                                        <th>Summ</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($transactions))
                                        @foreach($transactions as $transaction)
                                            <tr>
                                                <th scope="row">{{$transaction->id}}</th>
                                                <td>{{$transaction->type}}</td>
                                                <td>{{$transaction->amount}}</td>
                                                <td>{{$transaction->created_at}}</td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
