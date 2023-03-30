<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
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
                           value="{{ $user->email != '' ? $user->email : old('email') }}"/>
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="day_of_birth">{{ __('user.birth_day') }}</label>
                    <input type="date" id="day_of_birth" class="form-control" name="day_of_birth"
                           value="{{ $user->day_of_birth != '' ? $user->day_of_birth : old('day_of_birth') }}"/>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="address">{{ __('user.address') }}</label>
                    <input type="text" id="address" class="form-control" name="address" value="{{ $user->address != '' ? $user->address : old('address') }}"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>{{ __('user.gender') }}</label>
                            <p>
                                {{ __('user.genders.male') }}:
                                <label>
                                    <input type="radio" class="flat" name="gender" value="1" @if(!isset($user->gender) || $user->gender == config('const.gender.male')) checked @endif/>
                                </label>
                                &nbsp;&nbsp;
                                {{ __('user.genders.female') }}:
                                <label>
                                    <input type="radio" class="flat" name="gender" value="2" @if($user->gender == config('const.gender.female')) checked @endif/>
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
                                    <input type="radio" class="flat" name="is_visible" value="1" @if($user->is_visible == config('const.admin.status.active')) checked @endif />
                                </label>
                                &nbsp;&nbsp;
                                {{ __('common.status.deactivate')  }}:
                                <label>
                                    <input type="radio" class="flat" name="is_visible" value="0" @if($user->is_visible == config('const.admin.status.deactivate')) checked @endif />
                                </label>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-input">
            <div class="preview">
                <img id="file-ip-1-preview" src="{{ asset('storage/'.showFile($user->avatar)) }}">
            </div>
            <label for="file-ip-1">{{ __('common.upload_file') }}</label>
            <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event);" name="avatar">
            @error('avatar')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12">
        <a href="{{ route('admin.users.list') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>
<!-- end form for validations -->
