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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Pinjaman</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr style="text-align: center;">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Judul Buku</th>
                                <th>Penerbit</th>
                                <th>Tanggal Pinjam</th>
                                <th>Tanggal Pengembalian</th>
                                <th>Status</th>
                                @role('admin')
                                <th>Pilihan</th>
                                @endrole
                                @role('petugas')
                                <th>Pilihan</th>
                                @endrole
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($peminjamans as $index => $peminjaman)
                                <tr style="text-align: center;">
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $peminjaman->user->name }}</td>
                                    <td>{{ $peminjaman->buku->judul }}</td>
                                    <td>{{ $peminjaman->buku->penerbit }}</td>
                                    <td >{{ $peminjaman->tanggal_peminjaman }}</td>
                                    <td style="text-align: center;">
                                        @empty($peminjaman->tanggal_pengembalian)
                                            -----
                                        @else
                                            {{ $peminjaman->tanggal_pengembalian }}
                                        @endempty
                                    </td>
                                    {{-- <td class="uppercase" style="color: {{ $peminjaman->status_peminjam === 'Pending' ? 'blue' : 'green' }}">
                                        {{ $peminjaman->status_peminjam }}
                                    </td> --}}
                                    @role('user')
                                    <td class="uppercase" style="color: {{ $peminjaman->status_peminjam === 'pending' ? 'red' : ($peminjaman->status_peminjam === 'success' ? 'green' : 'blue') }}">
                                        {{ $peminjaman->status_peminjam }}
                                    </td>
                                    @endrole
                                    @role('admin')
                                    <td>
                                        <form action="{{ route('update.status', ['id' => $peminjaman->id]) }}" method="post">
                                            @csrf
                                            @method('PATCH')
                                    
                                            <select name="status_peminjam" onchange="this.form.submit()">
                                                <option value="pending" {{ $peminjaman->status_peminjam === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="success" {{ $peminjaman->status_peminjam === 'success' ? 'selected' : '' }}>Success</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td>
                                        @if($peminjaman->status_peminjam === 'pending')
                                            <span class="text-warning">Belum di-ACC</span>
                                        @elseif($peminjaman->status_peminjam === 'success')
                                            <button onclick="kembalikanBuku({{ $peminjaman->id }})" class="btn btn-primary btn-sm">Kembalikan</button>
                                        @endif
                                    </td>
                                    @endrole
                                    @role('petugas')
                                    <td>
                                        @if($peminjaman->status_peminjam === 'pending')
                                            <span class="text-warning">Belum di-ACC</span>
                                        @elseif($peminjaman->status_peminjam === 'success')
                                            <button onclick="kembalikanBuku({{ $peminjaman->id }})" class="btn btn-primary btn-sm">Kembalikan</button>
                                        @endif
                                    </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>