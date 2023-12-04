@extends('layouts.administrator1')

@section('nav')
    <ul class="navbar-nav mx-auto text-uppercase">
        {{-- <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.dashboard') }}">Dashboard</a>
        </li> --}}
        
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('admin.beranda') }}">Informasi</a>
        </li>
        <li class="nav-item active">
            <a class="nav-link" href="{{ route('daftar_userr') }}">Daftar Pengguna</a>
        </li> 
    </ul>
@endsection

@section('content')
        <section class="slider">
            <div class="container">
            @if (isset($user) != 0)
                <div id="carouselExampleControls" class="carousel slide mt-5" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="container">
                            {{-- @foreach ($user as $data)


                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div class="row p-5 justify-content-center d-flex align-items-center">
                                        <div class="col-lg-4 text-center">
                                            <img src="{{ Storage::url('img/' . $data->photo) }}" class="figure-img img-fluid"
                                                alt="...">
                                        </div>
                                        <div class="col-lg-6">
                                            <h4 class="mb-3">{{ $data->judul_berita }}</h4>
                                            <p class="mb-2">{{ Str::limit($data->detail_berita, 100, '...') }}
                                                @if (Str::length($data->detail_berita) >= 100)
                                                    <a href="#" aria-pressed="true" data-toggle="modal"
                                                        data-target="#Selengkapnya{{ $data->id }}">Selengkapnya</a>
                                                @endif
                                            </p>
                                            <div class="modal fade" id="Selengkapnya{{ $data->id }}" tabindex="-1"
                                                aria-labelledby="SelengkapnyaLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-xl text-left">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title mb-0" id="SelengkapnyaLabel">
                                                                {{ $data->judul_berita }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            {{ $data->detail_berita }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endforeach --}}
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @endif  
            </div>
        </section>
    @error('photo')
    <div class="alert alert-danger text-center">{{ "Mohon periksa ekstensi dan ukuran file" }}</div>
@enderror
    <section>
        <div class="container">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <div class="row d-flex align-items-center">
                                <div class="col-lg-6">
                                    <h5>Daftar Pengguna Helpdesk</h5>
                                </div>
                                {{-- <div class="col-lg-6 text-right">
                                    <a class="btn btn-sm btn-core" role="button" aria-pressed="true" data-toggle="modal"
                                        data-target="#exampleModal">Tambah User</a>
                                    <div class="modal fade" id="exampleModal" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-12 text-left">
                                                            <div class="card shadow-sm">
                                                                <div class="card-body">

                                                                    <form method="POST"
                                                                        action="{{ route('tambah_user') }}"
                                                                        enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="hidden" class="form-control"
                                                                            id="created_by" name="created_by"
                                                                            value=" {{ Session::get('id') }}">
                                                                        <div class="form-group">
                                                                            <label for="photo">Photo</label>
                                                                            <div class="custom-file">
                                                                                <input type="file" class="custom-file-input  @error('photo') is-invalid @enderror"
                                                                                    id="photo" name="photo"
                                                                                    required>
                                                                                <label class="custom-file-label"
                                                                                    for="customFile">Pilih File</label>
                                                                            </div>
                                                                            <p class="font-weight-normal mt-2">File .png
                                                                                ukuran maks. 2 MB - Resolusi gambar
                                                                                <strong>(400px X 300px)</strong></p>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="name">Nama</label>
                                                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                                                                            name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Ketikkan nama lengkap User">   
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="email">Email</label>
                                                                            {{-- <input type="email" class="form-control"
                                                                                id="email" name="email"
                                                                                required> 
                                                                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" 
                                                                            name="email" value="{{ old('email') }}" required placeholder="Ketikkan email User" autocomplete="email">    
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">Password</label>
                                                                            {{-- <input type="text" class="form-control"
                                                                                id="password" name="password"
                                                                                required> 
                                                                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" 
                                                                            name="password" required placeholder="Ketikkan password User" autocomplete="new-password">  
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="password">Konfirmasi Password</label>
                                                                            {{-- <input type="text" class="form-control"
                                                                                id="password" name="password"
                                                                                required> 
                                                                            <input id="password-confirm" type="password" class="form-control" 
                                                                            name="password_confirmation" required placeholder="Ketikkan kembali password User" autocomplete="new-password">
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="type">User Level</label>
                                                                            <div>
                                                                                <select id="type" type="number"
                                                                                    class="form-control @error('type') is-invalid @enderror"
                                                                                    name="type" required autocomplete="type" placeholder="">
                                                                                    <option disabled selected value>Pilih User Level</option>
                                                                                    <option value="2">Administrator</option>
                                                                                    <option value="1">Admin Informasi</option>
                                                                                    <option value="0">Mahasiswa</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="card-footer py-4">
                                                                            <button href="#"
                                                                                class="btn btn-core btn-block first">Tambah</button>
                                                                        </div>
                                                                    </form>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  --}}
                            </div>
                        </div>
                        <div class="card-body ">
                            <table class="table table-bordered data-table text-capitalize">
                                <thead>
                                    <tr>
                                        <th>no</th>
                                        <th>Nama</th>
                                        <th>User Level</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            @if(isset($users))
                            @foreach ($users as $data)
                                <div class="modal fade" id="Modal-{{ $data->id }}" tabindex="-1" 
                                    aria-labelledby="DetailLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Detail Informasi
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row text-left">
                                                    <div class="col-md-12">
                                                        <div class="card shadow-sm">
                                                            <div class="card-body  table-responsive">
                                                                <table class="table table-bordered" style="width:100%">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>Nama</td>
                                                                            <td> <div class="text-capitalize">{{ $data->name }}</div></td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Email</td>
                                                                            <td>{{ $data->email }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Password</td>
                                                                            <td>{{ $data->password }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>Tanggal Dibuat</td>
                                                                            <td>{{ $data->created_at }}</td>
                                                                        </tr>
                                                                        
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="modal fade" id="exampleModalll{{ $data->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Delete</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda Yakin Ingin Menghapus informasi ini?</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                                                <a href="#" type="button" class="btn btn-core">Ya</a>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer text-center">
            Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.
        </div>
    </section>
@endsection


@section('script')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            var table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('daftar_userr') }}",
                columns: [
                    
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'type',
                        name: 'type'
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                columnDefs: [{
                    "targets": 3, // your case first column
                    "className": "text-center",
                    "width": "300",

                },
                {
                    "targets": 0,
                    "visible": false,
                } ],
            });
        });

        // $(function() {
        // $.getScript("https://www.jqueryscript.net/demo/Delete-Confirmation-Dialog-Plugin-with-jQuery-Bootstrap/bootstrap-confirm-delete.js", function(){
        //     $('.delete').bootstrap_confirm_delete({
        //         heading: 'Delete',
        //         message: 'Are you sure you want to delete this information?'
        //     });
        //     });
        // });
    </script>
@endsection
