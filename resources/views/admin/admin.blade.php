  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Petugas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/dashboard">Home</a></li>
              <li class="breadcrumb-item active">Nambahpetugas</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->

      <!-- Modal -->
      <div class="modal fade" id="modal-addadmin">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title font-weight-bold">Tambah Petugas</h4>
            </div>

            {{-- modal add --}}
            <div class="modal-body">
              <form action="{{ route('addadmin') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan Nama" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="namalengkap">Nama Lengkap</label>
                        <input type="text" class="form-control" id="namalengkap" name="namalengkap" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="contoh@gmail.com" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat">Alamat</label>
                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukkan Alamat" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control" id="role" name="role">
                            <option value="admin">Admin</option>
                            <option value="petugas" selected>Petugas</option>
                            <option value="peminjam">Peminjam</option>
                        </select>
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

      @foreach ($data as $item)
      <!-- Modal Edit -->
      <div class="modal fade" id="modal-editadmin-{{ $item->id }}">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title font-weight-bold">Edit Petugas</h4>
                  </div>
  
                  <!-- Formulir Edit -->
                  <div class="modal-body">
                      <form action="{{ route('editadmin', ['id' => $item->id]) }}" method="POST">
                          @csrf
                          @method('PUT')
                          <div class="card-body">
                              <div class="form-group">
                                  <label for="name">Username</label>
                                  <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}" placeholder="Masukkan Nama" autofocus>
                              </div>
                              <div class="form-group">
                                  <label for="namalengkap">Nama Lengkap</label>
                                  <input type="text" class="form-control" id="namalengkap" name="namalengkap" value="{{ $item->namalengkap }}" placeholder="Masukkan Nama Lengkap" required>
                              </div>
                              <div class="form-group">
                                  <label for="email">Email</label>
                                  <input type="email" class="form-control" id="email" name="email" value="{{ $item->email }}" placeholder="contoh@gmail.com" required>
                              </div>
                              <div class="form-group">
                                  <label for="alamat">Alamat</label>
                                  <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $item->alamat }}" placeholder="Masukkan Alamat" required>
                              </div>
                              <div class="form-group">
                                  <label for="password">Password</label>
                                  <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Ulang">
                              </div>
                              <div class="form-group">
                                  <label for="role">Role</label>
                                  <select class="form-control" id="role" name="role">
                                      <option value="admin" {{ $item->role == 'admin' ? 'selected' : '' }}>Admin</option>
                                      <option value="petugas" {{ $item->role == 'petugas' ? 'selected' : '' }}>Petugas</option>
                                      <option value="peminjam" {{ $item->role == 'peminjam' ? 'selected' : '' }}>Peminjam</option>
                                  </select>
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
  




    <!-- /.content-header -->
    <div class="card">
      <div class="card-header text-right mb-3">
        <h3 class="card-title">Data Petugas PerpusTakaan</h3>
        <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#modal-addadmin"><i class="fas fa-plus"></i> Tambah Petugas</a>
        @role('admin')
              <div class="float-right">
                  <div class="dropdown">
                      <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="downloadDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Download
                      </button>
                      <div class="dropdown-menu" aria-labelledby="downloadDropdown">
                          <a class="dropdown-item" href="{{ route('petugas.download.pdf') }}"><i class="fa-regular fa-file-pdf"></i></a>
                          <a class="dropdown-item" href="{{ route('petugas.download.excel') }}"><i class="fa-regular fa-file-excel"></i>l</a>
                      </div>
                  </div>
              </div>
              @endrole
              @role('petugas')
              <div class="float-right">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-sm" type="button" id="downloadDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Download
                    </button>
                    <div class="dropdown-menu" aria-labelledby="downloadDropdown">
                        <a class="dropdown-item" href="{{ route('petugas.download.pdf') }}"><i class="fa-regular fa-file-pdf"></i></a>
                        <a class="dropdown-item" href="{{ route('petugas.download.excel') }}"><i class="fa-regular fa-file-excel"></i>l</a>
                    </div>
                </div>
            </div>
              @endrole
      </div>

      <div class="card-body">
        <table class="table table-bordered table-striped" style="border-width: 2px; border-color: dark;">
            <thead>
                <tr style="text-align: center;">
                    <th>No</th>
                    <th>Nama</th>
                    <th>Username</th>
                    <th>Email</th>
                    {{-- <th>Password</th> --}}
                    <th>Alamat</th>
                    <th>Pilihan</th>
                </tr>
            </thead>
            <tbody>
              @php
                  $no = 1;
              @endphp
                @foreach ($data as $item)

                    <tr>
                        <td>{{ $no++ }}</td>

                        <td>{{ $item->name }}</td>
                        <td>{{ $item->namalengkap }}</td>
                        <td>{{ $item->email }}</td>
                        {{-- <td>{{ $item->password }}</td> --}}
                        <td>{{ $item->alamat }}</td>
                        <td>
                          <a href="#" class="btn btn-warning btn-sm editBtn" data-toggle="modal" data-target="#modal-editadmin-{{ $item->id }}" data-id="{{ $item->id }}">
                            <i class="fas fa-edit"></i>
                        </a>                 
                          <form action="{{ route('delete', ['user' => $item->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus?')" name="delete_button">
                                <i class="fas fa-trash"></i>
                            </button>
                          </form>
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