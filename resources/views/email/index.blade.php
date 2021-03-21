@extends('layout.admin')
@section('title','Email Lists')
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
              <h3 class="card-title">Email List</h3>

              <a href="javascript:void(0)"  id="add-modal" style="float: right" class="btn btn-success"> Add Email</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if (Session::has('flash_success'))
              <div class="alert alert-success" role="alert">
                {{ session::get('flash_success') }}
              </div>
             
              @endif
              <div id="list-tab">
              <table id="data-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.no</th>
                  <th>Email</th>
                  {{-- <th>Last Name</th> --}}
                  {{-- <th>Number</th> --}}
                  <th>Created At</th>
                  {{-- <th></th> --}}
                  {{-- <th>Send Message</th> --}}
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($emails as $key=>$email)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $email->address }}</td>
                  {{-- <td>{{ $contact->last_name }}</td> --}}
                  {{-- <td>{{ $contact }}</td> --}}
                  <td>{{ $email->created_at->format('Y-m-d') }}</td>
                  {{-- <td>
                    <a href="javascript:void(0)"
                    title="Change-status"
                    data-toggle="tooltip"
                    class="btn btn-success btn-sm change-status"
                    id="{{ $account->id }}">
                     @if($account->status == 1)
                         <i class="fa fa-check"></i>
                     @else
                         <i class="fa fa-minus"></i>
                     @endif
                   </a>
           

                  </td> --}}
                  <td>
                   
                    
                      <a href="javascript:void(0)" data-type="{{ $email->id }}" class="btn btn-sm eidt-email"> <i class="fas fa-edit"></i></a>
                      <a href="javascript:void(0)" id="{{ $email->id }}" class="btn btn-sm delete"> <i class="fas fa-trash"></i></a>
                  </td>
                 
                 
                 
                </tr>
                @endforeach
          
               
                
                </tbody>
                <tfoot>
               
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div id="edit-list-tab">

         </div>
        <div class="modal" id="addModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                    <div class="modal-header">
                    <h2 class="modal-title">Add Email</h5>
                    </div>
                    <form action=""  id="add-email-form" class="form-inline">
                        {{ csrf_field() }}
                    <div class="modal-body">
                        <div id="add-more-div">
                            <div class="row" style="margin-bottom:20px;">
                                <div class="col-lg-8">
                                  <div class="input-group">
                                    <input type="email" class="form-control" name="email[0]">
                                  </div>
                                  <!-- /input-group -->
                                  <input type="hidden" name="contact_id" value={{ $contact->id }}>
                                </div>
                                <!-- /.col-lg-6 -->
                                <div class="col-lg-4">
                                  <div class="input-group">
                                    <button type="button" class="btn btn-primary add-more-time" id="add-list-btn">Add More</button>
                                  </div>
                                  <!-- /input-group -->
                                </div>
                                <!-- /.col-lg-6 -->
                              </div>
                                    
                        </div>
                                   
                        
                    </div>   
                    <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary modal-close-btn" data-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>
            </div>
         </div>
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

       
           
  $("#data-table").on("click", ".delete", function () {
                $object = $(this);
                var id = $object.attr('id');
                Swal.fire({
                  title: 'Are you sure?',
                    text: 'You will not be able to recover this !',
                    type: 'warning',
                      showCancelButton: true,
                      confirmButtonText: `Yes`,
                      // denyButtonText: `Don't save`,
                    }).then((result) => {
                      /* Read more about isConfirmed, isDenied below */
                      if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: '{{ route('email.destroy') }}',
                            data: {
                                id: id,
                                _method: 'Post',
                                _token: '{!! csrf_token() !!}'
                            },
                            success: function (response) {
                              Swal.fire("Deleted!", response.message, "success");
                                var oTable = $('#data-table').dataTable();
                                var nRow = $($object).parents('tr')[0];
                                oTable.fnDeleteRow(nRow);
                            },
                            error: function (e) {
                                if (e.responseJSON.message) {
                                    swal('Error', e.responseJSON.message, 'error');
                                } else {
                                    swal('Error', 'Something went wrong while processing your request.', 'error')
                                }
                            }
                        });
    // Swal.fire('Saved!', '', 'success')
  } 
})

             
            });
            $('#add-email-form').submit(function(e){
                e.preventDefault();
                event.preventDefault();
                $(this).submit(function() {
                    return false;
                 });
                var action = '{{ route('email.store') }}';
                var formdata = $('#add-email-form').serializeArray();
                $.ajax({
                    url: action,
                    type: "POST",
                    data:  formdata,
                    dataType: 'html',
                    success: function (data) {
                        alert(data);
                        var  timeLists = 0;
                        $('#add-email-form').trigger("reset");
                        $('#addModal').modal('toggle');
                    $('#list-tab').html(data)

                    },
                    error: function (res) {
                            
                        if( res.status === 422 ) {
                        var data = $.parseJSON(res.responseText);
                        console.log(data.errors);
                        $.each(data.errors, function (key, val) {
                            console.log(key);
                            $("#" + key + "").text(val);
                        });
                    }
                    }
                })

            return true;
            })

            $('body').on('submit','#edit-email-form',function(e){
                e.preventDefault();
             
                $(this).submit(function() {
                    return false;
                 });
                 var id = $('#edit-email-form #emailId').val();
                var action =  "{{ url('email/update') }}"+'/'+id;
                var formdata = $('#edit-email-form').serializeArray();
                $.ajax({
                    url: action,
                    type: "POST",
                    data:  formdata,
                    dataType: 'html',
                    success: function (data) {
                      
                        var  timeLists = 0;
                        $('#edit-email-form').trigger("reset");
                        $('#editModal').modal('toggle');
                        $('#list-tab').html(data)

                    },
                    error: function (res) {
                            
                        if( res.status === 422 ) {
                        var data = $.parseJSON(res.responseText);
                        console.log(data.errors);
                        $.each(data.errors, function (key, val) {
                            console.log(key);
                            $("#" + key + "").text(val);
                        });
                    }
                    }
                })

            return true;
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
                                '<div class="col-lg-8">'+
                                  '<div class="input-group">'+
                                    '<input type="text" class="form-control" name="email['+timeLists+']">'+
                                  '</div>'+
                                '</div>'+
                                '<div class="col-lg-4">'+
                                 ' <div class="input-group">'+
                                    '<a href="javascript:void(0)"  class="btn btn-sm add-more-time" id="list-add-'+timeLists+'"><i class="fas fa-plus"></i></a>'+
                                    '<a href="javascript:void(0)" data-id="'+timeLists+'" class="btn btn-sm add-remove-time" id="list-delete-'+timeLists+'"><i class="fas fa-minus"></i></a>'+
                                    // '<button type="button" class="btn btn-primary add-more-time " id="list-add-'+timeLists+'">Add More</button>'+
                                        // '<button type="button" data-id="'+timeLists+'" class="btn btn-primary add-remove-time" id="list-delete-'+timeLists+'">Remove  </button>'+
                        
                                 ' </div>'+
                                '</div>'+
                      
                                // '</div>'+
                     
                        //  '</div>'+
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
    $('body').on('click','.modal-close-btn',function(){
        $('.add-row-column').remove();
        $('#add-list-btn').css('display','block');
        var timeLists = 0;
    })

    $('body').on('click','.eidt-email',function(){
       
        var  id = $(this).attr('data-type');
        var url = "{{ url('email/edit') }}"+'/'+id;
        $.ajax({
                url: url,
                type: "get",
                dataType: 'html',
                success: function (data) {
                    $('#edit-list-tab').html(data)
                    $('#editModal').modal('show')

                },
                error: function (res) {
                        
                    if( res.status === 422 ) {
                    var data = $.parseJSON(res.responseText);
                    console.log(data.errors);
                    $.each(data.errors, function (key, val) {
                        console.log(key);
                        $("#" + key + "").text(val);
                    });
                }
                }
            })

    })

            
  });

</script>
@endsection

