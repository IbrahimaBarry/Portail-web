<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.blue-pink.min.css">
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/css/iziToast.min.css">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>

</head>
<body>
    
    <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header
            mdl-layout--fixed-tabs">
      <header class="mdl-layout__header" style="background: #0043ca">
        <div class="mdl-layout__header-row">
          <!-- Title -->
          <span class="mdl-layout-title">{{ config('app.name', 'Laravel') }}</span>
          <!-- Add spacer, to align navigation to the right -->
          <div class="sw mdl-layout--large-screen-only">
            <form action="{{ route('articles.search') }}" method="post">
              {{ csrf_field() }}
              <input type="search" name="data" class="search" placeholder="Recherche..." />
              <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
                <i class="material-icons">search</i>
              </button>
            </form>
          </div>

          <div class="mdl-layout-spacer"></div>
          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
                  mdl-textfield--floating-label mdl-textfield--align-right mdl-layout--small-screen-only">
            <form action="{{ route('articles.search') }}" method="post">
              {{ csrf_field() }}
              <label class="mdl-button mdl-js-button mdl-button--icon"
                     for="fixed-header-drawer-exp">
                <i class="material-icons">search</i>
              </label>
              <div class="mdl-textfield__expandable-holder">
                <input class="mdl-textfield__input" type="text" name="data"
                       id="fixed-header-drawer-exp">
              </div>
            </form>
          </div>
          <!-- Navigation -->
          <nav class="mdl-navigation mdl-layout--large-screen-only">
            @if (count(Auth::user()->unreadNotifications))
                <a id="notif" class="mdl-navigation__link">
                  <i class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo count(Auth::user()->unreadNotifications); ?>">notifications</i>
                </a>
            @else
                <a id="notif" class="mdl-navigation__link">
                  <i class="material-icons">notifications_none</i>
                </a>
            @endif
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="notif">
              @foreach (Auth::user()->unreadNotifications as $notification)
                <li class="mdl-menu__item">{{ $notification->data['info'] }}</li>
              @endforeach
            </ul>
            <a id="menu" class="mdl-navigation__link">{{ Auth::user()->name }}</a>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect"
                for="menu">
              <li class="mdl-menu__item">
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="mdl-color-text--black" style="text-decoration: none;">
                  Déconnexion
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <main class="mdl-layout__content">
        <!-- No header, and the drawer stays open on larger screens (fixed drawer). -->
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer">
          <div class="mdl-layout__drawer">
            <span class="mdl-layout-title mdl-color-text--primary">Navigation</span>
            <nav class="mdl-navigation">
              @if (Auth::user()->role_id === 1)
                <a class="mdl-navigation__link" href="{{ route('admin.dashboard') }}">Tableau de bord</a>
              @endif
              @if (Auth::user()->role_id === 2)
                <a class="mdl-navigation__link" href="{{ route('client.admin', ['id' => Auth::user()->groupe->id]) }}">Tableau de bord</a>
              @endif
              <a class="mdl-navigation__link active" href="{{ route('home') }}">Fil d'actualité</a>
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'date='.Carbon\Carbon::today()])}}">
                {{ Carbon\Carbon::today()->toFormattedDateString() }}
              </a>
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'date='.Carbon\Carbon::tomorrow()])}}">
                {{ Carbon\Carbon::tomorrow()->toFormattedDateString() }}
              </a>
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'date='.Carbon\Carbon::parse('+2 days')])}}">
                {{ Carbon\Carbon::parse('+2 days')->toFormattedDateString() }}
              </a>
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'date='.Carbon\Carbon::parse('+3 days')])}}">
                {{ Carbon\Carbon::parse('+3 days')->toFormattedDateString() }}
              </a>
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'date='.Carbon\Carbon::parse('+4 days')])}}">
                {{ Carbon\Carbon::parse('+4 days')->toFormattedDateString() }}
              </a>
            </nav>
            <hr>
            <span class="mdl-layout-title mdl-color-text--primary">Langue</span>
            <nav class="mdl-navigation">
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'langue=FRENCH'])}}">Français</a>
              <a class="mdl-navigation__link" href="{{route('home.sort', ['data' => 'langue=Arabic,English'])}}">Arabe</a>
            </nav>
            <hr>
            <span class="mdl-layout-title mdl-color-text--primary">Themes</span>
            <nav class="mdl-navigation">
              @if (Auth::user()->role->name === 'Utilisateur')
                @foreach ($themes as $theme)
                  <a class="mdl-navigation__link" href="">{{ $theme }}</a>
                @endforeach
              @else
                @foreach ($themes as $theme)
                  <a class="mdl-navigation__link" href="">{{ $theme->name }}</a>
                @endforeach
              @endif
            </nav>
          </div>

          <main class="mdl-layout__content">
            <div class="page-content mdl-grid">
                    <!-- SECTION -->
                    <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone">
                      @yield('content')
                    </div>
                    <!-- END SECTION -->

                    <!-- ASIDE -->
                    <!-- <div class="mdl-card mdl-shadow--2dp mdl-cel mdl-cell--3-col-desktop mdl-cell--8-col-tablet mdl-cell--4-col-phone mdl-color--white">
                        
                    </div> -->
                    <!-- END ASIDE -->
                </div>
            </div>
          </main>

        </div>
      </main>
    </div>
    
    <!-- <a href="" target="_blank" id="view-pdf" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-color--accent mdl-color-text--accent-contrast mdl-cell--hide-tablet mdl-cell--hide-phone">Tous télécharger</a>

    <a href="" id="view-pdf" class="mdl-button mdl-js-button mdl-button--fab mdl-color--accent mdl-color-text--accent-contrast mdl-cell--hide-desktop"><i class="material-icons">file_download</i></a>
     -->
    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
     <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="//js.pusher.com/4.0/pusher.min.js" type="text/javascript"></script>
    <script src="/js/iziToast.min.js"></script>

    @if (Session::has('success'))
      <script type="text/javascript">
        iziToast.success({
            title: 'OK',
            message: '<?php echo Session::get('success') ?>',
            position: 'topRight',
        });
      </script>
    @endif

    @if (Session::has('error'))
      <script type="text/javascript">
        iziToast.error({
            title: 'Erreur',
            message: '<?php echo Session::get('error') ?>',
            position: 'topRight',
        });
      </script>
    @endif
    
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