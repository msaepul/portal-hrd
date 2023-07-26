@extends('layout.landinglayout')

@section('title', 'Detail_Wo')

@section('content')
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-warning pt-5 pb-7">
            <div class="container">
                <div class="container">
                    <div class="header-body">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="pr-5">
                                    <h1 class="display-2 text-white font-weight-bold mb-0">Argon Dashboard PRO</h1>
                                    <h2 class="display-4 text-white font-weight-light">A beautiful premium dashboard for
                                        Bootstrap 4.</h2>
                                    <p class="text-white mt-4">Argon perfectly combines reusable HTML and modular CSS with a
                                        modern styling and beautiful markup throughout each HTML template in the pack.</p>
                                    <div class="mt-5">
                                        <a href="./pages/dashboards/dashboard.html" class="btn btn-neutral my-2">Explore
                                            Dashboard</a>
                                        <a href="https://www.creative-tim.com/product/argon-dashboard-pro"
                                            class="btn btn-default my-2">Purchase now</a>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="separator separator-bottom separator-skew zindex-100">
                <svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1"
                    xmlns="http://www.w3.org/2000/svg">
                    <polygon class="fill-brown" points="2560 0 2560 100 0 100"></polygon>
                </svg>
            </div>
        </div>
    </div>
    <section class="py-7 section-nucleo-icons bg-white overflow-hidden">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <br>
                    <h2 class="display-3" style="color: #2e0e00">Pilih Lokasi Cabang Perusahaan</h2>
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
                            <div class="col-lg-6">
                                <div class="card card-lift--hover shadow border-0" id="{{ getNameCabang($l->id_cabang) }}">
                                    <a href="URL_TUJUAN" class="card-body py-5"
                                        style="display: block; text-decoration: none;">
                                        <div class="icon icon-shape bg-gradient-primary text-white rounded-circle mb-4">
                                            <i class="ni ni-check-bold"></i>
                                        </div>
                                        <h4 class="h3 text-primary text-uppercase">{{ getPTCabang($l->id_cabang) }}</h4>
                                        <p class="description mt-3">{{ $l->desc_job }}</p>
                                        <div>
                                            <span class="badge badge-pill badge-primary">bootstrap 4</span>
                                            <span class="badge badge-pill badge-primary">dashboard</span>
                                            <span class="badge badge-pill badge-primary">template</span>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>

                </div>
    </section>
@endsection
