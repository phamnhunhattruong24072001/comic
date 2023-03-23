@extends('admin.admin_layout')

@section('title', 'Dashboard')

@section('content')
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>{{ __('user.list_title') }}</small></h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#"></a>
                            <a class="dropdown-item" href="#">Settings 2</a>
                        </div>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
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
                                          <td>{{ $user->name }}</td>
                                          <td>{{ $user->username }}</td>
                                          <td>{{ $user->email }}</td>
                                          <td>{{ $user->day_of_birth }}</td>
                                          <td>{{ $user->is_visible }}</td>
                                          <td>
                                                <a href="" class="btn-sm btn-primary" title="{{ __('admin.users.auth') }}"><i class="fa fa-users" aria-hidden="true"></i></a>
                                                <a href="" class="btn-sm btn-warning" title="{{ __('admin.users.edit', $user->id) }}"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                <a href="" class="btn-sm btn-danger" title="{{ __('admin.users.delete', $user->id) }}"><i class="fa fa-trash" aria-hidden="true"></i></a>
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
