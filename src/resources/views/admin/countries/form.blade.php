
<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="name">{{ __('country.name') }}</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" onkeyup="convertToSlug(this.value)" name="name"
                           value="{{ $country->name != '' ? $country->name : old('name')}}"/>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="another_name">{{ __('country.name_another') }}</label>
                    <input type="text" class="form-control @error('another_name') is-invalid @enderror"
                           name="another_name" value="{{ $country->another_name != '' ? $country->another_name : old('another_name') }}"/>
                    @error('another_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="slug">{{ __('common.slug') }}</label>
                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror slug-convert" name="slug"
                           value="{{ $country->slug != '' ? $country->slug : old('slug') }}"/>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('country.status') }}</label>
                    <p>
                        {{ __('common.status.active')  }}:
                        <label>
                            <input type="radio" class="flat" name="is_visible" value="1" @if($country->is_visible == config('const.admin.status.active')) checked @endif />
                        </label>
                        &nbsp;&nbsp;
                        {{ __('common.status.deactivate')  }}:
                        <label>
                            <input type="radio" class="flat" name="is_visible" value="0" @if($country->is_visible == config('const.admin.status.deactivate')) checked @endif />
                        </label>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="tags">{{ __('common.tags') }}</label>
                    <input id="tags_1" type="text" class="tags form-control" name="tags" value="{{ $country->tags != '' ? $country->tags : old('tags') }}" />
                    <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="avatar">{{ __('country.short_desc') }}</label>
                    <textarea name="short_desc" class="form-control" id="" cols="20" rows="4">{{ $country->short_desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-input">
            <div class="preview">
                <img id="file-ip-1-preview" src="{{ asset('storage/'.showFile($country->avatar)) }}">
            </div>
            <label for="file-ip-1">{{ __('common.upload_file') }}</label>
            <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event, 'file-ip-1-preview');" name="avatar">
            @error('avatar')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <a href="{{ route('admin.country.list') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>

<!-- end form for validations -->
