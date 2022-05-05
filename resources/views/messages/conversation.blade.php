@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $conversation->title }}</div>
                    <div class="card-body">

                        <div class="list-group d-block">
                            @foreach($conversation->messages as $message)
                                <div class="list-group-item w-75 d-inline-block mb-2 border-1 rounded-3 @if($message->user->id == auth()->id()) float-end bg-info @endif">
                                    <div>
                                        <h5 class="mb-1 d-inline-block">{{ $message->user->name }}</h5>
                                        <small class="text-muted d-inline-block float-end">{{ $message->created_at }}</small>
                                    </div>
                                    <p class="mb-1">{{ $message->message }}</p>
                                </div>
                            @endforeach
                            @if($conversation->messages->last()->sender_id == auth()->id())
                                <div class="list-group-item w-75 d-inline-block mb-0 border-0 rounded-0 float-end bg-transparent text-end p-0 text-muted fw-bold">
                                    {{ $seen }}
                                </div>
                            @endif
                        </div>
                    </div>

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

                        <form action="{{ route('messages.store-message', $conversation->id) }}" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" rows="3" name="message">{{ old('message') }}</textarea>
                            </div>
                            <div class="mb-3">
                                <input type="submit" value="Reply" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
