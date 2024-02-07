  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">BUKU</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">BukuCreate</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- Modal -->
      <div class="modal fade" id="modal-addadmin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Tambah Buku</h4>
            </div>
            <div class="modal-body">
              <form action="{{ route('tambahbuku') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" placeholder="Masukkan Judul Buku" required>
                    </div>
                    <div class="form-group">
                        <label for="namalengkap">Penulis</label>
                        <input type="text" class="form-control" id="penulis" name="penulis" placeholder="Masukkan Penulis Buku" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Penerbit</label>
                        <input type="text" class="form-control" id="penerbit" name="penerbit" placeholder="Masukkan Penulis Buku" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Tahun Terbit</label>
                        <input type="number" class="form-control" id="tahunterbit" name="tahunterbit" placeholder="Masukkan Alamat" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default font-weight-bold" data-dismiss="modal">BATAL</button>
                    <button type="submit" class="btn btn-primary font-weight-bold">SIMPAN</button>
                </div>
            </form>
            
            
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->




    <!-- /.content-header -->
    <div class="card">
      <div class="card-header text-right mb-3">
        <h3 class="card-title">Data Buku PerpusTakaan</h3>
        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-addadmin"><i class="fas fa-plus"></i> Tambah Buku</a>
      </div>
      <!-- /.card-header -->
      {{-- <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
          <thead>
          <tr>
            <th>Nama</th>
            <th>Username</th>
            <th>Alamat</th>
            <th>Pilihan</th>
          </tr>
          </thead>
          <tbody>
          <tr>
            <td>Trident</td>
            <td>Internet
              Explorer 4.0
            </td>
            <td>Win 95+</td>
            <td> 
              <a href="" class="btn bt-warning btn-sm"><i class="fas fa-edit"></i></a>
              <a href="" class="btn bt-danger btn-sm"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
          </tfoot>
        </table>
      </div> --}}
      <div class="card-body">
        <table class="table table-bordered table-striped" style="border-width: 2px; border-color: dark;">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun terbit</th>
                    <th>Pilihan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($buku as $key => $item)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->penerbit }}</td>
                        <td>{{ $item->tahunterbit }}</td>
                        <td>
                            <a href="{{ route('edit', ['id' => $item->id]) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                            <a href="{{ route('delete', ['id' => $item->id]) }}" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
      <!-- /.card-body -->
    </div>
  </div>
  <!-- /.content-wrapper -->