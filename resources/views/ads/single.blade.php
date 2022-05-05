@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-11 position-relative">
                                <h1 class="d-inline-block">{{ $ad->title }}</h1>
                                <a class="float-end d-inline-block" href="{{ route('ad.memorise', $ad->id) }}">
                                    @if($memorised)
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart-fill" viewBox="0 0 16 16">
                                            <path d="M4 1c2.21 0 4 1.755 4 3.92C8 2.755 9.79 1 12 1s4 1.755 4 3.92c0 3.263-3.234 4.414-7.608 9.608a.513.513 0 0 1-.784 0C3.234 9.334 0 8.183 0 4.92 0 2.755 1.79 1 4 1z"/>
                                        </svg>
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-suit-heart" viewBox="0 0 16 16">
                                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595L8 6.236zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.55 7.55 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                        </svg>
                                    @endif
                                </a>
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
                                <li><a href="{{ route('messages.create-conversation', $ad->user->id) }}">Message seller</a></li>
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
                    @foreach($comments as $comment)
                        <div class="list-group-item flex-column align-items-start">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $comment->user->name }}</h5>
                                <small class="text-muted">{{ $comment->created_at }}</small>
                            </div>
                            <p class="mb-1">{{ $comment->content }}</p>
                        </div>
                    @endforeach
                </div>
                <div class="ads-pagination">
                    {!! $comments->links('pagination::bootstrap-5') !!}
                </div>
            </div>
        </div>
    </div>

@endsection
