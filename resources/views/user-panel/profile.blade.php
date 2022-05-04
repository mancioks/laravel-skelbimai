@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Profile') }}</div>

                    <div class="card-body">

                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->email }}</p>
                            <p class="card-text">Registered at: {{ $user->created_at }}</p>
                        </div>

                        <a href="{{ route('profile.edit') }}" class="btn btn-primary">Edit profile</a>

                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
