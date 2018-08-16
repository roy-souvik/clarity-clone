@extends('layouts.inner')

@section('content')
    <div class="container">

        <div class="innercatagory">
    
             <div class="row profile">

                 <div class="col-sm-8 information">

                    <h3>Forgot Your Password?</h3>
                
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if ($errors->has('email'))
                        <span class="help-block alert alert-danger">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                        {{ csrf_field() }}

                        <div class="p_bot30 form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email">Enter your email address below and we'll send you reset instructions.</label> <br>  

                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">                       
                         
                         </div>                           
                                              
                            <button class="btn btn-primary btn-lg">Submit</button>                          
                    </form>
                </div>
                    <div class="col-sm-4 rightpicpart">
                    &nbsp;
                    </div>
            </div>
        </div>
    </div>
@endsection
