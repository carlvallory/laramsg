@extends('dashboard.msgs.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Laravel 10 CRUD Example from scratch - ItSolutionStuff.com</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('admin.dashboard.msgs.create') }}"> Create New Message</a>
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
            <th>Name</th>
            <th>Details</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($msgs as $msg)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $msg->name }}</td>
            <td>{{ $msg->detail }}</td>
            <td>
                <form action="{{ route('admin.dashboard.msgs.destroy',$msg->id) }}" method="POST">
   
                    <a class="btn btn-info" href="{{ route('admin.dashboard.msgs.show',$msg->id) }}">Show</a>
    
                    <a class="btn btn-primary" href="{{ route('admin.dashboard.msgs.edit',$msg->id) }}">Edit</a>
   
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