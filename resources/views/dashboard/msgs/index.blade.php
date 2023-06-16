@extends('dashboard.msgs.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 10 CRUD</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.msgs.create') }}"> Create New Message</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>id</th>
            <th>from</th>
            <th class="d-none">to</th>
            <th class="d-none">name</th>
            <th class="d-none">author</th>
            <th>body</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($msgs as $msg)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $msg->msg_id }}</td>
            <td>{{ $msg->msg_from }}</td>
            <td class="d-none">{{ $msg->msg_to }}</td>
            <td class="d-none">{{ base64_decode($msg->msg_name) }}</td>
            <td class="d-none">{{ $msg->msg_author }}</td>
            <td>{{ base64_decode($msg->msg_body) }}</td>
            <td>
                <form action="{{ route('admin.msgs.destroy',$msg->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('admin.msgs.show',$msg->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('admin.msgs.edit',$msg->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $msgs->links() !!}
      
@endsection