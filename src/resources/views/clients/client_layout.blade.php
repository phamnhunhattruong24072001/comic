<!DOCTYPE html>
<html lang="zxx">

@include('clients.layouts.head')

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    
    <!-- Header Section Begin -->
    @include('clients.layouts.header')
    <!-- Header End -->

    
    @yield('content')
        
    

<!-- Footer Section Begin -->
@include('clients.layouts.footer')
<!-- Search model end -->

@include('clients.layouts.script')


</body>

</html>