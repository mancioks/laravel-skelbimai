@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2>Naujausi skelbimai</h2>
            @foreach($new_ads as $ad)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"><h5 class="card-title">{{ $ad->title }}</h5></div>
                        <div class="card-body">
                            <img class="card-img-top" src="{{ $ad->image }}" alt="Card image cap">
                        </div>
                        <div class="card-footer">
                            {{ $ad->price }}€ <a href="{{ route('ad.show', $ad->id) }}" class="btn btn-primary float-end">Rodyti</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <h2>Populiariausi skelbimai</h2>
            @foreach($popular_ads as $ad)
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-header"><h5 class="card-title">{{ $ad->title }}</h5></div>
                        <div class="card-body">
                            <img class="card-img-top" src="{{ $ad->image }}" alt="Card image cap">
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
