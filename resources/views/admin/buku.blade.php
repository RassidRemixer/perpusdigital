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
              @role('admin')
              <li class="breadcrumb-item active">BukuCreate</li>
              @endrole
              @role('petugas')
              <li class="breadcrumb-item active">BukuCreate</li>
              @endrole
              @role('user')
              <li class="breadcrumb-item active">Buku</li>
              @endrole
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
                        <input type="number" class="form-control" id="tahunterbit" name="tahunterbit" placeholder="2006" required>
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
      <section>
      @foreach ($buku as $item)
      <!-- Modal Edit -->
      <div class="modal fade" id="modal-editadmin-{{ $item->id }}">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title font-weight-bold">Edit buku</h4>
                  </div>
  
                  <!-- Formulir Edit -->
                  <div class="modal-body">
                      <form action="{{ route('editbuku', ['id' => $item->id]) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="name">Judul</label>
                                  <input type="text" class="form-control" id="judul" name="judul" value="{{ $item->judul }}" placeholder="Masukkan Nama" autofocus>
                              </div>
                              <div class="form-group">
                                  <label for="namalengkap">Penulis</label>
                                  <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $item->penulis }}" placeholder="Masukkan Nama Lengkap" required>
                              </div>
                              <div class="form-group">
                                  <label for="email">Penerbit</label>
                                  <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $item->penerbit }}" placeholder="contoh@gmail.com" required>
                              </div>
                              <div class="form-group">
                                  <label for="alamat">Tahun Terbit</label>
                                  <input type="number" class="form-control" id="tahunterbit" name="tahunterbit" value="{{ $item->tahunterbit }}" placeholder="Masukkan Alamat" required>
                              </div>
                          </div>
                          <div class="modal-footer justify-content-between">
                              <button type="button" class="btn btn-default font-weight-bold" data-dismiss="modal">BATAL</button>
                              <button type="submit" class="btn btn-primary font-weight-bold">SIMPAN</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      @endforeach

      @foreach ($buku as $item)
    <!-- Modal Detail Peminjaman -->
    <div class="modal fade" id="modal-detailpinjam-{{ $item->id }}">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title font-weight-bold">Detail Buku</h4>
                </div>

                <!-- Formulir Detail -->
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="card-body">
                            <!-- Isi Detail Buku -->
                            <div class="form-group">
                              <label for="name">Judul</label>
                              <input type="text" class="form-control" id="judul" name="judul" value="{{ $item->judul }}" readonly>
                          </div>
                          <div class="form-group">
                              <label for="namalengkap">Penulis</label>
                              <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $item->penulis }}" readonly>
                          </div>
                          <div class="form-group">
                              <label for="email">Penerbit</label>
                              <input type="text" class="form-control" id="penerbit" name="penerbit" value="{{ $item->penerbit }}" readonly>
                          </div>
                          <div class="form-group">
                              <label for="alamat">Tahun Terbit</label>
                              <input type="number" class="form-control" id="tahunterbit" name="tahunterbit" value="{{ $item->tahunterbit }}" readonly>
                          </div>
                          
                          <!-- Tambahkan Input Hidden untuk buku_id -->
                          <input type="hidden" name="buku_id" value="{{ $item->id }}">
                          
                          <!-- Tambahkan Input Tanggal Peminjaman -->
                          <div class="form-group">
                              <label for="tanggal_peminjaman">Tanggal Peminjaman</label>
                              <input type="text" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" value="{{ $item->created_at }}" readonly>
                          </div>
                        </div>
                        <div class="modal-footer justify-content-end">
                            <button type="button" class="btn btn-secondary font-weight-bold" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary font-weight-bold">Konfirmasi Pinjam</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach



    <!-- /.content-header -->
    <div class="card">
      <div class="card-header text-right mb-3">
        <h3 class="card-title">Data Buku PerpusTakaan</h3>
        @role('admin')
        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-addadmin"><i class="fas fa-plus"></i> Tambah Buku</a>
        @endrole
        @role('petugas')
        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-addadmin"><i class="fas fa-plus"></i> Tambah Buku</a>
        @endrole
        @role('user')
        {{-- <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-addadmin"><i class="fas fa-plus"></i> Tambah Buku</a> --}}
        @endrole
      </div>
      <div class="card-body">
        <table class="table table-bordered table-striped" style="border-width: 2px; border-color: dark;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun terbit</th>
                    <th>Pilihan</th>
                </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
                @foreach ($buku as $item)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $item->judul }}</td>
                        <td>{{ $item->penulis }}</td>
                        <td>{{ $item->penerbit }}</td>
                        <td>{{ $item->tahunterbit }}</td>
                        @role('admin')
                        <td>
                          <a href="#" class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#modal-editadmin-{{ $item->id }}" data-id="{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </a>                 
                          <form action="{{ route('hapus', ['buku' => $item->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" name="delete_button">
                                <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </td>
                        @endrole
                        @role('petugas')
                        <td>
                          <a href="#" class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#modal-editadmin-{{ $item->id }}" data-id="{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </a>                 
                          <form action="{{ route('hapus', ['buku' => $item->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" name="delete_button">
                                <i class="fas fa-trash"></i>
                            </button>
                          </form>
                        </td>
                        @endrole
                        @role('user')
                            <td>
                                <a href="#" class="btn btn-primary btn-sm borrowBtn" data-toggle="modal" data-target="#modal-detailpinjam-{{ $item->id }}" data-id="{{ $item->id }}">
                                    PINJAM
                                </a>  
                            </td>
                        @endrole
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
    
    
      <!-- /.card-body -->
    </div>
  </section>
  </div>
  <!-- /.content-wrapper -->