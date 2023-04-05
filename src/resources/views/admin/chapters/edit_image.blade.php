@extends('admin.admin_layout')

@section('title', __('chapter.update_title'))

@push('css')
    <style>
        .image-container {
            position: relative;
            display: inline-block;
            width: 150px;
            height: 150px;
            margin: 10px;
        }

        .image {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="x_panel">
        <div class="x_title">
            <h2>{{ __('chapter.update_title') }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="x_content">
            <form id="demo-form" action="{{ route('admin.chapter.update_image', 1) }}" method="post" enctype="multipart/form-data" autocomplete="off">
                @csrf
                <!-- start form for validation -->
                <div class="row">
                    <div class="col-lg-12">
                        <div id="image-area">
                            <div class="image-container" id="class1">
                                <img class="image" src="http://localhost:8000/storage/countries/168061384735.jpg" width="100">
                            </div>
                            <div class="image-container" id="class2">
                                <img class="image" src="http://localhost:8000/storage/countries/168061384735.jpg" width="100">
                            </div>
                            <div class="image-container" id="class3 ">
                                <img class="image" src="http://localhost:8000/storage/countries/168061384735.jpg" width="100">
                            </div>
                        </div>
                    </div>
                    <button id="save-button" class="btn btn-primary" type="button">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.min.js"></script>
    <script>
        $(function() {
            $("#image-area").sortable();
            $("#image-area").disableSelection();
            $("#save-button").click(function() {
                let order = $("#image-area").sortable("toArray");
                console.log(order);
            });
        });
    </script>
@endpush
