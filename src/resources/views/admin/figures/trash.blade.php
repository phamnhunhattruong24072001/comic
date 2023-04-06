@extends('admin.admin_layout')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.comic.list') }}"
                       class="btn btn-primary rounded-0">{{ __('common.button.list') }}</a>
                    <button type="button" data-url="{{ route('admin.comic.restore') }}"
                            class="btn btn-info rounded-0 restore-multiple">{{ __('common.button.restore') }}</button>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box table-responsive">
                            <table id="datatable-checkbox" class="table table-striped table-bordered bulk_action"
                                   style="width:100%">
                                <thead>
                                <tr>
                                    <th>
                                        <label>
                                            <input type="checkbox" id="check-all">
                                        </label>
                                    </th>
                                    <th>{{ __('comic.name') }}</th>
                                    <th>{{ __('comic.name_another') }}</th>
                                    <th>{{ __('common.slug') }}</th>
                                    <th>{{ __('common.action') }}</th>
                                </tr>
                                </thead>


                                <tbody>
                                @foreach ($comics as $comic)
                                    <tr>
                                        <td>
                                            <label><input type="checkbox" class="check-item" value="{{ $comic->id }}"></label>
                                        </td>
                                        <td>{{ $comic->name }}</td>
                                        <td>{{ $comic->name_another }}</td>
                                        <td>{{ $comic->slug }}</td>
                                        <td>
                                            <div class="content-button">
                                                @can(\App\Models\comic::RESTORE)
                                                    <form action="{{ route('admin.comic.restore')}}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $comic->id }}">
                                                        <button class="btn-sm btn-info" title="{{ __('common.button.restore') }}" type="submit"><i class="fa fa-backward"></i></button>
                                                    </form>
                                                @endcan

                                                @can(\App\Models\comic::FORCE_DELETE)
                                                    <form action="{{ route('admin.comic.force-delete') }}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $comic->id }}">
                                                        <button class="btn-sm btn-danger" title="" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
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
