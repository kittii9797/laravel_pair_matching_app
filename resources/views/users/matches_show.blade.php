@extends('layouts.app')

@section('content')
    <div class="container" style="margin-top: -60px">
    <img src="{{ asset($main_user->img_url) }}" class="mx-auto circle-img-matched" alt="{{ $main_user->name }}">

        <div class="row justify-content-center">
            <div class="card text-center size" style="">
                
                <div class="card-body">
                    <h3 class="card-title" style="margin-top:85px">{{ $main_user->name }}</h3>
                    <p class="card-text">{{ $main_user->email }}</p>
                </div>
                <div class="card-footer">
                    <!-- <a href="{{ route('users.room', $main_user->id) }}" class="btn btn-primary">get in touch</a> -->
                    <a href="{{ route('users.matches') }}" class="btn btn-primary" style="border-radius: 25px;margin: 10px 0px;">Show Dashboard</a>
                </div>
            </div>
        </div>

        <div class="d-flex flex-column mt-5">

            <div class="d-flex justify-content-center flex-wrap">
                @foreach ($match_users as $key => $user)
                    <a class="btn border-light mb-2 @if ($num == $key) btn-dark  @endif"
                        href="{{ route('users.matches_show', $key) }}" style="margin: 0px 5px; box-shadow: 0 5px 10px rgb(0 0 0 / 10%); border-radius: 50px;">
                        {{ $key + 1 }}</a>
                @endforeach
            </div>
            <div class="d-flex justify-content-center mt-2">
                <a class="btn"
                    href="{{ route('users.matches_show', $prev) }}"><i class='fas fa-angle-left'></i></a>
                <a class="btn" href="{{ route('users.matches_show', $next) }}"><i class='fas fa-angle-right'></i></a>
            </div>

        </div>

    </div>
@endsection