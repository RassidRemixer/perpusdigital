@include('admin.header')

@include('admin.navbar')
  
@include('admin.sidebar')

@include('admin.buku')






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

<script src="{{asset('AdminLTE-3.2.0')}}/dist/js/pages/dashboard.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

<script>
    @if (Session::has('success'))
        toastr.success("{{ Session::get('success') }}");  
    @endif 
</script> 

<script>
  function hapusBuku(event, bukuId) {
    event.preventDefault();
    // Tampilkan konfirmasi SweetAlert
    Swal.fire({
      title: "Apa Kamu Yakin?",
      text: "Setelah Menghapus, Kamu tidak bisa Mengembalikan nya!!!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya Hapus "
    }).then((result) => {
      if (result.isConfirmed) {
        // Lakukan permintaan AJAX ke endpoint penghapusan
        $.ajax({
          url: "{{ url('hapus') }}/" + bukuId,
          type: "POST",
          data: {
            _token: "{{ csrf_token() }}",
            _method: "DELETE"
          },
          success: function(response) {
            // Tampilkan pesan sukses SweetAlert
            Swal.fire({
              title: "Terhapus!",
              text: "Buku Berhasil Dihapus.",
              icon: "success"
            }).then((result) => {
              // Me-reload halaman setelah menekan "OK"
              if (result.isConfirmed || result.dismiss === Swal.DismissReason.timer) {
                location.reload();
              }
            });
          },
          error: function(xhr, status, error) {
            // Tampilkan pesan kesalahan SweetAlert
            Swal.fire({
              title: "Error!",
              text: "Tidak Bisa menghapus Buku.",
              icon: "error"
            });
            console.error(xhr.responseText);
          }
        });
      } else {
        // Tampilkan pesan pembatalan jika pengguna membatalkan penghapusan
        Swal.fire({
          title: "Gagal",
          text: "Buku Tidak jadi di hapus",
          icon: "info"
        });
      }
    });
  }
</script>

</body>
</html>

@include('admin.footer')