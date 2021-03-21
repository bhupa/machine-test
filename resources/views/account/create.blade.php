@extends('layout.admin')
@section('title','Create Account')
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
              <h3 class="card-title">Add Account</h3>

              <a href="{{ route('contact.create') }}" style="float: right" class="btn btn-success"> Add Account</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                  <div class="col-md-3"></div>
                  <div class="col-md-6">
                    <div class="card card-danger">
                        <div class="card-header">
                          <h3 class="card-title">Account Form</h3>
                        </div>
                        <form action="{{ route('account.store') }}" method="post">
                            {{ csrf_field() }}
                
                        <div class="card-body">
                          <!-- Date dd/mm/yyyy -->
                          <div class="form-group">
                            <label>App Name:</label>
          
                            <div class="input-group">
                             
                              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                            </div>
                            @if ($errors->has('name'))
                    <span class="help-block text-danger">{{ $errors->first('name') }}</span>
                    @endif
                            <!-- /.input group -->
                          </div>
                          <div class="form-group">
                            <label>App Id:</label>
          
                            <div class="input-group">
                             
                              <input type="text" class="form-control" name="app_id" value="{{ old('app_id') }}">
                            </div>
                            @if ($errors->has('app_id'))
                    <span class="help-block text-danger">{{ $errors->first('app_id') }}</span>
                    @endif
                            <!-- /.input group -->
                          </div>
                          <div class="form-group">
                            <label>App Url:</label>
          
                            <div class="input-group">
                              
                              <input type="url" class="form-control" name="app_url" value="{{ old('app_url') }}">
                            </div>
                            @if ($errors->has('app_url'))
                    <span class="help-block text-danger">{{ $errors->first('app_url') }}</span>
                    @endif
                            <!-- /.input group -->
                          </div>
                          <!-- /.form group -->
          
                          <!-- Date mm/dd/yyyy -->
                         
                          <!-- /.form group -->
          
                          <!-- phone mask -->
                          <div class="form-group">
                            <label>App Token:</label>
          
                            <div class="input-group">
                              
                              <input type="text" name="app_token" class="form-control" data-inputmask="&quot;mask&quot;: &quot;(999) 999-9999&quot;" data-mask="" inputmode="text" value="{{ old('app_token') }}">
                            </div>
                            @if ($errors->has('app_token'))
                    <span class="help-block text-danger">{{ $errors->first('app_token') }}</span>
                    @endif
                            <!-- /.input group -->
                          </div>
                          <button type="`submit" class="btn btn-primary">Submit </button>
                          
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
