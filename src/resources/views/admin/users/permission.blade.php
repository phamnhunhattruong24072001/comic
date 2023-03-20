@extends('admin.admin_layout')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/build/css/permission.css') }}">
@endpush

@section('content')
    <form action="">
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-3 widget widget_tally_box">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $permission->name }}</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <div class="checkbox mt-1">
                                    <label>
                                        <input type="checkbox" class="flat" checked="checked">
                                    </label>
                                </div>
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </form>
@endsection
