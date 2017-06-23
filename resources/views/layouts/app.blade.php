<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->
    <link rel='stylesheet prefetch' href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/style.css">
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//js.pusher.com/4.0/pusher.min.js" type="text/javascript"></script>
    <script src="//code.jquery.com/jquery-2.1.3.min.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="/css/iziToast.min.css">
    <script type="text/javascript" src="/js/iziToast.min.js"></script>
    
    <script>

        var pusher = new Pusher('ca090a3a1702d459b7eb');

        var notificationsChannel = pusher.subscribe('notifications');

        notificationsChannel.bind('Notification', function(notification){
            var message = notification.message;

            iziToast.info({
                title: 'Alert',
                message: message,
                position: 'topRight',
            });
        });

    </script>
</body>
</html>
