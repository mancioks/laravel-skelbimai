@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="filter mb-3">
            <div class="dropdown d-inline-block">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Automobiliai pagal marke
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    @foreach($manufacturers as $manufacturer)
                        <li>
                            <a class="dropdown-item @if($manufacturer->id == $request->get('manufacturer')) bg-info @endif"
                               href="{{ route('ad.index', ['manufacturer' => $manufacturer->id]) }}">
                                {{ $manufacturer->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            @if($request->get('manufacturer'))
                <a href="{{ route('ad.index') }}" class="text-danger small m-lg-2">Išvalyti filtrus</a>
            @endif
        </div>
        <div class="row">
            <div class="ads-pagination">
                {{ $ads->links('pagination::bootstrap-5') }}
            </div>
        </div>
        <div class="row">
            @forelse($ads as $ad)
                <div class="col-md-4 mb-4">
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
            @empty
                <div class="alert alert-warning" role="alert">
                    Pagal pasirinkta kriteriju skelbimu nera
                </div>
            @endforelse
        </div>
        <div class="row">
            <div class="ads-pagination">
                {{ $ads->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
@endsection
