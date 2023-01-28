@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <div class="card text-center size-index" style="min-height: 500px">

                    @if (session('flash_message'))
                        <div class="confetti">
                            <p class="confetti-message">Success matched check your matches list</p>
                            <div class="d-flex text-center confetti-btn">
                                <a href="{{ url('/users/matches') }}" class="btn btn-primary" style="border-radius: 25px">Check Matche(s)</a>
                            </div>
                        </div>
                        <div class="flash_message bg-success text-center py-3 my-0 match" style="position: absolute;width: 100%;">
                            {{ session('flash_message') }}
                        </div>
                    @endif


                    <div class="card-body index">
                        @includeWhen(isset($user), 'users.matching_form')
                    </div>
                    <div class="card-footer">

                        <div class="row mt-1 justify-content-center align-items-center text-center" style="height:70px">

                            <div class="col-6">
                                <form action="{{ route('users.store', $user) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                                    <input type="hidden" name="is_like" value="0">
                                    <button class="tno rounded-circle bg-white p-3 px-4 dislike" type="submit">
                                        <i class="fa-solid fa-thumbs-down" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>


                            <div class="col-6">

                                <form action="{{ route('users.store', $user) }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="to_user_id" value="{{ $user->id }}">
                                    <input type="hidden" name="from_user_id" value="{{ Auth::id() }}">
                                    <input type="hidden" name="is_like" value="1">
                                    <button class="tyes rounded-circle bg-white p-3 like" type="submit" >
                                        <i class="fa fa-heart" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection