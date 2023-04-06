@extends('admin.admin_layout')

@section('title', __('user.update_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('user.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @include('admin.users.form', ['buttonSubmit' => __('common.button.update')])
            </form>
        </div>
    </div>
@endsection
