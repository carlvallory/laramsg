<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Dashboard</title>

        <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css" rel="stylesheet">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            /*! normalize.css v8.0.1 | MIT License | github.com/necolas/normalize.css */
            html{line-height:1.15;-webkit-text-size-adjust:100%}body{margin:0}a{background-color:transparent}[hidden]{display:none}html{font-family:system-ui,-apple-system,BlinkMacSystemFont,Segoe UI,Roboto,Helvetica Neue,Arial,Noto Sans,sans-serif,Apple Color Emoji,Segoe UI Emoji,Segoe UI Symbol,Noto Color Emoji;line-height:1.5}*,:after,:before{box-sizing:border-box;border:0 solid #e2e8f0}a{color:inherit;text-decoration:inherit}svg,video{display:block;vertical-align:middle}video{max-width:100%;height:auto}.bg-white{--tw-bg-opacity: 1;background-color:rgb(255 255 255 / var(--tw-bg-opacity))}.bg-gray-100{--tw-bg-opacity: 1;background-color:rgb(243 244 246 / var(--tw-bg-opacity))}.border-gray-200{--tw-border-opacity: 1;border-color:rgb(229 231 235 / var(--tw-border-opacity))}.border-t{border-top-width:1px}.flex{display:flex}.grid{display:grid}.hidden{display:none}.items-center{align-items:center}.justify-center{justify-content:center}.font-semibold{font-weight:600}.h-5{height:1.25rem}.h-8{height:2rem}.h-16{height:4rem}.text-sm{font-size:.875rem}.text-lg{font-size:1.125rem}.leading-7{line-height:1.75rem}.mx-auto{margin-left:auto;margin-right:auto}.ml-1{margin-left:.25rem}.mt-2{margin-top:.5rem}.mr-2{margin-right:.5rem}.ml-2{margin-left:.5rem}.mt-4{margin-top:1rem}.ml-4{margin-left:1rem}.mt-8{margin-top:2rem}.ml-12{margin-left:3rem}.-mt-px{margin-top:-1px}.max-w-6xl{max-width:72rem}.min-h-screen{min-height:100vh}.overflow-hidden{overflow:hidden}.p-6{padding:1.5rem}.py-4{padding-top:1rem;padding-bottom:1rem}.px-6{padding-left:1.5rem;padding-right:1.5rem}.pt-8{padding-top:2rem}.fixed{position:fixed}.relative{position:relative}.top-0{top:0}.right-0{right:0}.shadow{--tw-shadow: 0 1px 3px 0 rgb(0 0 0 / .1), 0 1px 2px -1px rgb(0 0 0 / .1);--tw-shadow-colored: 0 1px 3px 0 var(--tw-shadow-color), 0 1px 2px -1px var(--tw-shadow-color);box-shadow:var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow)}.text-center{text-align:center}.text-gray-200{--tw-text-opacity: 1;color:rgb(229 231 235 / var(--tw-text-opacity))}.text-gray-300{--tw-text-opacity: 1;color:rgb(209 213 219 / var(--tw-text-opacity))}.text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}.text-gray-600{--tw-text-opacity: 1;color:rgb(75 85 99 / var(--tw-text-opacity))}.text-gray-700{--tw-text-opacity: 1;color:rgb(55 65 81 / var(--tw-text-opacity))}.text-gray-900{--tw-text-opacity: 1;color:rgb(17 24 39 / var(--tw-text-opacity))}.underline{text-decoration:underline}.antialiased{-webkit-font-smoothing:antialiased;-moz-osx-font-smoothing:grayscale}.w-5{width:1.25rem}.w-8{width:2rem}.w-auto{width:auto}.grid-cols-1{grid-template-columns:repeat(1,minmax(0,1fr))}@media (min-width:640px){.sm\:rounded-lg{border-radius:.5rem}.sm\:block{display:block}.sm\:items-center{align-items:center}.sm\:justify-start{justify-content:flex-start}.sm\:justify-between{justify-content:space-between}.sm\:h-20{height:5rem}.sm\:ml-0{margin-left:0}.sm\:px-6{padding-left:1.5rem;padding-right:1.5rem}.sm\:pt-0{padding-top:0}.sm\:text-left{text-align:left}.sm\:text-right{text-align:right}}@media (min-width:768px){.md\:border-t-0{border-top-width:0}.md\:border-l{border-left-width:1px}.md\:grid-cols-2{grid-template-columns:repeat(2,minmax(0,1fr))}}@media (min-width:1024px){.lg\:px-8{padding-left:2rem;padding-right:2rem}}@media (prefers-color-scheme:dark){.dark\:bg-gray-800{--tw-bg-opacity: 1;background-color:rgb(31 41 55 / var(--tw-bg-opacity))}.dark\:bg-gray-900{--tw-bg-opacity: 1;background-color:rgb(17 24 39 / var(--tw-bg-opacity))}.dark\:border-gray-700{--tw-border-opacity: 1;border-color:rgb(55 65 81 / var(--tw-border-opacity))}.dark\:text-white{--tw-text-opacity: 1;color:rgb(255 255 255 / var(--tw-text-opacity))}.dark\:text-gray-400{--tw-text-opacity: 1;color:rgb(156 163 175 / var(--tw-text-opacity))}.dark\:text-gray-500{--tw-text-opacity: 1;color:rgb(107 114 128 / var(--tw-text-opacity))}}
        </style>

        <style>
            body {
                font-family: 'Noto Sans', sans-serif;
            }
        </style>

        <link rel="stylesheet" href="{{ asset('css/wa_app.css?v='.((int)(time()/60))) }}">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    </head>
    <body class="antialiased">
        <div class="container">
            <div>
                <aside id="sidebar_secondary" class="tabbed_sidebar ng-scope chat_sidebar">
                    <div class="glow">
                        <div class="frame">
                            <div class="popup-head">
                                <div class="popup-head-left pull-left">
                                
                                    <h1>Whatsapp</h1>

                                </div>
                                <div class="popup-head-right pull-right">
                                    <div class="btn-group gurdeepoushan">
                                        <button class="chat-header-button" data-toggle="dropdown" type="button" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h" aria-hidden="true"></i> </button>
                                        <ul role="menu" class="dropdown-menu pull-right">
                                            <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> Contact</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div id="chat" class="chat_box_wrapper chat_box_small chat_box_active" style="opacity: 1; display: block; transform: translateX(0px);">
                                <div id="chat_box" class="chat_box touchscroll chat_box_colors_a">
                                
                                    @foreach($msgs as $key => $msg)
                                        <div class="chat_message_wrapper">
                                            <div class="chat_user_avatar">
                                                <a href="#" target="_blank">
                                                    @if(is_null($msg->msg_image) || str_contains($msg->msg_image, '@'))
                                                        <img alt="{{base64_decode($msg->msg_name)}}" title="{{base64_decode($msg->msg_name)}}" src="{{asset('images/default.svg')}}" class="md-user-image">
                                                    @else
                                                        <img alt="{{base64_decode($msg->msg_name)}}" title="{{base64_decode($msg->msg_name)}}" src="{{base64_decode($msg->msg_image)}}" onerror="this.src='{{asset('images/default.svg')}}';" class="md-user-image">
                                                    @endif
                                                </a>
                                            </div>
                                            
                                            <ul class="chat_message" id="{{$msg->msg_id}}" data-from="{{$msg->msg_from}}">
                                                <li>
                                                    <a> {{base64_decode($msg->msg_name)}} </a>
                                                    <p> {{base64_decode($msg->msg_body)}} </p>
                                                </li>
                                                {{-- <li>
                                                <p> Lorem ipsum dolor sit amet.<span class="chat_message_time">13:38</span> </p>
                                                </li> --}}
                                            </ul>

                                            <input type="hidden" class="schedule_title" value="{{$msg->schedule->title}}" />

                                        </div>
                                    @endforeach
                                
                                </div>
                            </div>
            
            
                        </div>
                    </div>
                </aside>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function(){
                $('#sidebar_secondary').addClass('popup-box-on');
            });

            $(document).ready(function(){
                var colors = ["#2C2C2E","#4E5462"];
                var rand = Math.floor(Math.random()*colors.length);
                document.querySelectorAll('.chat_box .chat_message_wrapper ul.chat_message > li a').forEach(element => { element.style.color = colors[rand]; });
            });

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
                        //console.log(data);
                        let str = html(data);
                        
                        var Obj = document.getElementById('chat_box');
                        if(Obj.innerHTML) {
                            Obj.innerHTML=str;
                        }
                    }
                    //console.log(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    alert('Something went wrong.');
                });
            }

            updateData();

            /* document.getElementById("chat").addEventListener(
                "DOMNodeInserted",
                (event) => {
                    clearInterval(loadInterval);
                    var loadInterval = setInterval(updateData(), 1000*60);
                },
                false,
            ); */

            //var loadInterval = setInterval(updateData(), 1000*60);

            function html(msg) {

                const msgs = Object.assign([], msg)['msgs'][0];
                //const schedules = Object.assign([], msg)['schedules'][0];
                
                let msg_image = msgs.msg_image;
                let baseUrl = window.location.origin;
                let image = null;
                let html = null;

                if(!msg_image || msg_image.includes('@')) {
                    image = '<img alt="' + atob(msgs.msg_name) + '" title="' + atob(msgs.msg_name) + '" src="' + baseUrl + '/images/default.svg" class="md-user-image">';
                } else {
                    msg_image = while_decode(msg_image);
                    image = '<img alt="' + atob(msgs.msg_name) + '" title="' + atob(msgs.msg_name) + '" src="' + msg_image + '" onerror="this.src=\'' + baseUrl + '/images/default.svg\';" class="md-user-image">';
                }

                html = '<div class="chat_message_wrapper">' +
                    '<div class="chat_user_avatar">' +
                        '<a href="#" target="_blank">' +
                            image +
                        '</a>' +
                    '</div>' +
                    '<ul class="chat_message" id="' + msgs.msg_id + '" data-from="' + msgs.msg_from + '">' +
                        '<li>' +
                            '<a>' + atob(msgs.msg_name) + '</a>' +
                            '<p>' + atob(msgs.msg_body) + '</p>' +
                        '</li>' +
                    '</ul>' +
                    '<input type="hidden" class="schedule_title" value="' + 'schedules.title' + '" />' +
                '</div>';

                return html;
            }

            function while_decode(string) {
                if(!string.includes("_")) { return string; }
                let arr = string.split("_");
                string = arr[0];
                let n = arr[1];
                let i = 0;
                
                while (i < n) {
                    i++;
                    string = atob(string);
                }

                return string;
            }

        </script>
    </body>
</html>
