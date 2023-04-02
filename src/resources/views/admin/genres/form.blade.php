
<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="name">{{ __('genre.name') }}</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" onkeyup="convertToSlug(this.value)" name="name"
                           value="{{ $genre->name != '' ? $genre->name : old('name')}}"/>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="slug">{{ __('common.slug') }}</label>
                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror slug-convert" name="slug"
                           value="{{ $genre->slug != '' ? $genre->slug : old('slug') }}"/>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('genre.status') }}</label>
                    <p>
                        {{ __('common.status.active')  }}:
                        <label>
                            <input type="radio" class="flat" name="is_visible" value="1" @if($genre->is_visible == config('const.admin.status.active')) checked @endif />
                        </label>
                        &nbsp;&nbsp;
                        {{ __('common.status.deactivate')  }}:
                        <label>
                            <input type="radio" class="flat" name="is_visible" value="0" @if($genre->is_visible == config('const.admin.status.deactivate')) checked @endif />
                        </label>
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label>{{ __('genre.highlight') }}</label>
                    <p>
                        <label>
                            <input type="checkbox" class="flat" name="highlight" value="1" @if($genre->highlight == config('const.genre.highlight')) checked @endif />
                        </label>
                        &nbsp
                    </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="tags">{{ __('common.tags') }}</label>
                    <input id="tags_1" type="text" class="tags form-control" name="tags" value="{{ $genre->tags != '' ? $genre->tags : old('tags') }}" />
                    <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="short_desc">{{ __('genre.short_desc') }}</label>
                    <textarea name="short_desc" class="form-control" id="" cols="20" rows="4">{{ $genre->short_desc }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="long_desc">{{ __('genre.long_desc') }}</label>
                    <textarea name="long_desc" class="form-control" id="" cols="20" rows="4">{{ $genre->long_desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="countries">{{ __('genre.category') }}</label>
            <select class="form-control js-example-basic-multiple" name="categories[]" multiple="multiple" data-placeholder="{{ __('genre.select_category') }}">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if(in_array($category->id, $categorySelected)) selected @endif>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <a href="{{ route('admin.genre.list') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>

<!-- end form for validations -->
