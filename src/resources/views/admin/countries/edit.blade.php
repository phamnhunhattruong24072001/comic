@extends('admin.admin_layout')

@section('title', __('country.update_title'))

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/build/css/main.css') }}">
@endpush

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('country.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.country.update', ['id' => $country->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.countries.form', ['data' => $country, 'buttonSubmit' => __('common.button.update')])
            </form>
        </div>
    </div>
@endsection
