@extends('admin.admin_layout')

@section('title', __('genre.update_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('genre.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.genre.update', ['id' => $genre->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @include('admin.genres.form', ['buttonSubmit' => __('common.button.update')])
            </form>
        </div>
    </div>
@endsection
