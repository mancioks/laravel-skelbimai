@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($memorised as $memorisedAd)
                    <tr>
                        <th scope="row">{{ $memorisedAd->ad->id }}</th>
                        <td>{{ $memorisedAd->ad->title }}</td>
                        <td>{{ $memorisedAd->ad->price }}</td>
                        <td>
                            <a href="{{ route('ad.show', $memorisedAd->ad->id) }}">View</a>
                            <a href="{{ route('ad.memorise', $memorisedAd->ad->id) }}">Remove from list</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
