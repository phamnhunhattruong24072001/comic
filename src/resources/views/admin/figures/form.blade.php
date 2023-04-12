<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="name">{{ __('figure.name') }}</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror change-name" name="name"
                           value="{{ $figure->name ?? old('name')}}" onkeyup="convertToSlug(this.value)"/>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="slug">{{ __('figure.slug') }}</label>
                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror slug-convert" name="slug"
                           value="{{ $figure->slug ?? old('slug')}}"/>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nickname">{{ __('figure.nickname') }}</label>
                    <input type="text" id="nickname" class="form-control @error('nickname') is-invalid @enderror" name="nickname"
                           value="{{ $figure->nickname ?? old('nickname')}}"/>
                    @error('nickname')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="age">{{ __('figure.age') }}</label>
                    <input type="number" id="age" class="form-control @error('age') is-invalid @enderror" name="age"
                           value="{{ $figure->age ?? old('age')}}"/>
                    @error('age')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="birthday">{{ __('figure.birthday') }}</label>
                    <input type="date" id="birthday" class="form-control @error('birthday') is-invalid @enderror" name="birthday"
                           value="{{ $figure->birthday ?? old('birthday')}}"/>
                    @error('birthday')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="nationality">{{ __('figure.nationality') }}</label>
                    <input type="text" id="nationality" class="form-control @error('nationality') is-invalid @enderror" name="nationality"
                           value="{{ $figure->nationality ?? old('nationality')}}"/>
                    @error('nationality')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="height">{{ __('figure.height') }}</label>
                    <input type="text" id="height" class="form-control @error('height') is-invalid @enderror" name="height"
                           value="{{ $figure->height ?? old('height')}}"/>
                    @error('height')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="career">{{ __('figure.career') }}</label>
                    <input type="text" id="career" class="form-control @error('career') is-invalid @enderror" name="career"
                           value="{{ $figure->career ?? old('career')}}"/>
                    @error('career')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="relationship">{{ __('figure.relationship') }}</label>
                    <input type="text" id="relationship" class="form-control @error('relationship') is-invalid @enderror" name="relationship"
                           value="{{ $figure->relationship ?? old('relationship')}}"/>
                    @error('relationship')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="short_desc">{{ __('figure.short_desc') }}</label>
                    <textarea name="short_desc" class="form-control" id="" cols="20" rows="4">{{ $figure->short_desc || old('short_desc') }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="long_desc">{{ __('figure.long_desc') }}</label>
                    <textarea name="long_desc" class="form-control ckeditor" id="" cols="20" rows="4">{{ $figure->long_desc || old('long_desc') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group required">
            <label for="comics">{{ __('figure.comic') }}</label>
            <select class="form-control js-example-basic-multiple @error('comics') is-invalid @enderror" name="comics" data-placeholder="{{ __('figure.select_comic') }}" multiple>
                <option value="">{{ __('figure.select_comic') }}</option>
                @foreach($comics as $item)
                    <option value="{{ $item->id }}" @if(in_array($item->id, $comicSelected)) selected @endif>{{ $item->name }}</option>
                @endforeach
            </select>
            @error('comics')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group">
            <label for="character_role">{{ __('figure.character_role') }}</label>
            <select name="character_role" class="js-example-basic-multiple form-control" id="">
                <option value="0" @if($figure->character_role == 0 || old('character_role') == 0) @endif>{{ __('figure.main_character') }}</option>
                <option value="1" @if($figure->character_role == 1 || old('character_role') == 1) @endif>{{ __('figure.supporting_character') }}</option>
                <option value="2" @if($figure->character_role == 2 || old('character_role') == 2) @endif>{{ __('figure.villain') }}</option>
            </select>
        </div>
        <div class="form-group required">
            <label for="chapter_end">{{ __('figure.avatar') }}</label>
            <div class="form-input">
                <div class="preview">
                    <img id="file-ip-1-preview" src="{{ asset(showFile($figure->avatar)) }}">
                </div>
                <label for="file-ip-1">{{ __('common.upload_file') }}</label>
                <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event, 'file-ip-1-preview');" name="avatar">
                <input type="hidden" name="image_exist" value="{{ $figure->avatar }}">
                @error('avatar')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <label>{{ __('comic.is_visible') }}</label>
            <p>
                {{ __('common.status.active')  }}:
                <label>
                    <input type="radio" class="flat" name="is_visible" value="1" @if($figure->is_visible == config('const.activate.on') || old('is_visible') == config('const.activate.on')) checked @endif />
                </label>
                &nbsp;&nbsp;
                {{ __('common.status.deactivate')  }}:
                <label>
                    <input type="radio" class="flat" name="is_visible" value="0" @if($figure->is_visible == config('const.activate.off')) checked @endif />
                </label>
            </p>
        </div>
        <div class="form-group">
            <label>{{ __('user.gender') }}</label>
            <p>
                {{ __('user.genders.male') }}:
                <label>
                    <input type="radio" class="flat" name="gender" value="1" @if(!isset($figure->gender) || $figure->gender == config('const.gender.male')) checked @endif/>
                </label>
                &nbsp;&nbsp;
                {{ __('user.genders.female') }}:
                <label>
                    <input type="radio" class="flat" name="gender" value="2" @if($figure->gender == config('const.gender.female')) checked @endif/>
                </label>
            </p>
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <a href="{{ route('admin.figure.list') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>
<!-- end form for validations -->
