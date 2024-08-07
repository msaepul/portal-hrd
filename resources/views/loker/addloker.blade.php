@extends('layout.mainlayout')

@section('title', 'Detail_Wo')

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Lowongan Kerja</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                                <li class="breadcrumb-item"><a href="#">Tables</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Datatables</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-lg-6 col-5 text-right">
                        <a href="#" class="btn btn-sm btn-neutral">New</a>
                        <a href="#" class="btn btn-sm btn-neutral">Filters</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('addloker.store') }}" method="POST">
        @csrf
        <!-- Page content -->
        <div class="container-fluid mt--6 d-flex justify-content-center align-items-center">
            <div class="card d-flex col-lg-10 mb-2">
                <!-- Card header -->
                <div class="card-header">
                    <h2 class="mb-0">
                        <center>Form input Lowongan Pekerjaan <center>
                    </h2>
                </div>
                <!-- Card body -->
                <div class="card-body">
                    <!-- Form groups used in grid -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols1Input">Cabang</label>
                                <input type="text" class="form-control" id="example3cols1Input" placeholder="Cabang"
                                    name="id_cabang2" id="id_cabang" value="{{ getPTCabang(auth()->user()->id_cabang) }}"
                                    readonly>
                                <input type="hidden" name="id_cabang" value="{{ auth()->user()->id_cabang }}">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols3Input">Departemen</label>
                                <select class="form-control" id="id_dept" name="id_dept" id="id_dept"
                                    data-toggle="select">
                                    <option value="" disabled>Pilih Departement</option>
                                    @foreach ($depts as $d)
                                        <option value="{{ $d->id }}">{{ $d->departemen }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols2Input">Deskripsi Pekerjaan</label>
                                <div data-toggle="quill" data-quill-placeholder="Quill WYSIWYG" name="quill1"></div>
                                <input type="hidden" name="quill_content1" id="quillContent1">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label" for="example2cols2Input">Persyaratan Pekerjaan</label>
                                <div data-toggle="quill" data-quill-placeholder="Quill WYSIWYG" name="quill2"></div>
                                <input type="hidden" name="quill_content2" id="quillContent2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols1Input">Tanggal Lamaran dibuka</label>
                                <input type="date" name="start_date" class="form-control" id="example3cols1Input"
                                    placeholder="One of three cols">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols2Input">Tanggal Lamaran ditutup</label>
                                <input type="date" name="end_date" class="form-control" id="example3cols2Input"
                                    placeholder="One of three cols">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-6">
                            <input class="custom-control-input" id="select-all" type="checkbox">
                            <label class="custom-control-label" for="select-all">Select All</label>
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols1Input">Ask Application For</label>
                                <div class="row">
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="gender" name="gender"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="gender">Jenis Kelamin</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <!-- Tambahkan class "ml-3" di sini -->
                                        <input class="custom-control-input" id="date_birth" name="date_birth"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="date_birth">Tanggal Lahir</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <!-- Tambahkan class "ml-3" di sini -->
                                        <input class="custom-control-input" id="country" name="country"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="country">Asal Tempat</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label" for="example3cols1Input">Data yang ingin
                                    ditampilkan</label>
                                {{-- <div class="custom-control custom-checkbox mb-3 ml-3">
                                </div> --}}
                                <div class="row">
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="profile_image" name="profile_image"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="profile_image">Pas Photo</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="lamaran" name="lamaran"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="lamaran">Lamaran</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="ijazah" name="ijazah"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="ijazah">Ijazah / Transkrip
                                            Nilai</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="pengalaman" name="pengalaman"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="pengalaman">Pengalaman Kerja</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="kartu_keluarga" name="kartu_keluarga"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="kartu_keluarga">Kartu Keluarga</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="ktp" name="ktp"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="ktp">KTP</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <input class="custom-control-input" id="vaksin" name="vaksin"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="vaksin">vaksin</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <!-- Tambahkan class "ml-3" di sini -->
                                        <input class="custom-control-input" id="resume" name="resume"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="resume">Daftar Riwayat Hidup</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <!-- Tambahkan class "ml-3" di sini -->
                                        <input class="custom-control-input" id="cv" name="cv"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="cv">Surat Pengantar</label>
                                    </div>
                                    <div class="custom-control custom-checkbox mb-3 ml-3">
                                        <!-- Tambahkan class "ml-3" di sini -->
                                        <input class="custom-control-input" id="tac" name="tac"
                                            type="checkbox" value="1">
                                        <label class="custom-control-label" for="tac">Syarat dan Ketentuan</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-control-label" for="example2cols2Input">Skill yang diperlukan</label>
                            <select name="id_skill[]" multiple="multiple" class="form-control js-example-basic-multiple"
                                data-toggle="select">
                                @foreach ($skills as $skill)
                                    <option value="{{ $skill->id }}">{{ $skill->nama_skill }}</option>
                                @endforeach
                            </select>
                        </div>
                        <hr>

                    </div>
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button class="btn btn-secondary">Cancel</button>
                </div>
            </div>
        </div>
    </form>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var quill1 = new Quill('[name="quill1"]', {
                theme: 'snow'
            });

            quill1.on('text-change', function() {
                var quillContent1 = quill1.root.innerHTML;
                document.getElementById('quillContent1').value = quillContent1;
            });

            var quill2 = new Quill('[name="quill2"]', {
                theme: 'snow'
            });

            quill2.on('text-change', function() {
                var quillContent2 = quill2.root.innerHTML;
                document.getElementById('quillContent2').value = quillContent2;
            });
        });
    </script>
    <script>
        // Set nilai 1 saat checkbox diaktifkan (checked) dan nilai 0 saat dinonaktifkan (unchecked)
        $(document).ready(function() {
            $('input[type="checkbox"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $(this).val('1');
                } else {
                    $(this).val('0');
                }
            });
        });
    </script>
    <script>
        $('.js-example-basic-multiple').select2();
    </script>
    <script>
        $(document).ready(function() {
            // Select all checkboxes when the "Select All" checkbox is clicked
            $("#select-all").change(function() {
                $("input:checkbox").prop('checked', $(this).prop("checked"));
            });

            // Uncheck the "Select All" checkbox if any individual checkbox is unchecked
            $("input:checkbox").change(function() {
                if (!$(this).prop("checked")) {
                    $("#select-all").prop('checked', false);
                }
            });
        });
    </script>

@endsection
