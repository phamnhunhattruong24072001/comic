<!DOCTYPE html>
<html lang="en">
  
  @include('admin.layouts.head')

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        
         @include('admin.layouts.sidebar')

        <!-- top navigation -->
         @include('admin.layouts.navigation')
        <!-- /top navigation -->

        <!-- /content -->
        <div class="right_col" role="main">
            @yield('content')
        </div>
        <!-- /end content -->

        <!-- footer content -->
        @include('admin.layouts.footer')
        <!-- /footer content -->
      </div>
    </div>

    @include('admin.layouts.script')
	
  </body>
</html>
