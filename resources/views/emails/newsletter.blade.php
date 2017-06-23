@component('mail::message')
<small>{{ Carbon\Carbon::now()->toFormattedDateString() }}</small><br>
# <h1 style="background: rgb(24, 64, 88); color: white">Des articles depuis {{ config('app.name') }}</h1>

<hr>
<h2><a href="">Titre de l'article</a></h2>
<small>Source: soucename, par: athorname, 17-11-1993</small>
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Labore earum eaque laudantium facere nihil eligendi aliquid sint alias recusandae odio. Voluptatum sint tenetur, animi molestias ullam distinctio hic rem magni.</p>
<a href="">Voir le pdf</a>

@component('mail::button', ['url' => 'https://app.dev/home'])
Accéder au portail
@endcomponent

Merci,
{{ config('app.name') }}
@endcomponent
