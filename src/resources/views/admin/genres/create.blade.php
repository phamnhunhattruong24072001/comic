@extends('admin.admin_layout')

@section('title', __('genre.create_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('genre.create_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.genre.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.genres.form', ['data' => $genre, 'buttonSubmit' => __('common.button.create')])
            </form>
        </div>
    </div>
@endsection
