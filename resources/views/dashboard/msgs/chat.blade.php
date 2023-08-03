<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">


<title>Whatsapp web chat</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="{{ asset('css/wa_web.css?v='.((int)(time()/60))) }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="{{ asset('css/awesome-bootstrap-checkbox.css') }}">

</head>
<body>
    <div class="container app">
        <div class="row app-one">
            <div class="" style="display: none;"> <!-- col-sm-4 side -->
                <!-- chat conversation -->
                <div class="side-one">
                    <div class="row heading">
                        <div class="col-sm-3 col-xs-3 heading-avatar">
                            <div class="heading-avatar-icon">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png">
                            </div>
                        </div>
                        <div class="col-sm-1 col-xs-1  heading-dot  pull-right">
                            <div class="dropdown">
                                <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="getXY(this, 'dropdown-menu-1')"></i>

                                <ul class="dropdown-menu" id="dropdown-menu-1" aria-labelledby="dropdownMenu1">
                                    @if(!$loginAuth)
                                        <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
                                    @else
                                        <li><a href="#" onclick="logout('{{$login->user}}')">Logout</a></li>
                                    @endif
                                </ul>
                            </div>
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
            <div class="col-sm-12 conversation">
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
                        <div class="dropdown">
                            <i class="fa fa-ellipsis-v fa-2x  pull-right" aria-hidden="true" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" onclick="getXY(this, 'dropdown-menu-2')"></i>

                            <ul class="dropdown-menu" id="dropdown-menu-2" aria-labelledby="dropdownMenu2">
                                @if(!$loginAuth)
                                    <li><a href="#" data-toggle="modal" data-target="#myModal">Login</a></li>
                                @else
                                    <li><a href="#" onclick="logout('{{$login->user}}')">Logout</a></li>
                                @endif
                            </ul>
                        </div>
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
                                    
                                    @if($msg->trashed())
                                        <form method="DELETE" action="{{ route('admin.msgs.restore', $msg->id) }}" class="msg-deleted" data-id="{{$msg->id}}">
                                            @csrf
                                            <div class="checkbox checkbox-success"><input type="checkbox" onChange="this.form.submit()" name="delete" value="{{$msg->id}}"></div>
                                        </form>
                                    @else
                                        <form method="DELETE" action="{{ route('admin.msgs.delete', $msg->id) }}" class="msg-restored d-none" data-id="{{$msg->id}}">
                                            @csrf
                                            <span class="checkbox checkbox-success">
                                                <input type="checkbox" onChange="this.form.submit()" name="delete" value="{{$msg->id}}">
                                            </span>
                                        </form>
                                    @endif
                                    @if($msg->isActive())
                                        <form method="DELETE" action="{{ route('admin.msgs.activate', $msg->id) }}" class="msg-deactivated" data-id="{{$msg->id}}">
                                            @csrf
                                            <div class="checkbox checkbox-danger"><input type="checkbox" onChange="this.form.submit()" name="delete" value="{{$msg->id}}"></div>
                                        </form>
                                    @else
                                        <form method="DELETE" action="{{ route('admin.msgs.deactivate', $msg->id) }}" class="msg-activated d-none" data-id="{{$msg->id}}">
                                            @csrf
                                            <div class="checkbox checkbox-danger"><input type="checkbox" onChange="this.form.submit()" name="delete" value="{{$msg->id}}"></div>
                                        </form>
                                    @endif
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

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">QR</h4>
                </div>
                <div class="modal-body">
                    <iframe id="iframeid"
                            src="{{ route('admin.wa.qr') }}" 
                            width="400" 
                            height="400"
                            frameborder="0" 
                            style="border:0" 
                            allowfullscreen>
                    </iframe>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
                            if(newForm.hasClass('msg-deactivated')) {
                                newForm.parents('.message-body[data-id="' +newId+ '"]').remove();
                            }
                            if(newForm.hasClass('msg-deleted')) {
                                newForm.parents('.message-body[data-id="' +newId+ '"]').addClass('shaker');
                                setTimeout(function(){ newForm.parents('.message-body[data-id="' +newId+ '"]').removeClass('shaker'); }, 300);
                            }
                            console.log("it Works");
                            updateData();
                        }
                    });
                }

            });

            $('#myModal').on('shown.bs.modal', function () {
                reload();
                $('#iframeid').focus();
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
            var loadInterval = setInterval(loadMoreData(id), 1000*10);
        });
        
        var limit = $('.msg-deleted').first().data("id");
        var loadInterval = setInterval(loadMoreData(limit), 1000*10);

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
                    $('.loading').html('No more conversations.');
                    return;
                } else {
                    $('.loading').hide();
                    console.log(data);
                    if(data.status == 200) {
                        let msgData = Object.assign([], data);
                        let msgId   = msgData['msg'].id;
                        let limit   = msgData['limit'];

                        var lastId = 0;
                        
                        msgData['msgs'].data.forEach(async (msg) => {
                            if(lastId < msg.id) {
                                lastId = msg.id;
                                $('#conversation').prepend(html(msg));
                            }
                            console.log(msg);
                        });
                    }
                }
                console.log(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                  alert('Something went wrong.');
            });
        }

        function updateData() {
            let baseUrl = window.location.origin;
            let updateUrl = baseUrl + "/admin/dashboard";

            $.ajax({
                url: updateUrl,
                type: 'get',
                datatype: 'json'
            })
            .done(function(data) {
                if(data.length == 0) {
                    console.log("Empty")
                    return;
                } else {
                    console.log(data);
                }
                console.log(data);
            })
            .fail(function(jqXHR, ajaxOptions, thrownError) {
                  alert('Something went wrong.');
            });
        }
    </script>

    @if($login)
        <script type="text/javascript">
            function logout(user) {
                let logoutUrl = "{{ route('wa.logout', base64_decode($login->user)) }}";

                $.ajax({
                    url: logoutUrl,
                    type: 'get',
                })
                .done(function(data) {
                    alert(user);
                    console.log(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Something went wrong.');
                });
            }
        </script>
    @else
        <script type="text/javascript">
            function logout(user) {
                console.log(user);
            }
        </script>
    @endif

    <script>
        function getPosition( element ) {
            var rect = element.getBoundingClientRect();
            return {
                x: rect.left,
                y: rect.top
            };
        }

        function getXY(element, id) {
            var pos = getPosition(element);
            console.log(pos);
            document.getElementById(id).style.position="fixed";
            document.getElementById(id).style.maxWidth="200px";
            document.getElementById(id).style.top=pos.y + "px";
            document.getElementById(id).style.left=pos.x + "px";
        }

        function reload() {
            document.getElementById('iframeid').src = "{{ route('admin.wa.qr') }}";
        }

        function html(msg) {

            if("msgs" in msg;) {
                const msgs = msg['msgs'];
                console.log(msgs);

                let baseUrl = window.location.origin;
                let html = null;

                const date = new Date(msgs.created_at);
                const formatted = date.toLocaleString('en-US', { hour: 'numeric', minute: 'numeric', hour12: false });

                if(b64DecodeUnicode(msgs.msg_body) != "file") {
                    if(msgs.msg_image == null) {
                        html = '<form method="DELETE" action="' + baseUrl + '/dashboard/delete/' + msgs.id + '">' +
                            '<div class="row message-body">' +
                                '<div class="col-sm-12 message-main-sender">' +
                                    '<div class="sender">' +
                                        '<div class="message-text">' +
                                            '<a>' + b64DecodeUnicode(msgs.msg_name) + '</a>' +
                                            '<p>' + b64DecodeUnicode(msgs.msg_body) + '</p>' +
                                        '</div>' +
                                        '<span><input type="checkbox" onChange="this.form.submit()" name="delete" value="' + msgs.id + '"></span>' +
                                        '<span class="message-time pull-right">' +
                                            formatted +
                                        '</span>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        "</form>";
                    } else {
                        html = '<form method="DELETE" action="' + baseUrl + '/dashboard/delete/' + msgs.id + '">' +
                            '<div class="row message-body">' +
                                '<div class="col-sm-12 message-main-sender">' +
                                    '<div class="sender">' +
                                        '<div class="message-text">' +
                                            '<a>' + b64DecodeUnicode(msgs.msg_name) + '</a>' +
                                            '<figure class="figure">' +
                                                '<img src="' + asset(msgs.msg_image) + '" class="figure-img img-fluid" />' +
                                            '</figure>' +
                                            '<p>' + b64DecodeUnicode(msgs.msg_body) + '</p>' +
                                        '</div>' +
                                        '<span><input type="checkbox" onChange="this.form.submit()" name="delete" value="' + msgs.id + '"></span>' +
                                        '<span class="message-time pull-right">' +
                                            formatted +
                                        '</span>' +
                                    '</div>' +
                                '</div>' +
                            '</div>' +
                        "</form>";
                    }

                } else {

                    html = '<form method="DELETE" action="' + baseUrl + '/dashboard/delete/' + msgs.id + '">' +
                        '<div class="row message-body">' +
                            '<div class="col-sm-12 message-main-sender">' +
                                '<div class="sender">' +
                                    '<div class="message-text">' +
                                        '<a>' + b64DecodeUnicode(msgs.msg_name) + '</a>' +
                                        '<figure class="figure">' +
                                            '<img src="' + asset(msgs.msg_image) + '" class="figure-img img-fluid" />' +
                                        '</figure>' +
                                    '</div>' +
                                    '<span><input type="checkbox" onChange="this.form.submit()" name="delete" value="' + msgs.id + '"></span>' +
                                    '<span class="message-time pull-right">' +
                                        formatted +
                                    '</span>' +
                                '</div>' +
                            '</div>' +
                        '</div>' +
                    "</form>";
                }

                return html;
            }
        }

        function asset(src) {
            let baseUrl = window.location.origin;
            let str     = baseUrl + '/storage/' + src;

            return str;
        }

        function while_decode(string) {
            if(!string.includes("_")) { return string; }
            let arr = string.split("_");
            string = arr[0];
            let n = arr[1];
            let i = 0;
            
            while (i < n) {
                i++;
                string = b64DecodeUnicode(string);
            }

            return string;
        }

        function b64EncodeUnicode(str) {
            // first we use encodeURIComponent to get percent-encoded Unicode,
            // then we convert the percent encodings into raw bytes which
            // can be fed into btoa.
            return btoa(encodeURIComponent(str).replace(/%([0-9A-F]{2})/g,
                function toSolidBytes(match, p1) {
                    return String.fromCharCode('0x' + p1);
            }));
        }


        function b64DecodeUnicode(str) {
            // Going backwards: from bytestream, to percent-encoding, to original string.
            return decodeURIComponent(atob(str).split('').map(function(c) {
                return '%' + ('00' + c.charCodeAt(0).toString(16)).slice(-2);
            }).join(''));
        }
    </script>
</body>
</html>
