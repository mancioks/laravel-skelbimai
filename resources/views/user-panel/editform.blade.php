@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit profile') }}</div>

                    <div class="card-body">

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form class="form" method="post" action="{{ route('profile.update') }}">
                            @csrf
                            @method('put')
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="Vardas" value="{{ $user->name }}">
                                <input type="text" name="email" class="form-control" placeholder="Email" value="{{ $user->email }}">
                                <input type="submit" value="Redaguoti" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
