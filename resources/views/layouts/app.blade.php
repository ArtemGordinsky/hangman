<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Hangman</title>

        <!-- Fonts -->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.1/css/font-awesome.min.css" rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Vast+Shadow" rel="stylesheet" type="text/css">
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body id="app-layout">
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">HANGMAN</a>
            </div>

            <div class="player-lives pull-right" title="{{ $game->getPlayer()->getNumLivesRemaining() }} lives left">
                @for ($spentLivesIterator = 0; $spentLivesIterator < ($game->getPlayer()->getNumLivesInitial() - $game->getPlayer()->getNumLivesRemaining()); $spentLivesIterator++)
                    <i class="player-lives-heart fa fa-heart-o"></i>
                @endfor
                @for ($remainingLivesIterator = 0; $remainingLivesIterator < $game->getPlayer()->getNumLivesRemaining(); $remainingLivesIterator++)
                    <i class="player-lives-heart fa fa-heart"></i>
                @endfor
            </div>
        </div>
    </nav>

    <div class="container">
        @include('partials.flash')

        <div class="col-md-6 col-md-offset-3">
            @yield('content')
        </div>
    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>
</html>
