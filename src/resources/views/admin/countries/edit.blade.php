@extends('admin.admin_layout')

@section('title', __('country.update_title'))

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('country.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.country.update', ['id' => $country->id]) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                @include('admin.countries.form', ['buttonSubmit' => __('common.button.update')])
            </form>
        </div>
    </div>
@endsection
