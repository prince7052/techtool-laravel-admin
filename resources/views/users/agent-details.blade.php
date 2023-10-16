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
            <h6 class="m-0 font-weight-bold text-primary">All Records</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">Name</th>
                            <th width="10%">Phone</th>
                            <th width="15%">Remark</th>
                            <th width="15%">Call Record</th>
                            <th width="25%">Follow UP</th>
                            <!--<th width="10%">Action</th>-->
                        </tr>
                    </thead>
                    <tbody>

                        @if($data)

                        @foreach ($users as $user)

                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->remark_option }}</td>
                            <td>

                                @if($user->recorded_call)

                                <audio controls>
                                    <source src="{{url('uploads')}}/{{$user->recorded_call}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>

                                @else
                                Not Recording
                                @endif

                            </td>
                            <td>{{ $user->follow_up_date }}</td>

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
                {{ $users->links() }}

            </div>
        </div>
    </div>

</div>



@endsection

@section('scripts')

@endsection