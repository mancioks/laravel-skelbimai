@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Messages') }}</div>

                    <div class="card-body">
                        <a href="{{ route('messages.create-conversation') }}" class="btn btn-primary">New conversation</a>
                        <div class="card-body">
                            <h5 class="card-title">Conversations</h5>
                            <div class="list-group">
                                @foreach($conversations as $conversation)
                                    <a href="{{ route('messages.show-conversation', $conversation->id) }}" class="list-group-item flex-column align-items-start mb-2 border-1 rounded-3">
                                        <div class="d-flex w-100 justify-content-between">
                                            <h5 class="mb-1">{{ $conversation->title }}</h5>
                                            <small class="text-muted">{{ $conversation->created_at }}</small>
                                        </div>
                                        <p class="mb-1">{{ $conversation->messages->last()->message }}</p>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
