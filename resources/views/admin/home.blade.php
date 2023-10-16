@extends('layouts.admin.app')

@section('title', 'Dashboard')

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



    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Leads</div>


                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$count1 }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300 "></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Today Call</div>


                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$count2 }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tomarrow Call
                            </div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">0</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Follow up</div>


                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$count4 }}</div>
                                </div>
                                <div class="col">
                                    <div class="progress progress-sm mr-2">
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">AGENTS MONTHALY PERFORMANCE</h6>

        </div>
        <div class="card-body">


            <form action="{{Route('users.show-record')}}" method="post">
                @csrf
                <div class="row mb-5">

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;"></span>Agent</label>
                        <select class="form-control " name="agent" required>
                            <option <?php echo ($agent == 'all' ) ?'selected':'' ?> value="all">All Agents</option>
                            @foreach($data1 as $data1)
                            @if($data1->role_id != 1)
                            <option <?php echo ($agent == $data1->id ) ?'selected':'' ?> value="{{$data1->id}}">{{$data1->name}}</option>
                            @endif
                            @endforeach

                        </select>

                    </div>

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0 ms-5" style="margin-left: 10px;">
                        <span style="color:red;"></span>From Date</label>
                        <input type="date" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="exampleLastName" placeholder="Enter From Date " name="from_date" value="{{$startDate}}" required>


                    </div>

                    <div class="col-sm-3 mb-3 mt-3 mb-sm-0 ms-5" style="margin-left: 10px;margin-right:10px">
                        <span style="color:red;"></span>To Date</label>
                        <input type="date" class="form-control form-control-user @error('last_name') is-invalid @enderror" id="exampleLastName" placeholder="Enter To Date " name="to_date" value="{{$endDate}}" required>


                    </div>
                    <div class="col-sm- mb-1 mt-5 mb-sm-0 me-10 ">
                        <button type="submit" class="btn btn-success btn-user" style="margin-top: -8px; margin-right: 15px;">Search</button>
                        @if($data)
                        
                        <a href="{{Route('users.record-export',['id'=>$agent,'sdt'=>$startDate,'edt'=>$endDate])}}" class="btn btn-primary btn-user pull-right" style="margin-top: -8px;">Download</a>
                        @else
                        <button type="button" class="btn btn-primary btn-user pull-right" style="margin-top: -8px;">Download</button>
                        @endif
                    </div>

                </div>
            </form>


            @if($data)
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="15%">Date</th>
                            <th width="15%">Name</th>
                            <th width="10%">Phone</th>
                            <th width="15%">Remark</th>
                            <th width="15%">Call Record</th>
                            <th width="25%">Follow UP</th>

                        </tr>
                    </thead>
                    <tbody>



                        @foreach ($users as $user)

                        <tr>
                            <td>{{ $user->update_date }}</td>
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


                    </tbody>
                </table>

               


            </div>
            @endif
        </div>
    </div>




</div>
@endsection