@extends('layout.admin')
@section('title','Edit Phone')
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
              <h3 class="card-title">Edit Phone </h3>

              <a href="{{ route('phone',$phone->id) }}" style="float: right" class="btn btn-success"> View Phone Lists</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                          <h3 class="card-title">Phone Form</h3>
                          {{-- <button type="button" class="btn btn-sm btn-warning add-more-time" style="float: right;">Add More </button> --}}

                        </div>
                        <form action="{{ route('phone.update',$phone->id) }}" method="post">
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
                                <div class="col-12">
                                    <label for="">Number</label><br>
                                     <input type="text" class="form-control" id="email" placeholder="Enter number" name="number" value="{{ $phone->number }}">
                                </div>
                                <div class="col-12">
                                    <label for="">Receive Text</label><br>
                                    <input type="checkbox"  name="can_receive_text" @if($phone->can_receive_text == 1) checked @endif value="{{ $phone->can_receive_text }}">
                                </div>
                                <div class="col-12">
                                    <label for="">Has Whatsapp</label><br>
                                     <input type="checkbox"  name="has_whatsapp" @if($phone->has_whatsapp == 1) checked @endif value="{{ $phone->has_whatsapp }}">
                                </div>
                                <div class="col-12">
                                  <label for="">Landline</label><br>
                                   <input type="checkbox"  name="is_landline" @if($phone->is_landline == 1) checked @endif value="{{ $phone->is_landline }}">
                              </div>
                                <div class="col">
                                </div>
                            </div>
                          </div><br>
                

                          <button type="`submit" class="btn btn-primary">Submit </button>
                        </form>
                          <!-- phone mask -->
                          
                        <!-- /.card-body -->
                      </div>
                  </div>
                  <div class="col-md-3"></div>
                  
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
   
</script>
@endsection
