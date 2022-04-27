@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-11"><h1>{{ $ad->title }}</h1></div>
                            <div class="col-1">
                                <a href="{{ route('ad.edit', $ad->id) }}">Edit</a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <img src="{{ $ad->image }}" alt="" class="img-fluid">
                            </div>
                            <div class="col-6">
                                <p>{{ $ad->content }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="details">
                            <h2>Description</h2>
                            <ul>
                                <li>{{ $ad->price }}</li>
                                <li>{{ $ad->year }}</li>
                                <li>{{ $ad->vin }}</li>
                                <li>{{ $ad->color->name }}</li>
                                <li>{{ $ad->type->name }}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="details">
                            <h2>Contact seller</h2>
                            <ul>
                                <li>{{ $ad->user->name }}</li>
                                <li>{{ $ad->user->email }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('comment.store') }}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Write your comment</label>
                        <input type="hidden" name="ad_id" value="{{ $ad->id }}">
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="content"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Comment</button>
                </form>
            </div>
            <div class="col-8 pt-1">
                <div class="list-group">
                    @foreach($ad->comments as $comment)
                        <div class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $comment->user->name }}</h5>
                                <small class="text-muted">{{ $comment->created_at }}</small>
                            </div>
                            <p class="mb-1">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
