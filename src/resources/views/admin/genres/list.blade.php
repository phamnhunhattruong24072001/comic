@extends('admin.admin_layout')

@section('title', __('genre.list_title'))

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.genre.create') }}" class="btn-sm btn-primary rounded-0">{{ __('common.button.create') }}</a>
                    <a href="{{ route('admin.genre.trash') }}" class="btn-sm btn-secondary rounded-0">{{ __('common.button.trash') }}</a>
                    <a class="btn-sm btn-danger rounded-0 delete-multiple" data-url="{{route('admin.genre.delete')}}" data-action="delete">{{ __('common.button.delete') }}</a>
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
                                    <th>{{ __('genre.name') }}</th>
                                    <th>{{ __('genre.name_another') }}</th>
                                    <th>{{ __('common.slug') }}</th>
                                    <th>{{ __('genre.status') }}</th>
                                    <th>{{ __('common.action') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($genres as $genre)
                                    <tr>
                                        <td>
                                            <label><input type="checkbox" class="check-item" value="{{ $genre->id }}"></label>
                                        </td>
                                        <td>{{ $genre->name }}</td>
                                        <td>{{ $genre->name_another }}</td>
                                        <td>{{ $genre->slug }}</td>
                                        <td>
                                            <label>
                                                <input type="checkbox" class="js-switch switch-status" data-id="{{$genre->id}}" data-url="{{route('admin.genre.status')}}"
                                                       @if($genre->is_visible == config('const.activate.on')) checked @endif value="{{$genre->is_visible}}"/>
                                            </label>
                                        </td>
                                        <td>
                                            <div class="content-button">
                                                @can(\App\Models\Genre::UPDATE)
                                                    <a href="{{ route('admin.genre.edit', $genre->id) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                @endcan

                                                @can(\App\Models\Genre::DELETE)
                                                    <form action="{{ route('admin.genre.delete')}}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $genre->id }}">
                                                        <button class="btn-sm btn-danger button-delete" title="" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
