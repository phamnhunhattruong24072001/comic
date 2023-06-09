@extends('admin.admin_layout')

@section('title', __('chapter.list_title'))

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('chapter.list_title') }} |<small>{{ $comic->name }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.chapter.create', $comic->slug) }}" class="btn-sm btn-primary rounded-0">{{ __('common.button.create') }}</a>
                    <a href="{{ route('admin.chapter.trash', $comic->slug) }}" class="btn-sm btn-secondary rounded-0">{{ __('common.button.trash') }}</a>
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
                                    <th>{{ __('chapter.comic') }}</th>
                                    <th>{{ __('chapter.name').' / '.__('chapter.title') }}</th>
                                    <th>{{ __('chapter.number_chapter') }}</th>
                                    <th>{{ __('chapter.status') }}</th>
                                    <th>{{ __('common.action') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($chapters as $chapter)
                                        <tr>
                                            <td>
                                                <label><input type="checkbox" class="check-item" value="{{ $chapter->id }}"></label>
                                            </td>
                                            <td><img src="{{ asset(showFile($chapter->comic->thumbnail)) }}" width="50"></td>
                                            <td>{{ $chapter->comic->name }}</td>
                                            <td>{{ $chapter->name.' / '.$chapter->title }}</td>
                                            <td>{{ $chapter->number_chapter }}</td>
                                            <td>
                                                <label>
                                                    <input type="checkbox" class="js-switch switch-status" data-id="{{$chapter->id}}" data-url="{{ route('admin.chapter.status') }}"
                                                           @if($chapter->is_visible == config('const.activate.on')) checked @endif value="{{$chapter->is_visible}}"/>
                                                </label>
                                            </td>
                                            <td>
                                                <div class="content-button">
                                                    @can(\App\Models\Genre::UPDATE)
                                                        <a href="{{ route('admin.chapter.edit', $chapter->id) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                    @endcan

                                                    @can(\App\Models\Genre::DELETE)
                                                        <form action="{{ route('admin.chapter.delete')}}" method="post" class="form-button">
                                                            @csrf
                                                            <input type="hidden" name="id[]" value="{{ $chapter->id }}">
                                                            <button class="btn-sm btn-danger button-delete" title="" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                        </form>
                                                    @endcan
                                                        <a href="{{ route('admin.chapter.edit_image', $chapter->id) }}" class="btn-sm btn-info" title=""><i class="fa fa-image" aria-hidden="true"></i></a>
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
                                        {{ $chapters->links('vendor/pagination/page') }}
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
