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
            <div class="mr-5">
                <a class="btn btn-sm btn-success" onclick="uploadData('')">
                    UPLOAD DATA
                </a>
            </div>

        </div>

    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- Content Row -->
 

    @include('common.admin.comman-header')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Agent</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">Name</th>
                            <th width="15%">Email</th>
                            <th width="15%">Passcode</th>
                            <th width="15%">Mobile</th>
                            <th width="15%">Total leads</th>
                            <th width="15%">Remaining</th>
                            <th width="15%">Call</th>
                            <th width="15%">Follow up </th>

                            <th width="15%">Status</th>
                            <th width="15%">Details</th>
                            <th width="15%">Upload</th>
                            <th width="15%">Download</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>


                        <?php $total = count($id);


                        ?>


                        @for ($i = 0; $i < $total; $i++) @if($role_id[$i] !=1) <tr>
                            <td>{{ $first_name[$i] }} {{ $last_name[$i] }}</td>
                            <td>{{ $email[$i] }}</td>
                            <td>{{ $passcode[$i] }}</td>
                            <td>{{ $mobile_number[$i] }}</td>
                            <td>
                                @if($count[$i])
                                {{ $count[$i] }}
                                @else
                                {{ 0 }}
                                @endif

                            </td>
                            <td>{{ $remaining[$i] }}</td>
                            <td>{{ $calling[$i] }}</td>
                            <td>{{ $follow_up[$i] }}</td>

                            <td>
                                @if ($status[$i] == 0)
                                <span class="badge badge-danger">Inactive</span>
                                @elseif ($status[$i] == 1)
                                <span class="badge badge-success">Active</span>
                                @endif
                            </td>

                            <td><a class="btn btn-warning" href="{{Route('users.agent-details',['id'=>$id[$i]]) }}" >Details</a></td>
                            @if($status[$i] == 1)
                            <td> <a class="btn btn-primary " onclick="uploadData('{{$id[$i] }}')">Upload</a></td>

                            @else
                            <td> <a class="btn btn-primary " onclick="return confirm('This Agent status is Inactive , Firstally make Active status if wnat to upload file')">Upload</a></td>
                            @endif

                            <td> <a href="{{ route('users.download-data',['id'=>$id[$i]])}}" class="btn btn-success">Download</a></td>
                            <td style="display: flex">
                                @if ($status[$i] == 0)
                                <a href="{{ route('users.status', ['user_id' => $id[$i], 'status' => 1]) }}" class="btn btn-success m-2">
                                    <i class="fa fa-check"></i>
                                </a>
                                @elseif ($status[$i] == 1)
                                <a href="{{ route('users.status', ['user_id' => $id[$i], 'status' => 0]) }}" class="btn btn-danger m-2">
                                    <i class="fa fa-ban"></i>
                                </a>
                                @endif
                                <a href="{{ route('users.edit', ['user' => $id[$i]]) }}" class="btn btn-primary m-2">
                                    <i class="fa fa-pen"></i>
                                </a>
                                <a class="btn btn-danger m-2" href="{{ route('users.destroy', ['user' => $id[$i]]) }}" >
                                    <i class="fas fa-trash"></i>
                                </a>
                            </td>
                            </tr>
                            @endif
                            @endfor
                    </tbody>
                </table>


            </div>
        </div>
    </div>

</div>



@endsection

@section('scripts')

@endsection