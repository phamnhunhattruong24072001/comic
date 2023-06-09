<!-- jQuery -->
<script src="{{asset('backend/vendors/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('backend/vendors/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<!-- FastClick -->
<script src="{{asset('backend/vendors/fastclick/lib/fastclick.js')}}"></script>
<!-- NProgress -->
<script src="{{asset('backend/vendors/nprogress/nprogress.js')}}"></script>
<!-- Chart.js -->
<script src="{{asset('backend/vendors/Chart.js/dist/Chart.min.js')}}"></script>
<!-- gauge.js -->
<script src="{{asset('backend/vendors/gauge.js/dist/gauge.min.js')}}"></script>
<!-- bootstrap-progressbar -->
<script src="{{asset('backend/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js')}}"></script>
<!-- iCheck -->
<script src="{{asset('backend/vendors/iCheck/icheck.min.js')}}"></script>
<!-- Skycons -->
<script src="{{asset('backend/vendors/skycons/skycons.js')}}"></script>
<!-- Flot -->
<script src="{{asset('backend/vendors/Flot/jquery.flot.js')}}"></script>
<script src="{{asset('backend/vendors/Flot/jquery.flot.pie.js')}}"></script>
<script src="{{asset('backend/vendors/Flot/jquery.flot.time.js')}}"></script>
<script src="{{asset('backend/vendors/Flot/jquery.flot.stack.js')}}"></script>
<script src="{{asset('backend/vendors/Flot/jquery.flot.resize.js')}}"></script>
<!-- Flot plugins -->
<script src="{{asset('backend/vendors/flot.orderbars/js/jquery.flot.orderBars.js')}}"></script>
<script src="{{asset('backend/vendors/flot-spline/js/jquery.flot.spline.min.js')}}"></script>
<script src="{{asset('backend/vendors/flot.curvedlines/curvedLines.js')}}"></script>
<!-- DateJS -->
<script src="{{asset('backend/vendors/DateJS/build/date.js')}}"></script>
<!-- JQVMap -->
<script src="{{asset('backend/vendors/jqvmap/dist/jquery.vmap.js')}}"></script>
<script src="{{asset('backend/vendors/jqvmap/dist/maps/jquery.vmap.world.js')}}"></script>
<script src="{{asset('backend/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js')}}"></script>
<!-- bootstrap-daterangepicker -->
<script src="{{asset('backend/vendors/moment/min/moment.min.js')}}"></script>
<script src="{{asset('backend/vendors/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- Switchery -->
<script src="{{asset('backend/vendors/switchery/dist/switchery.min.js')}}"></script>
<!-- jQuery Tags Input -->
<script src="{{asset('backend/vendors/jquery.tagsinput/src/jquery.tagsinput.js')}}"></script>
<!-- Datatables -->
<script src="{{asset('backend/vendors/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.flash.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js')}}"></script>
<script src="{{asset('backend/vendors/datatables.net-scroller/js/dataTables.scroller.min.js')}}"></script>
<script src="{{asset('backend/vendors/jszip/dist/jszip.min.js')}}"></script>
<script src="{{asset('backend/vendors/pdfmake/build/pdfmake.min.js')}}"></script>
<script src="{{asset('backend/vendors/pdfmake/build/vfs_fonts.js')}}"></script>
<!-- Select2 -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- CKEditor 4 -->
<script src="{{ asset('backend/ckeditor/ckeditor.js') }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Custom Theme Scripts -->
<script src="{{asset('backend/build/js/custom.min.js')}}"></script>
<script src="{{asset('backend/build/js/meCustom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Nestable/2012-10-15/jquery.nestable.min.js" integrity="sha512-a3kqAaSAbp2ymx5/Kt3+GL+lnJ8lFrh2ax/norvlahyx59Ru/1dOwN1s9pbWEz1fRHbOd/gba80hkXxKPNe6fg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script>
    $('#check-all').on('change', function (){
        let is_check = $(this).prop('checked');
        let item = $('.check-item');
        item.prop('checked', is_check);
    });

    $('.check-item').on('change', function (){
        let is_check_item = $('.check-item').length === $('.check-item:checked').length;
        $('#check-all').prop('checked', is_check_item);
    });

    $('.delete-multiple').on('click', function (){
        let url = $(this).data('url');
        let arrId = [];
        $('.check-item:checked').each(function (e){
            arrId[e] = $(this).val();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (arrId.length > 0) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id : arrId,
                }
            }).done(function() {
                location.reload();
            });
        }
    });

    $('.restore-multiple').on('click', function (){
        let url = $(this).data('url');
        let arrId = [];
        $('.check-item:checked').each(function (e){
            arrId[e] = $(this).val();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if (arrId.length > 0) {
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    id : arrId,
                }
            }).done(function() {
                location.reload();
            });
        }
    });

    $('.switch-status').on('change', function (){
        let id = $(this).data('id');
        let is_visible = $(this).val();
        let url = $(this).data('url');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: url,
            type: 'POST',
            data: {
                id : id,
                is_visible : is_visible
            }
        }).done(function() {

        });
    });

    function showPreview(event, id){
        if(event.target.files.length > 0){
            let src = URL.createObjectURL(event.target.files[0]);
            let preview = document.getElementById(id);
            preview.src = src;
            preview.style.display = "block";
        }
    }

    function ChangeToSlug(title)
    {
        //Đổi chữ hoa thành chữ thường
        let slug = title.toLowerCase();

        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        return slug;
    }

    function convertToSlug(input, key = "")
    {
        let result = ChangeToSlug(input);
        $('.slug-convert').val(key+result);
    }

    $('.confirm-delete').on('click', function (){
        confirm('Bạn chắc chắn muốn xóa');
    });

    function confirmCheck(e)
    {
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
            }
        })
    }

    $('.button-delete').on('click', function (e){
        e.preventDefault();
        let form = $(this).parents('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                    'Deleted!',
                    'Your file has been deleted.',
                    'success'
                )
                form.submit();
            }
        })
    })
</script>
@stack('script')

