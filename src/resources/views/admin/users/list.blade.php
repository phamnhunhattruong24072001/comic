@extends('admin.admin_layout')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-primary rounded-0">{{ __('common.button.create') }} <i class="fa fa-plus"></i></a>
                    <a href="{{ route('admin.users.trash') }}" class="btn btn-secondary rounded-0">{{ __('common.button.trash') }} <i class="fa fa-trash-o"></i></a>
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
                                        <th><input type="checkbox" id="check-all"></th>
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
                                          <th><input type="checkbox" id="check-all"></th>
                                          </td>
                                          <td><img src="{{ asset('storage/'.showFile($user->avatar)) }}" alt="" width="50" height="50"></td>
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->username }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ $user->day_of_birth }}</td>
                                          <td>
                                              <label>
                                                  <input type="checkbox" class="js-switch switch-status" data-id="{{$user->id}}" data-url="{{route('admin.users.status')}}" @if($user->is_visible == config('const.admin.status.active')) checked @endif value="{{$user->is_visible}}"/>
                                              </label>
                                          </td>
                                          <td>
                                              @if(is_admin())
                                                  <a href="{{ route('admin.users.permission', ['id' => $user->id]) }}" class="btn-sm btn-primary" title=""><i class="fa fa-users" aria-hidden="true"></i></a>
                                              @endif

                                              @can(\App\Models\User::UPDATE)
                                                  <a href="{{ route('admin.users.edit', ['id' => $user->id]) }}" class="btn-sm btn-warning" title=""><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                              @endcan

                                              @can(\App\Models\User::DELETE)
                                                  <form action="{{ route('admin.users.delete')}}" method="post" class="d-inline">
                                                      @csrf
                                                      <input type="hidden" name="id[]" value="{{ $user->id }}">
                                                      <button class="btn-sm btn-danger" title="" type="submit"><i class="fa fa-trash" aria-hidden="true"></i></button>
                                                  </form>
                                              @endcan
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

@push('script')
    <script>
        $('.switch-status').on('click', function (){
           let id = $(this).data('id');
           let is_visible = $(this).val();
           let url = $(this).data('url');

        });
    </script>
@endpush
