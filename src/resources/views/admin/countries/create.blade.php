@extends('admin.admin_layout')

@section('title', __('country.create_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('country.create_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form action="{{ route('admin.country.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @include('admin.countries.form', ['buttonSubmit' => __('common.button.create')])
            </form>
        </div>
    </div>
@endsection
