@extends('layouts.admin.app')

@section('title', 'Import Users')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dropdown</h1>
        <a href="{{route('home')}}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                class="fas fa-arrow-left fa-sm text-white-50"></i> Back</a>
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Dropdown</h6>
        </div>
        <form method="POST" action="{{route('users.option-store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <!--<div class="form-group row">
                    
                    <div class="col-md-12 mb-3 mt-3">
                        <p>Please Upload CSV in Given Format <a href="{{ asset('files/sample-data-sheet.csv') }}" target="_blank">Sample CSV Format</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input 
                            type="file" 
                            class="form-control form-control-user @error('file') is-invalid @enderror" 
                            id="exampleFile"
                            name="file" 
                            value="{{ old('file') }}">

                        @error('file')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>-->

 
                <div class="container">
  <div class="row">
    <div class="col-md-1"></div>
      <div class="col-md-10">
        <div class="form-group">
         @if( $data == " ")
            <table class="table table-bordered table-hover" id="dynamic_field">
              <tr>
                <td><input type="text" name="name[]" placeholder="Enter option" class="form-control name_list" /></td>
                <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>  
              </tr>
            </table>

            @else
            <table class="table table-bordered table-hover" id="dynamic_field">
              
                @foreach( $data as $data )
                <tr>
                <td><input type="text" name="name[]" placeholder="Enter option" value="{{ $data->option }}" class="form-control name_list" /></td>
                <td><a  href="{{ url('users/delete-option',[$data->id]) }}"  class="btn btn-danger btn_remove">X</a></td>
                </tr>

                @endforeach
                <tr>
                <td></td>
                <td><button type="button" name="add" id="add" class="btn btn-primary">Add More</button></td>  
              </tr>
            </table>
            @endif
           
          
        </div>
      </div>
    <div class="col-md-1"></div>
  </div>
</div>
            </div>

            <div class="card-footer">
                @if( $data == " ")
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Save</button>
                @else
                <button type="submit" class="btn btn-success btn-user float-right mb-3">Update</button>
                @endif
                <a class="btn btn-warning float-right mr-3 mb-3" href="{{ route('users.dropdown-manage') }}">Cancel</a>
            </div>
        </form>
    </div>

</div>


@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){
   
   var i = 1;
     var length;
     //var addamount = 0;
    var addamount = 700;
 
   $("#add").click(function(){
     
     
      addamount += 700;
      console.log('amount: ' + addamount);
    i++;
       $('#dynamic_field').append('<tr id="row'+i+'"><td><input type="text" name="name[]" placeholder="Enter option" class="form-control name_list"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
     });
 
   $(document).on('click', '.btn_remove', function(){  
     addamount -= 700;
     console.log('amount: ' + addamount);
     
     
      
       var button_id = $(this).attr("id");     
       $('#row'+button_id+'').remove();  
     });
     
 
 
     $("#submit").on('click',function(event){
     var formdata = $("#add_name").serialize();
       console.log(formdata);
       
       event.preventDefault()
       
      /* $.ajax({
         url   :"action.php",
         type  :"POST",
         data  :formdata,
         cache :false,
         success:function(result){
           alert(result);
           $("#add_name")[0].reset();
         }
       });*/
       
     });
   });


</script>