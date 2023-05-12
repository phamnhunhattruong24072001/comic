@extends('admin.admin_layout')

@section('title', __('user.list_title'))

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.users.create') }}" class="btn-sm btn-primary rounded-0">{{ __('common.button.create') }}</a>
                    <a href="{{ route('admin.users.trash') }}" class="btn-sm btn-secondary rounded-0">{{ __('common.button.trash') }}</a>
                    <a class="btn-sm btn-danger rounded-0 delete-multiple" data-url="{{route('admin.users.delete')}}" data-action="delete">{{ __('common.button.delete') }}</a>
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
                                        <th>{{ __('user.avatar') }}</th>
                                        <th>{{ __('user.name') }}</th>
                                        <th>{{ __('user.username') }}</th>
                                        <th>{{ __('user.email') }}</th>
                                        <th>{{ __('user.birth_day') }}</th>
                                        <th>{{ __('user.status') }}</th>
                                        <th>{{ __('common.action') }}</th>
                                    </tr>
                                </thead>


                                <tbody>
                                    @foreach ($users as $user)
                                       <tr>
                                          <td>
                                            <label><input type="checkbox" class="check-item" value="{{ $user->id }}"></label>
                                          </td>
                                          <td><img src="{{ asset(showFile($user->avatar)) }}" alt="" width="50" height="50"></td>
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->username }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ formatDate($user->day_of_birth, app('systemLanguage')) }}</td>
                                          <td>
                                              <label>
                                                  <input type="checkbox" class="js-switch switch-status" data-id="{{$user->id}}" data-url="{{route('admin.users.status')}}" @if($user->is_visible == config('const.admin.status.active')) checked @endif value="{{$user->is_visible}}"/>
                                              </label>
                                          </td>
                                          <td>
                                              <div class="content-button">
                                                  @if(is_admin())
                                                      <a href="{{ route('admin.users.permission', ['id' => $user->id]) }}" class="btn-sm btn-primary" title=""><i class="fa fa-users" aria-hidden="true"></i></a>
                                                  @endif
                                                      &nbsp;
                                                  @can(\App\Models\User::UPDATE)
                                                      <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                  @endcan

                                                  @can(\App\Models\User::DELETE)
                                                      <form action="{{ route('admin.users.delete')}}" method="post" class="form-button">
                                                          @csrf
                                                          <input type="hidden" name="id[]" value="{{ $user->id }}">
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
                                        {{ $users->links('vendor/pagination/page') }}
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
