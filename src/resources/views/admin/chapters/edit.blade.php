@extends('admin.admin_layout')

@section('title', __('chapter.update_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('chapter.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.chapter.update', $chapter->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @include('admin.chapters.form', ['buttonSubmit' => __('common.button.update')])
            </form>
        </div>
    </div>
@endsection
