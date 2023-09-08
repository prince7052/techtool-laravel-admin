@extends('layouts.user.app')

@section('title', 'Dashboard')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
       <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>-->
    </div>

    <div class="row">
        <div class="col-md-12">
            <h2 class="text-center mb-3">Welcome Dashboard!</h2>
        </div>
    </div>

    <!-- Content Row -->
    <div class="row">
             <!-- User completed remark -->
             <div class="col-xl-3 col-md-6 mb-4">
                <a href="{{url('user/complete-remark-list')}}">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Completed Remarks</div>
                               
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count1 }}</div>
                              
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
                </a>
        </div>

        <!-- Pending Remarks -->
        <div class="col-xl-3 col-md-6 mb-4">
        <a href="{{url('user/pending-remark-list')}}">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Pending Remarks</div>
                               
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $count2 }}</div>
                           
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        </div>
        
      
    </div>

    

</div>
@endsection