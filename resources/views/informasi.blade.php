@extends('layouts.app')


@section('nav')

    <li class="nav-item">
        <a class="nav-link" href="{{ route('welcome') }}">Beranda</a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="{{ route('profil') }}">Profil</a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link active" href="{{ route('informasi') }}">Informasi</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="https://api.whatsapp.com/send/?phone=6281990550055">Helpdesk <i class="bi bi-whatsapp"></i></a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ route('login') }}">Login</a>
    </li>

@endsection
@section('content')
    <!-- Header -->
    <section class="header">
        <div class="container">
            <div class="row d-flex align-items-center">
                <div class="col-xl-12 text-center">
                    <h1><span>INFORMASI HELPDESK FAKULTAS TEKNIK  UNIVERSITAS SILIWANGI</span></h1>
                    <!--<p>Temukan informasi mengenai HELPDESK FT UNSIL.</p>-->
                </div>
            </div>
        </div>
    </section>
    <!-- End of Header -->

    <section class="content">
        <div class="container">
            <div class="row text-center">
                @foreach ($berita as $data)


                    <div class="col-md-4 mb-2">
                        <figure class="figure bg-white">
                            <div class="figure-img">
                                <img src="{{ Storage::url('img/' . $data->gambar) }}" class="figure-img img-fluid" alt="...">
                            </div>
                            <figcaption class="figure-caption">
                                <h5>{{ $data->judul_berita }}</h5>
                                <p>{{ Str::limit($data->detail_berita, 100, '...') }}
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
                                                <h5 class="modal-title mb-0" id="exampleModalLabel">
                                                    {{ $data->judul_berita }}</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                {{ $data->detail_berita }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </figcaption>
                        </figure>


                    </div>


                @endforeach
            </div>
        </div>
    </section>
    <!-- footer -->
    <footer class="border-top p-3">
        <div class="container">
            <div class="row text-center mt-3">
                <div class="col text-light">
                    <p>Copyright &copy; 2023 &mdash; Helpdesk Fakultas Teknik Universitas Siliwangi | All right reserved.</p>
                </div>
            </div>
        </div>
    </footer>
    <!-- End of Footer -->

@endsection
