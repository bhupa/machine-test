@extends('layout.admin')
@section('title','Create Phone')
@section('content')
<div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        {{-- <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard v1</li>
          </ol>
        </div><!-- /.col --> --}}
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Phone List</h3>

              <a href="{{ route('phone',$contact->id) }}" style="float: right" class="btn btn-success"> Add Contact</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                  <div class="col-md-2"></div>
                  <div class="col-md-8">
                    <div class="card card-danger">
                        <div class="card-header">
                          <h3 class="card-title">Phone Form</h3>
                          <button type="button" class="btn btn-sm btn-warning add-more-time" style="float: right;">Add More </button>

                        </div>
                        <form action="{{ route('phone.store') }}" method="post">
                            {{ csrf_field() }}
                            @if (Session::has('flash_error'))
                            <span class="help-block text-danger">{{ session::get('flash_error') }}</span>
                            @endif
                            {{-- @foreach($errors->all(':message') as $message)
                            <div id="form-messages" class="alert alert-danger" role="alert">
                              {{ $message }}
                            </div>
                          @endforeach() --}}
                        <div class="card-body">
                          <!-- Date dd/mm/yyyy -->
                          <div class="row">
                              
                              
                          </div>
                          <div id="add-more-div">
                            <div class="row">
                                <div class="col">
                                    <label for="">Number</label><br>
                                     <input type="text" class="form-control" id="email" placeholder="Enter number" name="number[0]">
                                </div>
                                <div class="col">
                                    <label for="">Receive Text</label><br>
                                    <input type="checkbox"  name="can_receive_text[0]">
                                </div>
                                <div class="col">
                                    <label for="">Has Whatsapp</label><br>
                                     <input type="checkbox"  name="has_whatsapp[0]">
                                </div>
                                <div class="col">
                                  <label for="">Landline</label><br>
                                   <input type="checkbox"  name="is_landline[0]">
                              </div>
                                <div class="col">
                                </div>
                            </div>
                          </div><br>
                         <input type="hidden" name="contact_id" value="{{ $contact->id }}">

                          <button type="`submit" class="btn btn-primary">Submit </button>
                        </form>
                          <!-- phone mask -->
                          
                        <!-- /.card-body -->
                      </div>
                  </div>
                  <div class="col-md-2"></div>
                  
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

      <!-- /.row -->
      <!-- Main row -->
     
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
@endsection

@section('script')
<script>
   $(document).ready(function () {

       $('#add-modal').on('click',function(){

        $('#addModal').modal('show');
       })

       
           
 

           


            var  timeLists = 0;

            $('body').on('click','.add-more-time',function(){
                        timeLists++
                    
                        if(timeLists > 0){
                        $('#add-list-btn').css('display','none');
                        }
                        var btnId = timeLists - 1;
                        $('#list-add-'+btnId).css('display','none');
                        $('#list-delete-'+btnId).css('display','none');
                        var objTo = document.getElementById('add-more-div')
                        var divtest = document.createElement("div");
                        divtest.setAttribute("class", "add-row-column removeTime-"+timeLists);

                        divtest.innerHTML = '<div class="row " style="margin-bottom:20px;">'+
                                                '<div class="col">'+
                                                    '<label for="">Number</label><br>'+
                                                    '<input type="text" class="form-control" id="email" placeholder="Enter number" name="number['+timeLists+']">'+
                                                '</div>'+
                                                '<div class="col">'+
                                                    '<label for="">Receive Text</label><br>'+
                                                    '<input type="checkbox"  name="can_receive_text['+timeLists+']">'+
                                                '</div>'+
                                                '<div class="col">'+
                                                    '<label for="">Has Whatsapp</label><br>'+
                                                    '<input type="checkbox"  name="has_whatsapp['+timeLists+']">'+
                                                '</div>'+
                                                '<div class="col">'+
                                                    '<label for="">Landline</label><br>'+
                                                    '<input type="checkbox"  name="is_landline['+timeLists+']">'+
                                                '</div>'+
                                                '<div class="col">'+
                                                    '<a href="javascript:void(0)" data-id="'+timeLists+'" class="btn btn-sm btn-warning add-remove-time" id="list-delete-'+timeLists+'">Remove</a>'+
                                                '</div>'
                                            '</div>';
                              

        objTo.appendChild(divtest)
    })

    $('body').on('click','.add-remove-time',function(){
        var id = $(this).attr('data-id');
        var btnId = id - 1;
        if(btnId < 1){
        $('#add-list-btn').css('display','block');
        }
        $('#list-add-'+btnId).css('display','inline-block');
        $('#list-delete-'+btnId).css('display','inline-block');
        $('.removeTime-'+id ).remove();
    });
   

   
            
  });

</script>
@endsection
