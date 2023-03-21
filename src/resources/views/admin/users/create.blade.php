@extends('admin.admin_layout')

@section('title', __('user.create_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('user.create_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
             @include('admin.users.form', ['data' => 1]);
        </div>
    </div>
@endsection
