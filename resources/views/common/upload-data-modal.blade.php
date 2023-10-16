<div class="modal fade" id="datauploadModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Data upload</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <form method="POST" action="{{route('users.upload')}}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="" id="user_id_">
            <div class="modal-body">


                <div class="form-group row">

                    <div class="col-md-12 mb-3 mt-3">
                        <p>Please Upload CSV in Given Format <a href="{{ asset('files/sample-data-sheet.csv') }}" target="_blank">Sample CSV Format</a></p>
                    </div>
                    {{-- File Input --}}
                    <div class="col-sm-12 mb-3 mt-3 mb-sm-0">
                        <span style="color:red;">*</span>File Input(Datasheet)</label>
                        <input type="file" class="form-control form-control-user @error('file') is-invalid @enderror" id="exampleFile" name="file" value="{{ old('file') }}">

                        @error('file')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>

                </div>
            </div>
            <div class="modal-footer">
            <button type="submit" class="btn btn-success btn-user float-right mb-3">Upload Data</button>
                <a class="btn btn-primary float-right mr-3 mb-3" href="{{ route('users.import') }}">Cancel</a>

               
            </div>

            </form>


        </div>
    </div>
</div>