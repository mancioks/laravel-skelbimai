@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Naujausi skebimai</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        @foreach($ads as $ad)
                            <div class="col-4">
                                <div class="card">
                                    <img class="card-img-top" src="{{ $ad->image }}" alt="Card image cap">
                                    <div class="card-body">
                                        <h5 class="card-title">{{ $ad->title }}</h5>
                                        <p class="card-text">{{ $ad->content }}</p>
                                        <a href="{{ route('ad.show', $ad->id) }}" class="btn btn-primary">Rodyti</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
