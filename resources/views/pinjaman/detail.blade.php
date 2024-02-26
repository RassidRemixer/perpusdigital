@include('admin.header')

@include('admin.navbar')
  
@include('admin.sidebar')

@include('pinjaman.pinjam')





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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>


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

    function kembalikanBuku(button, id) {
    // Minta konfirmasi dari pengguna
    if (confirm("Apakah Anda yakin ingin mengembalikan buku?")) {
        // Nonaktifkan tombol setelah diklik
        $(button).prop('disabled', true);

        // Ambil token CSRF dari tag meta
        var csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Kirim request AJAX dengan menyertakan token CSRF
        $.ajax({
            type: 'PATCH',
            url: `/kembalikan-buku/${id}`,
            data: {
                _token: csrfToken
            },
            success: function (response) {
                // Handle respons jika diperlukan
                console.log(response.message);

                // Ubah teks dan warna tombol setelah pembaruan berhasil
                $(button).text('Buku sudah dikembalikan');
                $(button).removeClass('btn-primary').addClass('btn-success');

                // Tambahkan logika untuk menambah stok buku
                if (response.success) {
                    // Ubah warna tombol dan teks jika berhasil dikembalikan
                    $(button).text('Buku sudah dikembalikan');
                    $(button).removeClass('btn-primary').addClass('btn-success');

                    // Tambahkan logika untuk menambah stok buku
                    var idBuku = response.id_buku;
                    var stokElement = $('#stok-buku-' + idBuku); // Gantilah dengan ID atau selektor yang sesuai

                    if (stokElement.length) {
                        var currentStok = parseInt(stokElement.text());
                        stokElement.text(currentStok + 1);
                    }
                }

                // Anda juga bisa menambahkan perubahan lain yang sesuai dengan kebutuhan UI Anda
            },
            error: function (error) {
                // Handle kesalahan jika diperlukan
                console.error('Error updating status:', error);

                // Tambahkan detail kesalahan server ke dalam console
                console.log('Server error details:', error.responseText);

                // Kembalikan tombol ke kondisi normal jika ada kesalahan
                $(button).prop('disabled', false);
            }
        });
    }
}

</script>


<style>
    .uppercase {
        text-transform: uppercase;
    }
</style>

</body>
</html>

@include('admin.footer')