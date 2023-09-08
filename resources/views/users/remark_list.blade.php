@extends('layouts.admin.app')

@section('title', 'Users List')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Users</h1>
        <a href="{{route('home')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>

    </div>
 
    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All Users</h6>

        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="20%">Name</th>
                            <th width="25%">Email</th>
                            <th width="15%">Mobile</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $count = count($data2);


                        ?>



                        @for ($i = 0; $i < $count; $i++) <tr>

                            <td> {{ $data1[$i] }} </td>
                            <td> {{ $data2[$i] }}</td>
                            <td> {{ $data3[$i] }}</td>
                            <td style="display: flex">

                                <a href="{{ url('users/user_remark_list',[$data4[$i]]) }}" class="btn btn-primary m-2" title="COMPLETED">
                                    <i class="fa fa-eye"></i>{{ $data5[$i] }}
                                </a>
                                <a href="{{ url('users/pending_remark_list',[$data4[$i]]) }}" class="btn btn-warning m-2" title="PENDING">
                                    <i class="fa fa-eye"></i>{{ $data6[$i] }}
                                </a>
                            </td>
                            </tr><?php  ?>
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