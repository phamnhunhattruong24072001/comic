<!-- start form for validation -->
<div class="row">
    <div class="col-lg-9">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="title">{{ __('chapter.title') }}</label>
                    <input type="text" id="title" class="form-control @error('title') is-invalid @enderror" name="title"
                           value="{{ $chapter->title ?? old('name')}}"/>
                    @error('title')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="number_chapter">{{ __('chapter.number_chapter') }}</label>
                    <input type="number" id="number_chapter" class="form-control @error('number_chapter') is-invalid @enderror change-number-chapter" data-slug="{{ config('const.slug_chapter') }}" name="number_chapter"
                           value="{{ $chapter->number_chapter ?? old('number_chapter')}}"/>
                    @error('number_chapter')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="slug">{{ __('common.slug') }}</label>
                    <input type="text" id="slug" class="form-control @error('slug') is-invalid @enderror slug-convert" name="slug"
                           value="{{ $chapter->slug ?? old('slug') }}"/>
                    @error('slug')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group required">
                    <label for="name">{{ __('chapter.name') }}</label>
                    <input type="text" id="name" class="form-control @error('name') is-invalid @enderror change-name" name="name"
                           value="{{ $chapter->name ?? old('name')}}" readonly/>
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="form-group">
                    <label for="short_desc">{{ __('chapter.short_desc') }}</label>
                    <textarea name="short_desc" class="form-control" id="" cols="20" rows="4">{{ $chapter->short_desc || old('short_desc') }}</textarea>
                </div>
            </div>

            <div class="col-lg-12 content-image @if(isset($type_comic) && $type_comic == config('const.comic.type_image')) d-block @else d-none @endif">
                <div class="form-group">
                    <div class="upload__box">
                        <div class="upload__btn-box">
                            <label class="upload__btn">
                                <p>Upload images</p>
                                <input type="file" multiple="" name="images[]" data-max_length="20" class="upload__inputfile">
                            </label>
                        </div>
                        <div class="upload__img-wrap">
                            @if(isset($chapterImages))
                                <input type="hidden" name="image_exist" class="image_exist" value="{{ implode(',', $chapterImages) }}">
                                @foreach($chapterImages as $key => $image)
                                    <div class='upload__img-box'><div style="background-image: url({{ asset(showFile($image)) }})" data-number="{{ $key }}" data-file="{{ $image }}" class="img-bg">
                                            <div class='upload__img-close' data-name="{{ $image }}"></div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 content-text @if(isset($type_comic) && $type_comic == config('const.comic.type_text')) d-block @else d-none @endif">
                <div class="form-group">
                    <label for="content_text">{{ __('chapter.content') }}</label>
                    <textarea name="content_text" class="ckeditor" cols="100" rows="40">{!! $chapter->content_text ?? old('content_text') !!}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3">
        <div class="form-group">
            <label for="comic">{{ __('chapter.comic') }}</label>
            <select class="form-control js-example-basic-multiple @error('comic_id') is-invalid @enderror change-comic" data-url="{{ route('admin.response.check_type_comic') }}" name="comic_id" data-placeholder="{{ __('chapter.select_comic') }}">
                @if($is_list)
                    <option value="">{{ __('chapter.select_comic') }}</option>
                    @foreach($comic as $item)
                        <option value="{{ $item->id }}" @if($item->id == $chapter->comic_id || old('comic_id') == $item->id) selected @endif>{{ $item->name }}</option>
                    @endforeach
                @else
                    <option value="{{ $comic->id }}">{{$comic->name}}</option>
                @endif
            </select>
            @if(!$is_list)
                <input type="hidden" name="is_comic" value="{{ $comic->slug }}">
            @endif
            @error('comic_id')
            <span class="text-danger">{{ $message }}</span>~
            @enderror
        </div>
        <div class="form-group">
            <label>{{ __('comic.is_visible') }}</label>
            <p>
                {{ __('common.status.active')  }}:
                <label>
                    <input type="radio" class="flat" name="is_visible" value="1" @if($chapter->is_visible == config('const.activate.on') || old('is_visible') == config('const.activate.on')) checked @endif />
                </label>
                &nbsp;&nbsp;
                {{ __('common.status.deactivate')  }}:
                <label>
                    <input type="radio" class="flat" name="is_visible" value="0" @if($chapter->is_visible == config('const.activate.off')) checked @endif />
                </label>
            </p>
        </div>
    </div>
    <div class="col-lg-12 mt-5">
        <a href="{{ route('admin.chapter.list', (isset($comic->slug) ? $comic->slug : '')) }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
        <button class="btn btn-secondary" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></button>
        <button class="btn btn-primary" type="submit">{{ $buttonSubmit }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
    </div>
</div>
<!-- end form for validations -->
@push('script')
    <script>
        jQuery(document).ready(function () {
            ImgUpload();
        });

        function ImgUpload() {
            let imgWrap = "";
            let imgArray = [];

            $('.upload__inputfile').each(function () {
                $(this).on('change', function (e) {
                    imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
                    let maxLength = $(this).attr('data-max_length');

                    let files = e.target.files;
                    let filesArr = Array.prototype.slice.call(files);
                    console.log(filesArr);
                    let iterator = 0;
                    filesArr.forEach(function (f, index) {

                        if (!f.type.match('image.*')) {
                            return;
                        }

                        if (imgArray.length > maxLength) {
                            return false
                        } else {
                            let len = 0;
                            for (var i = 0; i < imgArray.length; i++) {
                                if (imgArray[i] !== undefined) {
                                    len++;
                                }
                            }
                            if (len > maxLength) {
                                return false;
                            } else {
                                imgArray.push(f);

                                let reader = new FileReader();
                                reader.onload = function (e) {
                                    let html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                    imgWrap.append(html);
                                    iterator++;
                                }
                                reader.readAsDataURL(f);
                            }
                        }
                    });
                });
            });

            $('body').on('click', ".upload__img-close", function (e) {
                let imgExist = $('.image_exist');
                if(imgExist.length > 0) {
                    let nameClose = $(this).data('name');
                    const arrImage = imgExist.val().split(",");
                    for ( let i = 0; i < arrImage.length; i++){
                        if(arrImage[i] === nameClose){
                            arrImage.splice(i, 1);
                        }
                    }
                    imgExist.val(arrImage.toString())
                }
                let file = $(this).parent().data("file");
                for (let i = 0; i < imgArray.length; i++) {
                    if (imgArray[i].name === file) {
                        imgArray.splice(i, 1);
                        break;
                    }
                }
                $(this).parent().parent().remove();
            });

            $('.change-comic').on('change', function (){
                let val = $(this).val();
                let url = $(this).data('url');
                if(val !== '') {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            id : val,
                        }
                    }).done(function(response) {
                        if(response === 'image') {
                            $('.content-image').removeClass('d-none')
                            $('.content-text').addClass('d-none')
                        }else{
                            $('.content-image').addClass('d-none')
                            $('.content-text').removeClass('d-none')
                        }
                    });
                }
            });

            $('.change-number-chapter').on('keyup', function (){
                let slug = $(this).data('slug');
                let val = $(this).val();
                convertToSlug(val, slug);
                $('.change-name').val('Chapter'+' '+val);
            });
        }
    </script>
@endpush
