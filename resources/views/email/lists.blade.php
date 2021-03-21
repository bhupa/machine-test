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
       
        
          <a href="{{ route('email.edit',$email->id) }}" class="btn btn-sm"> <i class="fas fa-edit"></i></a>
          <a href="javascript:void(0)" id="{{ $email->id }}" class="btn btn-sm delete"> <i class="fas fa-trash"></i></a>
      </td>
     
     
     
    </tr>
    @endforeach

   
    
    </tbody>
    <tfoot>
   
    </tfoot>
  </table>