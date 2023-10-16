 
 
 function uploadData(a) {
   
    
    $('#datauploadModal').modal('show');

    if(a != ''){
        $('#user_id_').val(a);
    }else{
        a = 'all';
        $('#user_id_').val(a);
    }
  }