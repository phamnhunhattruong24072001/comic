@extends('admin.admin_layout')

@section('title', __('chapter.update_image'))

@push('css')
    <style>
        .image-container {
            position: relative;
            display: inline-block;
            width: 200px;
            height: 300px;
            margin: 10px;
        }

        .image-container > .image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 90%;
            object-fit: cover;
        }
        .image-container > .order-image{
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 10%;
            background: #0b0c2a;
            color: #fff;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('chapter.update_image') }} | {{$chapter->name}}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.chapter.update_image', $chapter->id) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <!-- start form for validation -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="image-area">
                            @foreach($arrImage as $key => $image)
                                <div class="image-container" id="{{$image}}">
                                    <img class="image" src="{{asset(showFile($image))}}" width="100">
                                    <span class="order-image">{{ $key + 1 }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <input type="hidden" id="move-image" value="" name="image_move">
                        <a href="{{ route('admin.chapter.list') }}" class="btn btn-warning">{{ __('common.button.back') }} <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                        <a class="btn btn-secondary" href="" type="reset">{{ __('common.button.reset') }} <i class="fa fa-refresh" aria-hidden="true"></i></a>
                        <button class="btn btn-primary" type="submit">{{ __('common.button.create') }} <i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#image-area").sortable({
                stop :function (event, ui){
                    let order = $("#image-area").sortable("toArray");
                    let string = order.toString();
                    $('#move-image').val(string);
                    $('.order-image').each(function (e){
                        $(this).text(e + 1);
                    })
                }
            });
            $("#image-area").disableSelection();
        });
    </script>
@endpush
