@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @foreach($ads as $ad)
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header"><h5 class="card-title">{{ $ad->title }}</h5></div>
                        <div class="card-body">
                            <img class="card-img-top" src="{{ $ad->image }}" alt="Card image cap">
                            <div class="card-body">
                                <p class="card-text">{{ $ad->content }}</p>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ $ad->price }}€ <a href="{{ route('ad.show', $ad->id) }}" class="btn btn-primary float-end">Rodyti</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
