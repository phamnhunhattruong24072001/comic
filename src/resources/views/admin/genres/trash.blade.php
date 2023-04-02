@extends('admin.admin_layout')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.genre.list') }}"
                       class="btn btn-primary rounded-0">{{ __('common.button.list') }}</a>
                    <button type="button" data-url="{{ route('admin.genre.restore') }}"
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
                                    <th>{{ __('genre.name') }}</th>
                                    <th>{{ __('common.slug') }}</th>
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
                                        <td>{{ $genre->slug }}</td>
                                        <td>
                                            <div class="content-button">
                                                @can(\App\Models\genre::RESTORE)
                                                    <form action="{{ route('admin.genre.restore')}}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $genre->id }}">
                                                        <button class="btn-sm btn-info" title="{{ __('common.button.restore') }}" type="submit"><i class="fa fa-backward"></i></button>
                                                    </form>
                                                @endcan

                                                @can(\App\Models\genre::FORCE_DELETE)
                                                    <form action="{{ route('admin.genre.force-delete') }}" method="post" class="form-button">
                                                        @csrf
                                                        <input type="hidden" name="id[]" value="{{ $genre->id }}">
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
