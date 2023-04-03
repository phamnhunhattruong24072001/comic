
<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="name">{{ __('chapter.name') }}</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" onkeyup="convertToSlug(this.value)" name="name"
                           value="{{ $chapter->name != '' ? $chapter->name : old('name')}}"/>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="number_chapter">{{ __('chapter.number_chapter') }}</label>
                    <input type="text" id="number_chapter" class="form-control @error('number_chapter') is-invalid @enderror" onkeyup="convertToSlug(this.value)" name="number_chapter"
                           value="{{ $chapter->number_chapter != '' ? $chapter->number_chapter : old('number_chapter')}}"/>
                    @error('number_chapter')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="slug">{{ __('common.slug') }}</label>
                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror slug-convert" name="slug"
                           value="{{ $chapter->slug != '' ? $chapter->slug : old('slug') }}"/>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="genres">{{ __('chapter.genre') }}</label>
                    <select class="form-control js-example-basic-multiple" name="comic" data-placeholder="{{ __('chapter.select_comic') }}">
{{--                        @foreach($genres as $genre)--}}
{{--                            <option value="{{ $genre->id }}" @if(in_array($genre->id, $genreSelected)) selected @endif>{{ $genre->name }}</option>--}}
{{--                        @endforeach--}}
                    </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="short_desc">{{ __('chapter.short_desc') }}</label>
                    <textarea name="short_desc" class="form-control" id="" cols="20" rows="4">{{ $chapter->short_desc }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <label>{{ __('chapter.thumbnail') }}</label>
        <div class="form-input">
            <div class="preview">
                <img id="file-ip-1-preview" src="{{ asset('storage/'.showFile($chapter->thumbnail)) }}">
            </div>
            <label for="file-ip-1">{{ __('common.upload_file') }}</label>
            <input type="file" id="file-ip-1" accept="image/*" onchange="showPreview(event, 'file-ip-1-preview');" name="thumbnail">
            @error('thumbnail')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <a href="{{ route('admin.chapter.list', $comic->slug) }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>

<!-- end form for validations -->
