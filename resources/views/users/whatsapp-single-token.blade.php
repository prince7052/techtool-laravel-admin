@extends('layouts.admin.app')

@section('title', 'Edit User')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Token</h1>
        <a href="{{route('users.whatsapp-token')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Add Whatsapp Token</h6>
        </div>
        <form method="POST" action="{{route('users.update-token')}}">
            @csrf
           
 
         
           
            <div class="card-body">
            <h4>{{$user->first_name}}&nbsp;{{$user->last_name}}</h4>
                <div class="form-group row">
                  <input type="hidden" name ="id" value ="{{ $user->id}}">
                  
                    {{-- Instance ID --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;"></span> Instance ID</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="Instance ID" 
                            name="InstanceID" 
                            value="{{ $user->InstanceID}}">

                      
                    </div>

                    {{--Access Token --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;"></span>Access Token</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="Access Token" 
                            name="AccessToken" 
                            value="{{ $user->AccessToken}}">

                        
                    </div>

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Update</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.index') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection