@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 d-flex justify-content-center">
            <div class="card size-matches">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    <div class="row">
                        @foreach ($users as $key => $user)
                            <div class="col-12 mb-3">
                                <img src="{{ asset($user->img_url) }}" class="rounded-circle" height="80px" width="80px" alt="" style="object-fit: cover" >
                                <a href="{{ route('users.matches_show',$key) }}" class="ml-3" style="font-size:15px;margin-left:20px">
                                    {{ $user->name }}
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection