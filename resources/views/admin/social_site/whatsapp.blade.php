@extends('layouts.admin.app')

@section('title', 'Add Users')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Do Whatsapp</h1>
        <a href="{{route('home')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Whatsapp</h6>
        </div>
        <form method="POST" action="{{url('media/posts')}}"> 
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{-- First Name --}}
                  <!--  <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>First Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('first_name') is-invalid @enderror" 
                            id="exampleFirstName"
                            placeholder="First Name" 
                            name="first_name" 
                            value="{{ old('first_name') }}">

                        @error('first_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>-->

                    {{-- Last Name --}}
                    <!--<div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Last Name</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('last_name') is-invalid @enderror" 
                            id="exampleLastName"
                            placeholder="Last Name" 
                            name="last_name" 
                            value="{{ old('last_name') }}">

                        @error('last_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>-->

                    {{-- Email --}}
                  <!--  <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Email</label>
                        <input 
                            type="email" 
                            class="form-control form-control-user @error('email') is-invalid @enderror" 
                            id="exampleEmail"
                            placeholder="Email" 
                            name="email" 
                            value="{{ old('email') }}">

                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>-->

                    {{-- Mobile Number --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Mobile Number</label>
                        <input 
                            type="text" 
                            class="form-control form-control-user @error('mobile_number') is-invalid @enderror" 
                            id="exampleMobile"
                            placeholder="Mobile Number" 
                            name="mobile_number" 
                            value="{{ old('mobile_number') }}">

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>


                    {{-- Message --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>Message</label>
                        <textarea
                            type="text" 
                            class="form-control form-control-user" 
                            id="message"
                            placeholder="Write the messages....." 
                            name="message" 
                            value=""></textarea>

                        @error('mobile_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                    

                   

                </div>
            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Send</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('media.whatsapp') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection