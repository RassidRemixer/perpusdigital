@include('admin.header')

@include('admin.navbar')
  
@include('admin.sidebar')

@include('admin.admin')





<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('AdminLTE-3.2.0')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('AdminLTE-3.2.0')}}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('AdminLTE-3.2.0')}}/dist/js/demo.js"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('AdminLTE-3.2.0')}}/dist/js/pages/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
  $(document).ready(function() {
    // Ambil URL saat ini
    var currentUrl = window.location.pathname;
    
    // Loop melalui setiap tautan di sidebar
    $('.nav-link').each(function() {
      // Ambil href dari tautan
      var linkHref = $(this).attr('href');
      
      // Periksa apakah URL saat ini cocok dengan href tautan
      if (currentUrl === linkHref) {
        // Jika cocok, tambahkan kelas 'active' pada tautan
        $(this).addClass('active');
        
        // Jika tautan memiliki submenu, tambahkan 'menu-open' pada elemen li
        $(this).parents('li.nav-item').addClass('menu-open');
      }
    });
  });
  
  
</script>

</body>
</html>

@include('admin.footer')