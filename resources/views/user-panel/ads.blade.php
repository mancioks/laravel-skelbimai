@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <table class="table table-dark">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Views</th>
                    <th scope="col">Active</th>
                    <th scope="col">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ads as $ad)
                    <tr>
                        <th scope="row">{{ $ad->id }}</th>
                        <td>{{ $ad->title }}</td>
                        <td>{{ $ad->views }}</td>
                        <td>{{ $ad->active }}</td>
                        <td><a href="{{ route('ad.edit', $ad->id) }}">Edit</a></td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
