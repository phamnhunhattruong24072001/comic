@extends('admin.admin_layout')

@section('title', __('user.update_title'))

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/build/css/main.css') }}">
@endpush

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('user.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            @include('admin.users.form', ['data' => $user, 'buttonSubmit' => __('common.button.update')])
        </div>
    </div>
@endsection
