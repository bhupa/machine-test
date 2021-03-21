@extends('layout.admin')
@section('title','Contact Lists')
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
              <h3 class="card-title">Contact List</h3>

              <a href="{{ route('contact.create') }}" style="float: right" class="btn btn-success"> Add Contact</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              @if (Session::has('flash_success'))
              <div class="alert alert-success" role="alert">
                {{ session::get('flash_success') }}
              </div>
             
              @endif
              <table id="data-table" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>S.no</th>
                  <th>First Nmae</th>
                  <th>Last Name</th>
                  {{-- <th>Number</th> --}}
                  <th>Created At</th>
                  {{-- <th></th> --}}
                  {{-- <th>Send Message</th> --}}
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($contacts as $key=>$contact)
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $contact->first_name }}</td>
                  <td>{{ $contact->last_name }}</td>
                  {{-- <td>{{ $contact }}</td> --}}
                  <td>{{ $contact->created_at->format('Y-m-d') }}</td>
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
                   
                    <a href="{{ route('phone',$contact->id) }}" class="btn btn-sm"> <i class="fas fa-phone"></i></a>
                    <a href="{{ route('email',$contact->id) }}" id="{{ $contact->id }}" class="btn btn-sm "> <i class="fas fa-envelope"></i></a>
                      <a href="{{ route('contact.edit',$contact->id) }}" class="btn btn-sm"> <i class="fas fa-edit"></i></a>
                      <a href="javascript:void(0)" id="{{ $contact->id }}" class="btn btn-sm delete"> <i class="fas fa-trash"></i></a>
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

      <!-- /.row -->
      <!-- Main row -->
     
      <!-- /.row (main row) -->
    </div><!-- /.container-fluid -->
  </section>
@endsection
@section('script')
<script>
   $(document).ready(function () {
            $("#data-table").on("click", ".change-status", function () {
                $object = $(this);
                var id = $object.attr('id');
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'Do you want to change the status',
                    type: "warning", //type and imageUrl have been replaced with a single icon option.
                    icon:'warning', //The right way
                    showCancelButton: true, //showCancelButton and showConfirmButton are no longer needed. Instead, you can set buttons: true to show both buttons, or buttons: false to hide all buttons. By default, only the confirm button is shown.
                    confirmButtonColor: '#d33', //you should specify all stylistic changes through CSS. As a useful shorthand, you can set dangerMode: true to make the confirm button red. Otherwise, you can specify a class in the button object.
                    confirmButtonText: "Yes", // everything is in the buttons argument now
                    closeOnConfirm: "No",
                    buttons:true,//The right way
                    buttons: ["No", "Yes"] //The right way to do it in Swal1
                }).then(function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "POST",
                            url: "{{ route('contact.change-status') }}",
                            data: {
                                'id': id,
                                _token: '{!! csrf_token() !!}'
                            },
                            dataType: 'json',
                            success: function (response) {
                                
                              Swal.fire({
                                    title: "Success!",
                                    text: response.message,
                                    imageUrl: "{{ asset('backend/') }}thumbs-up.png",
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                                if (response.response.status == 1) {
                                    $($object).children().removeClass('fa fa-minus inactive-status');
                                    $($object).children().addClass('fa fa-check active-status');
                                } else {
                                    $($object).children().removeClass('fa fa-check active-status');
                                    $($object).children().addClass('fa fa-minus inactive-status');
                                }
                            },
                            error: function (e) {
                                if (e.responseJSON.message) {
                                    swal('Error', e.responseJSON.message, 'error');
                                } else {
                                    swal('Error', 'Something went wrong while processing your request.', 'error')
                                }
                            }
                        });
                    }
                });
            });
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
                            url: '{{ route('contact.destroy') }}',
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
  });

</script>
@endsection

