@extends('admin.admin_layout')

@section('title', 'Dashboard')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/build/css/permission.css') }}">
@endpush

@section('content')
    <h2>Phân quyền cho <b>{{$user->name}}</b></h2>
    <form action="{{ route('admin.users.create_permission', $user->id) }}" method="post">
        @csrf
        <div class="row">
            @foreach ($permissions as $permission)
                <div class="col-md-3 widget widget_tally_box">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>{{ $permission->name }}</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                               <div class="child-content-permission">
                                    <div class="checkbox checkbox-permission">
                                        <label>
                                            <input type="checkbox" class="flat" checked="checked">
                                        </label>
                                        <span>Tất cả</span>
                                    </div>
                               </div>
                            @foreach ($permission->permissionChildrent as $child)
                                    <div class="child-content-permission">
                                        <div class="checkbox checkbox-permission">
                                            <label>
                                                <input type="checkbox" class="flat" name="id_permissions[]" value="{{ $child->id }}" {{ isset($permissionUserChecked) ? $permissionUserChecked->contains('id', $child->id) ? 'checked' : '' : '' }}>
                                            </label>
                                            <span>{{ $child->name }}</span>
                                        </div>
                                    </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-lg-12">
                <button class="btn btn-primary" type="submit">Phân quyền</button>
            </div>
        </div>
    </form>
@endsection
