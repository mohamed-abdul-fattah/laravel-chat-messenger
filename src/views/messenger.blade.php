@extends('layouts.app')

@section('css-styles')
    <link rel="stylesheet" href="/vendor/messenger/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="/vendor/messenger/css/messenger.css">
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 threads">
            @include('messenger::partials.threads')
        </div>

        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>{{$user->name}}</h4></div>

                <div class="panel-body">
                    <div class="messenger">
                        @if (count($messages) === 20)
                            <div id="messages-preloader"></div>
                        @else
                            <p class="start-conv">Conversation started</p>
                        @endif
                        <div class="messenger-body">
                            @include('messenger::partials.messages')
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <input type="hidden" name="receiverId" value="{{$user->id}}">
                    <textarea id="message-body" name="message" rows="2" placeholder="Type your message..."></textarea>
                    <button type="submit" id="send-btn" class="btn btn-primary">SEND</button>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="panel panel-default">
                <div class="panel-heading"><h4>Profile</h4></div>

                <div class="panel-body">
                    <p>
                        <span>Name</span> {{$user->name}}
                    </p>
                    <p>
                        <span>Email</span> {{$user->email}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js-scripts')
    <script src="https://js.pusher.com/4.1/pusher.min.js"></script>
    <script type="text/javascript">
        var receiverId    = {{$user->id}},
            authId        = {{auth()->id()}},
            messagesCount = {{count($messages)}};
            pusher        = new Pusher('{{config('messenger.pusher.app_key')}}', {
              cluster: '{{config('messenger.pusher.options.cluster')}}'
            });
    </script>
    <script src="/vendor/messenger/js/messenger-chat.js" charset="utf-8"></script>
@endsection