@extends('admin.admin_layout')

@section('title', __('comic.list_title'))

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('comic.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.comic.create') }}" class="btn-sm btn-primary rounded-0">{{ __('common.button.create') }}</a>
                    <a href="{{ route('admin.comic.trash') }}" class="btn-sm btn-secondary rounded-0">{{ __('common.button.trash') }}</a>
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
                                    <th>{{ __('comic.thumbnail') }}</th>
                                    <th>{{ __('comic.name') }}</th>
                                    <th>{{ __('comic.name_another') }}</th>
                                    <th>{{ __('common.slug') }}</th>
                                    <th>{{ __('comic.status') }}</th>
                                    <th>{{ __('common.action') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($comics as $comic)
                                    <tr>
                                        <td>
                                            <label><input type="checkbox" class="check-item" value="{{ $comic->id }}"></label>
                                        </td>
                                        <td><img src="{{ asset(showFile($comic->thumbnail)) }}" width="50"></td>
                                        <td>{{ $comic->name }}</td>
                                        <td>{{ $comic->name_another }}</td>
                                        <td>{{ $comic->slug }}</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" class="js-switch switch-status" data-id="{{$comic->id}}" data-url="{{route('admin.comic.status')}}"
                                                       @if($comic->is_visible == config('const.activate.on')) checked @endif value="{{$comic->is_visible}}"/>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="content-button">
                                                @can(\App\Models\Genre::UPDATE)
                                                    <a href="{{ route('admin.comic.edit', $comic->id) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                @endcan

                                                @can(\App\Models\Genre::DELETE)
                                                    <form action="{{ route('admin.comic.delete')}}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $comic->id }}">
                                                        <button class="btn-sm btn-danger button-delete" title="" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                @endcan
                                                    <a href="{{ route('admin.chapter.list', $comic->slug) }}" class="btn-sm btn-secondary" title=""><i class="fa fa-bars"></i></a>&nbsp;
                                                    <a href="{{ route('admin.chapter.create', $comic->slug) }}" class="btn-sm btn-info" title=""><i class="fa fa-plus"></i></a>
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
                                        {{ $comics->links('vendor/pagination/page') }}
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
