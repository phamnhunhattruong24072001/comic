@extends('admin.admin_layout')

@section('title', __('figure.list_title'))

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('figure.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.figure.create') }}" class="btn-sm btn-primary rounded-0">{{ __('common.button.create') }}</a>
                    <a href="{{ route('admin.figure.trash') }}" class="btn-sm btn-secondary rounded-0">{{ __('common.button.trash') }}</a>
                    <a class="btn-sm btn-danger rounded-0 delete-multiple" data-url="{{route('admin.comic.delete')}}" data-action="delete">{{ __('common.button.delete') }}</a>
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
                                        <th>{{ __('figure.avatar') }}</th>
                                        <th>{{ __('figure.comic') }}</th>
                                        <th>{{ __('figure.name') }}</th>
                                        <th>{{ __('figure.status') }}</th>
                                        <th>{{ __('common.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($figures as $figure)
                                        <tr>
                                            <td>
                                                <label><input type="checkbox" class="check-item" value="{{ $figure->id }}"></label>
                                            </td>
                                            <td><img src="{{ asset(showFile($figure->avatar)) }}" width="50"></td>
                                            <td>
                                                @foreach($figure->comics->pluck('name')->toArray() as $comic)
                                                    <span class="badge badge-dark">{{ $comic }}</span>
                                                @endforeach
                                            </td>
                                            <td>{{ $figure->name }}</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="js-switch switch-status" data-id="{{$figure->id}}" data-url="{{route('admin.figure.status')}}"
                                                           @if($figure->is_visible == config('const.activate.on')) checked @endif value="{{$figure->is_visible}}"/>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="content-button">
                                                    @can(\App\Models\Figure::UPDATE)
                                                        <a href="{{ route('admin.figure.edit', $figure->id) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    @endcan

                                                    @can(\App\Models\Figure::DELETE)
                                                        <form action="{{ route('admin.figure.delete')}}" method="post" class="form-button">
                                                            @csrf
                                                            <input type="hidden" name="id[]" value="{{ $figure->id }}">
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
                                        {{ $figures->links('vendor/pagination/page') }}
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
