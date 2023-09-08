@extends('layouts.admin.app')

@section('title', 'Users List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
            <div class="row">
                <div class="col-md-6">
                    <a href="{{ route('users.create') }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-plus"></i> Add New
                    </a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('users.export') }}" class="btn btn-sm btn-success">
                        <i class="fas fa-check"></i> Export To Excel
                    </a>
                </div>
                
            </div>

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
                                <th width="15%">Dest</th>
                                <th width="10%">SN</th>
                                <th width="15%">KIOSK NAME</th>
                                <th width="15%">OWNER NAME</th>
                                <th width="25%">KIOSK_ADDRESS</th>
                                <th width="15%">MOBILE NO</th>
                                <th width="25%">EMAIL ID</th> 
                                <!--<th width="10%">Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            @if($users)
                           
                            @foreach ($users as $user)
                            
                                <tr>
                                    <td>{{ $user->Dest }}</td>
                                    <td>{{ $user->SN }}</td>
                                    <td>{{ $user->KIOSK_NAME }}</td>
                                    <td>{{ $user->OWNER_NAME }}</td>
                                    <td>{{ $user->KIOSK_ADDRESS }}</td>
                                    <td>{{ $user->MOBILE_NO }}</td>
                                    <td>{{ $user->EMAIL_ID }}</td>
                                   <!-- <td>{{ $user->roles ? $user->roles->pluck('name')->first() : 'N/A' }}</td>-->
                                    
                                   <!-- <td style="display: flex">
                                        @if ($user->status == 0)
                                            <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 1]) }}"
                                                class="btn btn-success m-2">
                                                <i class="fa fa-check"></i>
                                            </a>
                                        @elseif ($user->status == 1)
                                            <a href="{{ route('users.status', ['user_id' => $user->id, 'status' => 0]) }}"
                                                class="btn btn-danger m-2">
                                                <i class="fa fa-ban"></i>
                                            </a>
                                        @endif
                                        <a href="{{ route('users.edit', ['user' => $user->id]) }}"
                                            class="btn btn-primary m-2">
                                            <i class="fa fa-pen"></i>
                                        </a>
                                        <a class="btn btn-danger m-2" href="#" data-toggle="modal" data-target="#deleteModal">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>-->
                                </tr>
                            @endforeach
                            @else
                             <tr>
                             <td colspan="7" style="text-align: center;" ><h4>No Record Found</h4></td>

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
