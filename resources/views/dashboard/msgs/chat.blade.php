<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Whatsapp web chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/wa_web.css?v='.((int)(time()/60))) }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
    <div class="container app">
        <div class="row app-one">
            <div class="col-sm-4 side">
                <!-- chat conversation -->
                <div class="side-one">
                    <div class="row heading">
                        <div class="col-sm-3 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                        </div>
                        </div>
                        <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                        <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
                        <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="row searchBox">
                        <div class="col-sm-12 searchBox-inner">
                            <div class="form-group has-feedback">
                                <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row sideBar">
                        @foreach($mainSchedules as $key => $schedule)
                            <div class="row sideBar-body">
                                <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                <div class="avatar-icon">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                </div>
                                </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8 sideBar-name">
                                            <span class="name-meta"> {{ $schedule->title }}
                                            </span>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                            <span class="time-meta pull-right">{{ $schedule->start }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- new chat -->
                <div class="side-two">
                    <div class="row newMessage-heading">
                        <div class="row newMessage-main">
                        <div class="col-sm-2 col-xs-2 newMessage-back">
                        <i class="fa fa-arrow-left" aria-hidden="true"></i>
                        </div>
                        <div class="col-sm-10 col-xs-10 newMessage-title">
                        New Chat
                        </div>
                        </div>
                    </div>
                    <div class="row composeBox">
                        <div class="col-sm-12 composeBox-inner">
                        <div class="form-group has-feedback">
                        <input id="composeText" type="text" class="form-control" name="searchText" placeholder="Search People">
                        <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                        </div>
                    </div>

                    <div class="row compose-sideBar">
                        @foreach($mainSchedules as $key => $schedule)
                            <div class="row sideBar-body">
                                <div class="col-sm-3 col-xs-3 sideBar-avatar">
                                    <div class="avatar-icon">
                                    <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                                    </div>
                                </div>
                                <div class="col-sm-9 col-xs-9 sideBar-main">
                                    <div class="row">
                                        <div class="col-sm-8 col-xs-8 sideBar-name">
                                            <span class="name-meta"> {{ $schedule->title }}
                                            </span>
                                        </div>
                                        <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                                            <span class="time-meta pull-right">{{ Carbon\Carbon::parse(Carbon\Carbon::now())->format('H:m') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- conversation -->
            <div class="col-sm-8 conversation">
                <div class="row heading">
                    <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
                        <div class="heading-avatar-icon">
                        <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                        </div>
                    </div>
                    <div class="col-sm-8 col-xs-7 heading-name">
                        <a class="heading-name-meta">Grupo Nacion
                        </a>
                        <span class="heading-online">Online</span>
                    </div>
                    <div class="col-sm-1 col-xs-1  heading-dot pull-right">
                        <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="row message" id="conversation">
                    <div class="row message-previous">
                        <div class="col-sm-12 previous">
                            {{-- <a onclick="previous(this)" id="ankitjain28" name="20">
                            Show Previous Message!
                            </a> --}}
                        </div>
                    </div>
                    {{-- <div class="row message-body">
                        <div class="col-sm-12 message-main-receiver">
                            <div class="receiver">
                                <div class="message-text">
                                Hi, what are you doing?!
                                </div>
                                <span class="message-time pull-right">
                                Sun
                                </span>
                            </div>
                        </div>
                    </div> --}}
                    
                    @foreach($msgs as $key => $msg)
                        @if($msg->trashed())
                            <form method="DELETE" action="{{ route('admin.msgs.restore', $msg->id) }}" class="msg-deleted" data-id="{{$msg->id}}">
                                @csrf
                                <div class="row message-body">
                                    <div class="col-sm-12 message-main-sender">
                                        <div class="sender">
                                            <div class="message-text">
                                                <a> {{base64_decode($msg->msg_name)}} </a>
                                                <p> {{ base64_decode($msg->msg_body) }} </p>
                                            </div>
                                            <span><input type="checkbox" onChange="this.form.submit()" name="delete" value="{{$msg->id}}"></span>
                                            <span class="message-time pull-right">
                                                {{ Carbon\Carbon::parse(($msg->created_at))->format('H:m') }} | @if($msg->schedule) {{ $msg->schedule->title }} @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @else
                            <form method="DELETE" action="{{ route('admin.msgs.delete', $msg->id) }}" class="msg-restored d-none" data-id="{{$msg->id}}>
                                @csrf
                                <div class="row message-body">
                                    <div class="col-sm-12 message-main-sender">
                                        <div class="sender">
                                            <div class="message-text">
                                                <a> {{base64_decode($msg->msg_name)}} </a>
                                                <p> {{ base64_decode($msg->msg_body) }} </p>
                                            </div>
                                            <span><input type="checkbox" onChange="this.form.submit()" name="delete" value="{{$msg->id}}"></span>
                                            <span class="message-time pull-right">
                                                {{ Carbon\Carbon::parse(($msg->created_at))->format('H:m') }} | @if($msg->schedule) {{ $msg->schedule->title }} @endif
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        @endif
                        @if($loop->last)
                            <input type="hidden" name="last_id" value="{{$msg->id}}">
                        @endif
                    @endforeach
                    
                </div>
                <div class="row reply">
                    <div class="col-sm-1 col-xs-1 reply-emojis">
                        <i class="fa fa-smile-o fa-2x"></i>
                    </div>
                    <div class="col-sm-9 col-xs-9 reply-main">
                        <textarea class="form-control" rows="1" id="comment"></textarea>
                    </div>
                    <div class="col-sm-1 col-xs-1 reply-recording">
                        <i class="fa fa-microphone fa-2x" aria-hidden="true"></i>
                    </div>
                    <div class="col-sm-1 col-xs-1 reply-send">
                        <i class="fa fa-send fa-2x" aria-hidden="true"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(function(){
            $(".heading-compose").click(function() {
                $(".side-two").css({
                    "left": "0"
                });
            });

            $(".newMessage-back").click(function() {
                $(".side-two").css({
                    "left": "-100%"
                });
            });

            $('input[type="checkbox"]').on('click', function(e) { 
                e.preventDefault();

                if($(this).is(":checked")) {

                    var newForm = $(this).parents('form');
                    var newId = newForm.data("id");
                    var newUrl = newForm.attr('action');
                    var token = "{{ csrf_token() }}";

                    $.ajax(
                    {
                        url: newUrl,
                        type: 'DELETE',
                        data: {
                            "id": newId,
                            "_token": token,
                        },
                        success: function (){
                            newForm.remove();
                            console.log("it Works");
                        }
                    });
                }

            });
        })
    </script>
    <script type="text/javascript">
        $('#conversation').scroll(function() {
            if($(window).scrollTop() + $(window).height() >= $(document).height()) {
                let paginate = $('.msg-deleted').first().data("id");
                loadMoreData(paginate);
              }
        });

        $('#conversation').on('DOMNodeInserted', '.msg-deleted', function(e){
            clearInterval(loadInterval);
            let id = $(this).data("id");
            var loadInterval = setInterval(loadMoreData(id), 1000*60);
        });
        
        var limit = $('.msg-deleted').first().data("id");
        var loadInterval = setInterval(loadMoreData(limit), 1000*60);

        // run function when user reaches to end of the page
        function loadMoreData(paginate) {
            let lastId = $('input[name="last_id"]').val();
            /* var loadUrl = "{{ route('admin.msgs.load.chat', $limit) }}"; */
            let baseUrl = window.location.origin;
            let loadUrl = baseUrl + "/admin/dashboard/load/chat/" + paginate;

            $.ajax({
                url: loadUrl,
                type: 'get',
                datatype: 'html',
                beforeSend: function() {
                    $('.loading').show();
                }
            })
            .done(function(data) {
                if(data.length == 0) {
                    $('.loading').html('No more posts.');
                    return;
                } else {
                    $('.loading').hide();
                    $('#post').append(data);
                }
                console.log(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                  alert('Something went wrong.');
            });
        }
    </script>
</body>
</html>