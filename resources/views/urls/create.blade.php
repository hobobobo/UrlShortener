@extends('layout')

@section('content')
    <form method="post" action={{ route('url.store') }} novalidate="novalidate">
        @csrf
        @include ('partials.errorList')
        <div class="control-group">
            <div class="form-group floating-label-form-group controls mb-0 pb-2">
                <label for="url">URL</label>
                <input class="form-control"
                       id="url"
                       name="url"
                       type="text"
                       value="{{ old('url') }}"
                       placeholder="http://"
                >
            </div>
        </div>
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ route('url.short', ['short_url' => session('success') ]) }}
                <a href="{{ route('url.short', ['short_url' => session('success') ]) }}"
                   target="_blank">{{ __('messages.link') }}</a>
            </div>
        @else
            <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">{{ __('Send') }}</button>
            </div>
        @endif
    </form>
@endsection
