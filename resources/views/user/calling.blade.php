@extends('layouts.user.app')

@section('title', 'Add Users')

@section('content')

<div class="container-fluid">

    <!-- Page Heading -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Alert Messages --}}
    @include('common.alert')
   
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail</h6>
        </div>
        @if($users != " ")
        <form method="POST" action="{{ url('user/called') }}" id ="myform" name ="myform">
            @csrf
            <div class="card-body">
                <div class="form-group row">

                    {{--  Name --}}
                   
                   
                    
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                      <b> Name : {{ $users->KIOSK_NAME }}</b>
                    </div>

                   

                    {{-- Email --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                    <b>Email :{{ $users->EMAIL_ID }}</b>
                    </div>

                    

                    {{-- Mobile Number --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                    <b >Contact number :<span id=""> {{ $users->MOBILE_NO }}</span></b>
                    <input type="hidden" name ="mobile" id ="mobile_id" value ="{{ $users->MOBILE_NO }}">
                    </div>


                    
                   <input type="hidden" name ="id" value ="{{ $users->id }}">
                   
                    
                    {{-- list --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        
                        <select class="form-control form-control-user" name="list" id="list_id">
                            <option value="0" selected >Select Option</option>
                          
                               @foreach( $data as $data )
                                <option value = "{{ $data->option }}" {{(($data->option == 'int') ? 'selected' : '')}}  >{{ $data->option }}</option>
                               @endforeach
                           
                        </select>
                        <span style="color:red;margin-left:10px; display:none;" id="select_opt">Please select Any one option.</span>
                      
                    </div>

                    {{-- Message --}}
                    <div class="col-sm-6 mb-3 mt-3 mb-sm-0">
                        <span></span>
                        <textarea
                            type="text" 
                            class="form-control form-control-user" 
                            id="message_id"
                            placeholder="do whatsapp messages....." 
                            name="message" 
                            value=""></textarea>
                            <span  id="show_msg" style="display:none">&#x2705; Messages has been send successfull !</span>
                            <span  id="show_msgErr" style="display:none;color:red"> Message has not been send  !</span>
                            <br>
                            <a class="btn btn-success float-right mr-3 mb-3" id="send_msg" >Send</a>
                           
                    </div>
          

                </div>
            </div>

            <div class="card-footer">
                
                <!--<a class="btn btn-primary float-left mr-3 mb-3" href="{{ url('user/call',[$prev]) }}">Prev</a>-->
                <button type="submit" class="btn btn-primary btn-user float-right mb-3" onclick="return validateRegister();">Next</button>
                <!--<a class="btn btn-primary float-right mr-3 mb-3" href="{{ url('user/call') }}">Next</a>-->
            </div>
        </form>
        @else
        <div class="card-body">
                <div class="form-group " style="text-align: center">
                   <b> No Record Found.</b>
                </div>
            </div>
        @endif
    </div>

</div>


@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>

<script>
  function validateRegister(){ 
var list =  $('#list_id').val();
if(list == 0){
$('#select_opt').show();
return false;
}else{
$('#select_opt').hide();
return true;

}

  }

  function myfunction(){ 
   alert('hello');
  }

</script>

<!-- whatsapp the data  -->
<script>
    $(function(){
       $('#send_msg').click(function() {
        var messages = $('#message_id').val();
        var phone = $('#mobile_id').val();
            $.ajax({
                url: 'send-msg',
                type: 'POST',
                data: {
                     message: messages ,
                     mobile_number:phone,
                     _token: $('meta[name="csrf-token"]').attr('content') 
                    },
                success: function(response)
                {
                  // alert(response);
                  if(response == 1){
                  $('#message_id').val('');
                  $('#show_msg').show().fadeOut(2000); 
                  }else{
                    $('#show_msgErr').show(); 
                  }
                }
            }); 
       });
    });    
</script>