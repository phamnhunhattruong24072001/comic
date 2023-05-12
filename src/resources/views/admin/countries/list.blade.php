@extends('admin.admin_layout')

@section('title', __('country.list_title'))

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.country.create') }}" class="btn-sm btn-primary rounded-0">{{ __('common.button.create') }}</a>
                    <a href="{{ route('admin.country.trash') }}" class="btn-sm btn-secondary rounded-0">{{ __('common.button.trash') }}</a>
                    <a class="btn-sm btn-danger rounded-0 delete-multiple" data-url="{{route('admin.country.delete')}}" data-action="delete">{{ __('common.button.delete') }}</a>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table class="table table-striped table-bordered bulk_action"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" id="check-all">
                                        </label>
                                    </th>
                                    <th>{{ __('country.avatar') }}</th>
                                    <th>{{ __('country.name') }}</th>
                                    <th>{{ __('country.name_another') }}</th>
                                    <th>{{ __('country.status') }}</th>
                                    <th>{{ __('common.action') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($countries as $country)
                                    <tr>
                                        <td>
                                            <label><input type="checkbox" class="check-item" value="{{ $country->id }}"></label>
                                        </td>
                                        <td><img src="{{ $country->avatar }}" alt="" width="50" height="50"></td>
                                        <td>{{ $country->name }}</td>
                                        <td>{{ $country->another_name }}</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" class="js-switch switch-status" data-id="{{$country->id}}" data-url="{{route('admin.country.status')}}"
                                                       @if($country->is_visible == config('const.activate.on')) checked @endif value="{{$country->is_visible}}"/>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="content-button">
                                                @can(\App\Models\Country::UPDATE)
                                                    <a href="{{ route('admin.country.edit', $country->id) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                @endcan

                                                @can(\App\Models\Country::DELETE)
                                                    <form action="{{ route('admin.country.delete')}}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $country->id }}">
                                                        <button class="btn-sm btn-danger button-delete" title="" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-lg-6">

                                </div>
                                <div class="col-sm-6">
                                    <div class="pull-right">
                                        {{ $countries->links('vendor/pagination/page') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
