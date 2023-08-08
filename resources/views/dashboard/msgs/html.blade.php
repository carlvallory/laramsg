@foreach($msgs as $key => $msg)
                            
    <div class="row message-body" data-id="{{$msg->id}}">
        <div class="col-sm-12 message-main-sender">
            <div class="sender">
                <div class="message-text">
                    <a> {{ base64_decode($msg->msg_name) }} </a>
                    @if($msg->msg_image != null) 
                        <figure class="figure">
                            <img src="{{ asset('storage/' . $msg->msg_image) }}" class="figure-img img-fluid" />
                        </figure>
                    @endif
                    @if(base64_decode($msg->msg_body) != "file")
                        <p> {{ base64_decode($msg->msg_body) }} </p>
                    @endif
                    
                </div>
                <div class="d-flex">
                    @if(!$msg->isActive())
                        <form method="DELETE" action="{{ route('admin.msgs.activate', $msg->id) }}" class="msg-deactivated" data-id="{{$msg->id}}">
                            @csrf
                            <div class="checkbox checkbox-success"><input id="cb-{{$msg->id}}" type="checkbox" name="show" value="{{$msg->id}}" data-id="{{$msg->id}}"><label for="cb-{{$msg->id}}">Mostrar</label></div>
                        </form>
                    @else
                        <form method="DELETE" action="{{ route('admin.msgs.deactivate', $msg->id) }}" class="msg-activated" data-id="{{$msg->id}}">
                            @csrf
                            <div class="checkbox checkbox-success">
                                <input id="cb-{{$msg->id}}" type="checkbox" name="show" value="{{$msg->id}}" data-id="{{$msg->id}}" checked="">
                                <label for="cb-{{$msg->id}}">No Mostrar</label>
                            </div>
                        </form>
                    @endif
                    @if($msg->trashed())
                        <form method="DELETE" action="{{ route('admin.msgs.restore', $msg->id) }}" class="msg-deleted" data-id="{{$msg->id}}">
                            @csrf
                            <div class="checkbox checkbox-danger"><input type="checkbox" name="delete" value="{{$msg->id}}"><label>Eliminar</label></div>
                        </form>
                    @else
                        <form method="DELETE" action="{{ route('admin.msgs.delete', $msg->id) }}" class="msg-restored d-none" data-id="{{$msg->id}}">
                            @csrf
                            <div class="checkbox checkbox-danger">
                                <input type="checkbox" name="delete" value="{{$msg->id}}">
                                <label>Eliminar</label>
                            </div>
                        </form>
                    @endif
                </div>
                <span class="message-time pull-right">
                    {{ Carbon\Carbon::parse(($msg->created_at))->format('H:m') }} | @if($msg->schedule) {{ $msg->schedule->title }} @endif
                </span>
            </div>
        </div>
    </div>
                            
    @if($loop->last)
        <input type="hidden" name="last_id" value="{{$msg->id}}">
    @endif
@endforeach