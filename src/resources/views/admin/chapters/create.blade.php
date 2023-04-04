@extends('admin.admin_layout')

@section('title', __('comic.create_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('comic.create_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.chapter.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @include('admin.chapters.form', ['data' => $comic, 'chapter' => $chapter, 'is_list' => $is_list,'buttonSubmit' => __('common.button.create')])
            </form>
        </div>
    </div>
@endsection
