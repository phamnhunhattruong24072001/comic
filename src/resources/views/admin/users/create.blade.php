@extends('admin.admin_layout')

@section('title', 'Create Users')

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('user.create_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">

            <!-- start form for validation -->
            <form id="demo-form" data-parsley-validate action="{{ route('admin.users.store') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="name">{{ __('user.name') }} * :</label>
                            <input type="text" id="name" class="form-control" name="name" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="username">{{ __('user.username') }} * :</label>
                            <input type="text" id="username" class="form-control" name="username" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="email">{{ __('user.email') }} :</label>
                            <input type="text" id="email" class="form-control" name="email"
                                data-parsley-trigger="change" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="day_of_birth">{{ __('user.birth_day') }} :</label>
                            <input type="text" id="day_of_birth" class="form-control" name="day_of_birth"
                                data-parsley-trigger="change" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="address">{{ __('user.address') }} :</label>
                            <input type="text" id="address" class="form-control" name="address"
                                data-parsley-trigger="change" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="avatar">{{ __('user.avatar') }} :</label>
                            <input type="text" id="avatar" class="form-control" name="avatar"
                                data-parsley-trigger="change" />
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{ __('user.gender') }} *:</label>
                            <p>
                                {{ __('user.genders.male') }}:
                                <input type="radio" class="flat" name="gender" id="genderM" value="M"
                                       checked="" required /> {{ __('user.genders.female') }}:
                                <input type="radio" class="flat" name="gender" id="genderF" value="F" />
                            </p>
                        </div>
                        <div class="form-group">
                            <label>{{ __('user.status') }} *:</label>
                            <p>
                                {{ __('common.status.active')  }}:
                                <input type="radio" class="flat" name="is_visible" id="genderM" value="1"
                                       checked="" required /> {{ __('common.status.deactive')  }}:
                                <input type="radio" class="flat" name="is_visible" id="genderF" value="0" />
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <button class="btn btn-primary" type="submit">{{ __('common.button.create') }}</button>
                    </div>
                </div>

            </form>
            <!-- end form for validations -->
        </div>
    </div>
@endsection
