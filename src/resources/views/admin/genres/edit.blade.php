@extends('admin.admin_layout')

@section('title', __('category.update_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('category.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.category.update', ['id' => $category->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.categories.form', ['data' => $category, 'buttonSubmit' => __('common.button.update')])
            </form>
        </div>
    </div>
@endsection
