@extends('layouts.app')

@section('content')
    <div class="row row-margin-5 hidden-word text-center">
        @foreach($game->getHiddenWord()->getCurrentLetters() as $letter)
            <span class="hidden-word-letter">{{ $letter->toString() }}</span>
        @endforeach
    </div>

    <div class="row row-margin-50">
        <div class="col-md-12">
            <form method="POST" action="/guess/make" class="form-horizontal">
                <div class="form-group form-group-lg {{ count($errors) ? 'has-error' : '' }}">
                    <div class="col-sm-10">
                        {{ csrf_field() }}

                        <input class="form-control" type="text" name="letter_or_word"
                               value="{{ old('letter_or_word') }}"
                               placeholder="Letter or the entire word"
                               autofocus="autofocus"
                               {{ $game->isOver() ? 'disabled' : '' }}
                        />

                        @include('partials.form.element.errors')
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg"
                            {{ $game->isOver() ? 'disabled' : '' }}
                    >Guess</button>
                </div>
            </form>
        </div>
    </div>

    <div class="row row-margin-50">
        <div class="col-md-6">
            <a href="/game/restart" type="button" class="btn btn-default">Restart</a>
        </div>

        <div class="col-md-6">
            <button class="btn btn-default pull-right" type="button" data-toggle="collapse"
                    data-target="#game-rules-text" aria-expanded="false" aria-controls="game-rules-text"
            >Rules</button>
        </div>
    </div>

    <div class="row row-margin-10">
        <div class="col-md-12">
            <div class="collapse" id="game-rules-text">
                <div class="well">
                    <p>At the start of a game, the player is given a finite number of lives (represented by hearts in the upper right corner).</p>
                    <p>The task is to correctly guess a hidden word. The word to guess is represented by a row of dashes, representing each letter of the word. If the guessing player suggests a letter which occurs in the word, the computer writes it in all its correct positions. If the suggested letter or number does not occur in the word, the player loses one life. When the last life is lost, the game is over.</p>
                    <p>The player guessing the word may, at any time, attempt to guess the whole word. If the word is correct, the game is over and the guesser wins. Otherwise, the player loses a life.</p>
                </div>
            </div>
        </div>
    </div>
@endsection