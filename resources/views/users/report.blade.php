@extends('layouts.admin.app')

@section('title', 'Users List')

@section('content')
<div class="container-fluid">



    <!-- Page Heading -->
    <div class="d-sm-flex  mb-4">
        <div class="col-md-8"></div>
        <div class="row ml-20 " style="margin-left:auto">
            <div class="mx-2">
                <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                    <i class="fas fa-plus"></i> Add Agent
                </a>
            </div>
            <div class="mr-2">
                <a class="btn btn-sm btn-success" onclick="uploadData('')">
                    UPLOAD DATA
                </a>
            </div>

            <div class="mr-5">
                <a href="{{route('users.index')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
            </div>

        </div>

    </div>

    {{-- Alert Messages --}}
    @include('common.alert')






    @include('common.admin.comman-header')


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Left Records</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if($data)
                <form action="{{Route('users.add-record')}}" method="post">
                    @csrf
                <div class="row mb-5">
                  
                        <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                            <span style="color:red;"></span>Agent</label>
                            <select class="form-control form-control-user @error('status') is-invalid @enderror" name="agent" required>
                                <option selected disabled>Select Agent</option>
                                @foreach($data1 as $data1)
                                @if($data1->role_id != 1)
                                <option value="{{$data1->id}}"selected >{{$data1->name}}</option>
                                @endif
                                @endforeach
                               
                            </select>

                        </div>

                        <div class="col-sm-3 mb-3 mt-3 mb-sm-0 ms-5" style="margin-left: 61px;">
                        <span style="color:red;"></span>No Of Record</label>
                        <input 
                            type="number" 
                            class="form-control form-control-user @error('last_name') is-invalid @enderror" 
                            id="exampleLastName"
                            placeholder="Enter the number " 
                            name="limits" 
                            value="" required>

                      
                    </div>
                        <div class="col-sm-2 mb-1 mt-5 mb-sm-0 me-10 text-center">
                            <button type="submit" class="btn btn-success btn-user" style="margin-top: -8px;">Save</button>
                        </div>
                   
                </div>
                </form>



                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">Name</th>
                            <th width="10%">Phone</th>

                        </tr>
                    </thead>
                    <tbody>

                        @if($data)

                        @foreach ($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>

                        </tr>
                        @endforeach
                        @else

                        <tr>
                            <td colspan="9" style="text-align: center;">
                                <h4>No Record Found</h4>
                            </td>

                        </tr>
                        @endif
                    </tbody>
                </table>
                @else
                <span style="text-align: center;">
                    <h4>No Record Found</h4>
                </span>
                @endif
                {{ $users->links() }}

            </div>
        </div>
    </div>

</div>



@endsection

@section('scripts')

@endsection