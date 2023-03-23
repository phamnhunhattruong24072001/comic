<!-- start form for validation -->
<form id="demo-form" action="{{ route('admin.users.store') }}" method="post">
    @csrf
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group required">
                <label for="name">{{ __('user.name') }}</label>
                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name"
                       value="{{ $user->name != '' ? $user->name : old('name')}}"/>
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group required">
                <label for="username">{{ __('user.username') }}</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror"
                       name="username" value="{{ $user->username != '' ? $user->username : old('username') }}"/>
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group required">
                <label for="email">{{ __('user.email') }}</label>
                <input type="text" id="email" class="form-control @error('email') is-invalid @enderror" name="email"
                       value="{{ $user->email }}"/>
                @error('email')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="day_of_birth">{{ __('user.birth_day') }}</label>
                <input type="date" id="day_of_birth" class="form-control" name="day_of_birth"
                       value="{{ $user->day_of_birth }}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="address">{{ __('user.address') }}</label>
                <input type="text" id="address" class="form-control" name="address" value="{{ $user->address }}"/>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="form-group">
                <label for="avatar">{{ __('user.avatar') }}</label>
                <input type="text" id="avatar" class="form-control" name="avatar" value="{{ $user->avatar }}"/>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('user.gender') }}</label>
                        <p>
                            {{ __('user.genders.male') }}:
                            <label>
                                <input type="radio" class="flat" name="gender" value="1"
                                       @if(empty($user->gender)) checked @endif
                                       @if($user->gender == config('const.gender.male')) checked @endif/>
                            </label>
                            &nbsp;&nbsp;
                            {{ __('user.genders.female') }}:
                            <label>
                                <input type="radio" class="flat" name="gender" value="2"
                                       @if($user->gender == config('const.gender.female')) checked @endif/>
                            </label>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>{{ __('user.status') }}</label>
                        <p>
                            {{ __('common.status.active')  }}:
                            <label>
                                <input type="radio" class="flat" name="is_visible" value="1" checked/>
                            </label>
                            &nbsp;&nbsp;
                            {{ __('common.status.deactive')  }}:
                            <label>
                                <input type="radio" class="flat" name="is_visible" value="0" />
                            </label>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <a href="{{ route('admin.users') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
            <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
            <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
        </div>
    </div>
</form>
<!-- end form for validations -->
