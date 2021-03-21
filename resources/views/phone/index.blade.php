@extends('layout.admin')
@section('title','Phone Lists')
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

              <a href="{{ route('phone.create',$contact->id) }}" style="float: right" class="btn btn-success"> Add Contact</a>
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
                  <th>Number</th>
                  <th>Whatsapp</th>
                  <th>Landline</th>
                  <th>Text</th>
                  {{-- <th>Number</th> --}}
                  {{-- <th>Created At</th> --}}
                  {{-- <th></th> --}}
                  {{-- <th>Send Message</th> --}}
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
               @foreach($phones as $key=>$phone) 
                <tr>
                  <td>{{ $key+1 }}</td>
                  <td>{{ $phone->number }}</td>
                  <td>
                      @if($phone->has_whatsapp == 1)
                      Yes
                      @else
                      No
                      @endif
                  </td>
                  <td>
                    @if($phone->is_landline == 1)
                    Yes
                    @else
                    No
                    @endif

                  </td>
                  <td>
                    @if($phone->can_receive_text == 1)
                    Yes
                    @else
                    No
                    @endif

                  </td>
                 
                  <td>
                   
                     
                    <a href="{{ route('phone.edit',$phone->id) }}" class="btn btn-sm"> <i class="fas fa-edit"></i></a>
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
                            url: '{{ route('phone.destroy') }}',
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

