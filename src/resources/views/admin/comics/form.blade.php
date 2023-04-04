
<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="name">{{ __('comic.name') }}</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" onkeyup="convertToSlug(this.value)" name="name"
                           value="{{ $comic->name != '' ? $comic->name : old('name')}}"/>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="slug">{{ __('common.slug') }}</label>
                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror slug-convert" name="slug"
                           value="{{ $comic->slug != '' ? $comic->slug : old('slug') }}"/>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name_another">{{ __('comic.name_another') }}</label>
                    <input type="text" id="name_another" class="form-control @error('name_another') is-invalid @enderror" name="name_another"
                           value="{{ $comic->name_another != '' ? $comic->name_another : old('name_another')}}"/>
                    @error('name_another')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="author_name">{{ __('comic.author_name') }}</label>
                    <input type="text" id="author_name" class="form-control @error('author_name') is-invalid @enderror" name="author_name"
                           value="{{ $comic->author_name != '' ? $comic->author_name : old('author_name')}}"/>
                    @error('author_name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="status">{{ __('comic.status') }}</label>
                    <select name="status" class="form-control">
                        <option value="0">{{ __('comic.arr_status.not_released') }}</option>
                        <option value="1">{{ __('comic.arr_status.waiting_for_release') }}</option>
                        <option value="2">{{ __('comic.arr_status.release') }}</option>
                        <option value="3">{{ __('comic.arr_status.pause') }}</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="release_time">{{ __('comic.release_time') }}</label>
                    <input type="datetime-local" id="release_time" class="form-control" name="release_time"
                           value="{{ $comic->release_time != '' ? $comic->release_time : old('release_time')}}"/>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="the_origin">{{ __('comic.the_origin') }}</label>
                    <input type="text" id="the_origin" class="form-control" name="the_origin"
                           value="{{ $comic->the_origin != '' ? $comic->the_origin : old('the_origin')}}"/>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="genres">{{ __('comic.genre') }}</label>
                    <select class="form-control js-example-basic-multiple" name="genres[]" multiple="multiple" data-placeholder="{{ __('comic.select_genre') }}">
                        @foreach($genres as $genre)
                            <option value="{{ $genre->id }}" @if(in_array($genre->id, $genreSelected)) selected @endif>{{ $genre->name }}</option>
                        @endforeach
                    </select>
                    @error('genres')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="short_desc">{{ __('comic.short_desc') }}</label>
                    <textarea name="short_desc" class="form-control" id="" cols="20" rows="4">{{ $comic->short_desc }}</textarea>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="long_desc">{{ __('comic.long_desc') }}</label>
                    <textarea name="long_desc" class="form-control ckeditor" id="" cols="20" rows="4">{{ $comic->long_desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <div class="form-group">
                <label for="tags">{{ __('common.tags') }}</label>
                <input id="tags_1" type="text" class="tags form-control" name="tags" value="{{ $comic->tags != '' ? $comic->tags : old('tags') }}" />
                <div id="suggestions-container" style="position: relative; float: left; width: 250px; margin: 10px;"></div>
            </div>
        </div>
        <div class="d-flex w-100">
            <div class="form-group w-75">
                <label>{{ __('comic.is_visible') }}</label>
                <p>
                    {{ __('common.status.active')  }}:
                    <label>
                        <input type="radio" class="flat" name="is_visible" value="1" @if($comic->is_visible == config('const.admin.status.active')) checked @endif />
                    </label>
                    &nbsp;&nbsp;
                    {{ __('common.status.deactivate')  }}:
                    <label>
                        <input type="radio" class="flat" name="is_visible" value="0" @if($comic->is_visible == config('const.admin.status.deactivate')) checked @endif />
                    </label>
                </p>
            </div>
            <div class="form-group w-25">
                <label>{{ __('comic.highlight') }}</label>
                <p>
                    <label>
                        <input type="checkbox" class="flat" name="highlight" value="1" @if($comic->highlight == config('const.comic.highlight')) checked @endif />
                    </label>
                    &nbsp
                </p>
            </div>
        </div>
        <br>
        <label>{{ __('comic.thumbnail') }}</label>
        <div class="form-input">
            <div class="preview">
                <img id="file-ip-1-preview" src="{{ asset('storage/'.showFile($comic->thumbnail)) }}">
            </div>
            <label for="file-ip-1">{{ __('common.upload_file') }}</label>
            <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event, 'file-ip-1-preview');" name="thumbnail">
            @error('thumbnail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
        <br>
        <label>{{ __('comic.cover_image') }}</label>
        <div class="form-input">
            <div class="preview">
                <img id="file-ip-2-preview" src="{{ asset('storage/'.showFile($comic->cover_image)) }}">
            </div>
            <label for="file-ip-2">{{ __('common.upload_file') }}</label>
            <input type="file" id="file-ip-2" accept="image/*" onchange="showPreview(event, 'file-ip-2-preview');" name="cover_image">
            @error('cover_image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <a href="{{ route('admin.comic.list') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>

<!-- end form for validations -->
