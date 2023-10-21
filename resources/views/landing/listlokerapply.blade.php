@extends('layout.landinglayout')

@section('title', 'Detail_Wo')

@section('content')
    <div id="alert-container">
        @if (session('success'))
            <div class="alert alert-success">
                <center>
                    <h2>{{ session('success') }}</h2>
                </center>
            </div>
        @endif
    </div>

    <div class="main-content">
        <!-- Header -->
        <div class="header bg-white pt-5 pb-7">
            <div class="container">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="pr-5 header-text">
                                <!-- Tambahkan class "header-text" pada elemen yang ingin diberikan efek transparan -->
                                <div class="mt-7">

                                </div>
                                @if (Auth::check())
                                    <h1 class="display-2 text-white font-weight-bold mb-0">SELAMAT DATANG
                                        {{ Auth::user()->name }}!!
                                    @else
                                        <h1 class="display-2 text-white font-weight-bold mb-0">SELAMAT DATANG!!
                                @endif

                                </h1>

                                <p class="text-white mt-4">Jordan Bakery selalu berupaya Mengusahakan kesejahteraan
                                    karyawan dan memberkati lingkungan di manapun berada.

                                    .</p>
                                <div class="mt-5">
                                    @auth
                                        <a href="{{ route('index') }}" class="btn btn-secondary text-dark">Kembali ke Halaman
                                            Awal</a>
                                    @endauth


                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-7 section-nucleo-icons bg-white overflow-hidden">

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <br>

                    <h2 class="display-3" style="color: #2e0e00">Lokasi Cabang Perusahaan yang telah dilamar</h2>
                    <p class="lead">
                    <div class="row d-flex justify-content-between">
                        <div class="row"></div>
                        @foreach ($cabang as $cab)
                            <div class="col">
                                <button class="btn btn-outline-warning btn-block btn-oval btn-md"
                                    data-target="{{ $cab->keterangan }}">{{ $cab->keterangan }}</button>
                            </div>
                        @endforeach
                        </p>

                    </div>
                    <br>
                    <div class="row">
                        @foreach ($loker as $l)
                            <div class="col-lg-12">
                                <span class="card card-lift--hover shadow border-2" id="{{ getNameCabang($l->id_cabang) }}"
                                    disabled>

                                    <div class="icon icon-shape bg-gradient-primary text-white rounded-circle mb-4">
                                        <i class="ni ni-check-bold"></i>
                                    </div>
                                    <h4 class="h3 text-primary text-uppercase">{{ getPTCabang($l->id_cabang) }}</h4>
                                    <p class="description mt-3">
                                        {!! $l->desc_job !!}
                                    </p>

                                    <div>
                                        @foreach ($l->id_skill as $idSkill)
                                            <span class="badge badge-pill badge-primary">{{ getNameSkill($idSkill) }}</span>
                                        @endforeach


                                    </div>

                                </span>



                            </div>
                        @endforeach
                    </div>

                </div>
    </section>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Sembunyikan pesan sukses setelah 5 detik
            setTimeout(function() {
                $('#alert-container').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, 5000); // 5000 milidetik (5 detik)
        });
    </script>

@endsection
