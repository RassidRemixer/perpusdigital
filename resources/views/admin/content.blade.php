  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
      <!-- Small boxes (Stat box) -->
      <div class="row d-flex">
          <div class="col-lg-4 col-4">
              <!-- small box -->
              <div class="small-box bg-info w-100">
                  <div class="inner">
                      <h3>{{ $countBuku }}</h3>
                      <p>Jumlah Buku</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-bag"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
              <!-- small box -->
              <div class="small-box bg-success w-100">
                  <div class="inner">
                      <h3>{{ $countPeminjaman }}</h3>
                      <p>Peminjaman</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-4 col-4">
              <!-- small box -->
              <div class="small-box bg-warning w-100">
                  <div class="inner">
                      <h3>{{ $countPeminjam }}</h3>
                      <p>User</p>
                  </div>
                  <div class="icon">
                      <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              </div>
          </div>
      </div>
      <!-- /.row -->
      <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->