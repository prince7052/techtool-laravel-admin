@extends('layouts.user.app')

@section('title', 'Users List')

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Users</h1>
         

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
                                <th width="10%">EMAIL ID</th> 
                                <th width="15%">Remark</th> 
                                <th width="15%">Date & Time</th> 
                                <!--<th width="10%">Action</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            
                            @if($data)
                           
                            @foreach ($users as $user)
                            
                                <tr>
                                    <td>{{ $user->Dest }}</td>
                                    <td>{{ $user->SN }}</td>
                                    <td>{{ $user->KIOSK_NAME }}</td>
                                    <td>{{ $user->OWNER_NAME }}</td>
                                    <td>{{ $user->KIOSK_ADDRESS }}</td>
                                    <td>{{ $user->MOBILE_NO }}</td>
                                    <td>{{ $user->EMAIL_ID }}</td>
                                    <td>
                                        @if($user->list_option)
                                        
                                    {{ $user->list_option }}

                                    @else
                                      {{"N/A"}}
                                    @endif

                                    </td>
                                    <td>{{ $user->updated_at}}</td>
                              
                                </tr>
                            @endforeach
                            @else
                           
                             <tr>
                            <td colspan="9" style="text-align: center;" ><h4>No Record Found</h4></td>

                             </tr>
                            @endif
                        </tbody>
                    </table>

                  
                </div>
            </div>
        </div>

    </div>

  

@endsection

@section('scripts')
    
@endsection
