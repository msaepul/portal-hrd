@extends('layout.landinglayout')

@section('title', 'Detail_Wo')

@section('content')
    <div class="main-content">
        <!-- Header -->
        <div class="header bg-white pt-5 pb-7">
            <div class="container">
                <div class="header-body">
                    <div class="row align-items-center">
                        <div class="col-lg-8">
                            <div class="pr-5 header-text">
                                <div class="mt-7">
                                </div>
                                <!-- Tambahkan class "header-text" pada elemen yang ingin diberikan efek transparan -->
                                <h1 class="display-2 text-white font-weight-bold mb-0">
                                    {{ getPTCabang($loker->id_cabang) }}
                                </h1>
                                <h2 class="display-4 text-white font-weight-light">
                                    {{ getAlamatCabang($loker->id_cabang) }}
                                </h2>
                                <p class="display-4 text-white mt-4">{{ getNameDept($loker->id_dept) }}</p>

                                <div class="mt-7">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <section class="py-100 section-nucleo-icons bg-white overflow-hidden">
        <form action="{{ route('applylokerstore') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" value="{{ $loker->id_loker }}" name="idloker">
            <input type="hidden" value="{{ $loker->id_cabang }}" name="cabang">
            <div class="container">
                <div class="row">
                    <div class="container">
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <br>
                                <h3 style="color: #2e0e00">Data Pribadi </h3>
                            </div>
                            <div class="col-lg-9">
                                <br>
                                <div class="form-row">
                                    <div class="col-md-12 mb-3">
                                        <div class="form-row">
                                            <div class="col-md-12 mb-3">
                                                <label class="form-control-label" for="validationCustom01">Nama
                                                    Lengkap</label>
                                                <input type="text" class="form-control" id="validationCustom01"
                                                    value="{{ $user->name }}" placeholder="First name" disabled required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-control-label" for="validationCustom01">E-mail</label>
                                                <input type="email" class="form-control" id="validationCustom01"
                                                    placeholder="Alamat Email" value="{{ $user->email }}" disabled
                                                    required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label class="form-control-label" for="validationCustom01">Nomor
                                                    Telephon / HP</label>
                                                <input type="text" class="form-control" id="validationCustom01"
                                                    placeholder="Nomor" value="{{ $user->nomor }}" disabled required>
                                                <div class="valid-feedback">
                                                    Looks good!
                                                </div>
                                            </div>
                                        </div>
                                        @if ($loker->gender === 1)
                                            <label class="form-control-label" for="validationCustom01">Jenis Kelamin</label>
                                            <div class="row">
                                                <div class="custom-control custom-radio mb-3 ml-3">
                                                    <input class="custom-control-input" id="lakilaki" name="jenis_kelamin"
                                                        type="radio" value="laki-laki">
                                                    <label class="custom-control-label" for="lakilaki">Laki-laki</label>
                                                </div>
                                                <div class="custom-control custom-radio mb-3 ml-3">
                                                    <input class="custom-control-input" id="perempuan" name="jenis_kelamin"
                                                        type="radio" value="perempuan">
                                                    <label class="custom-control-label" for="perempuan">Perempuan</label>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($loker->date_birth === 1)
                                            <label class="form-control-label" for="validationCustom01">Tempat, Tanggal
                                                Lahir</label>
                                            <input type="date" class="form-control mb-3" id="validationCustom01"
                                                name="birth" placeholder="First name" required>
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-control-label" for="provinsi">Provinsi</label>
                                                    <select class="form-control" id="pro" name="provinsi"
                                                        data-toggle="select" required>
                                                        <option value="" disabled selected>Pilih Provinsi</option>
                                                        @foreach ($provinsi as $p)
                                                            <option value="{{ $p->id }}">{{ $p->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-control-label" for="kota">kota</label>
                                                    <select class="form-control" id="kota" name="kota"
                                                        data-toggle="select" required>
                                                        {{-- <option value="">Pilih Kota</option> --}}
                                                        {{-- @foreach ($kota as $k)
                                                        <option value="{{ $k->id }}">{{ $k->name }}</option>
                                                    @endforeach --}}
                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-control-label" for="kecamatan">kecamatan</label>
                                                    <select class="form-control" id="kecamatan" name="kecamatan"
                                                        data-toggle="select" required>

                                                    </select>
                                                    <div class="valid-feedback">
                                                        Looks good!
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                        {{-- @if ($loker->profile_image === 1)
                                            <div class="form-row">
                                                <div class="col-md-4 mb-3">
                                                    <label class="form-control-label"
                                                        for="validationCustom01">Photo</label>
                                                    <input type="file" class="form-control" id="validationCustom01"
                                                        name="photo" placeholder="First name" value="Mark" required>

                                                </div>
                                            </div>
                                        @endif --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- @if ($loker->resume == 1)
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <h3 style="color: #2e0e00">CV atau Resume</h3>
                                </div>
                                <div class="col-lg-9">

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input type="file" class="form-control" id="cv" name="cv"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($loker->kartu_keluarga == 1)
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <h3 style="color: #2e0e00">Scan Kartu Keluarga</h3>
                                </div>
                                <div class="col-lg-9">

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input type="file" class="form-control" id="kartu_keluarga"
                                                name="kartu_keluarga" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($loker->ktp == 1)
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <h3 style="color: #2e0e00">Scan KTP</h3>
                                </div>
                                <div class="col-lg-9">

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input type="file" class="form-control" id="ktp" name="ktp"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($loker->vaksin == 1)
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <h3 style="color: #2e0e00">Kartu vaksin</h3>
                                </div>
                                <div class="col-lg-9">

                                    <div class="form-row">
                                        <div class="col-md-4 mb-3">
                                            <input type="file" class="form-control" id="vaksin" name="vaksin"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif --}}
                        <hr>
                        <div class="row">
                            <div class="col-lg-3">
                                <br>
                                <h3 style="color: #2e0e00">Berkas</h3>
                            </div>
                            <div class="col-lg-9">
                                <div class="form-row">
                                    @if ($loker->lamaran === 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="Lamaran Kerja">Surat Lamaran
                                                Kerja</label>
                                            <input type="file" class="form-control" id="lamaran" name="lamaran"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->profile_image === 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="Pas Photo">Pas Photo</label>
                                            <input type="file" class="form-control" id="photo" name="photo"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->resume == 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="CV atau Resume">CV atau Resume</label>
                                            <input type="file" class="form-control" id="cv" name="cv"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->kartu_keluarga == 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="Pas Photo">Kartu Kelurga</label>
                                            <input type="file" class="form-control" id="kartu_keluarga"
                                                name="kartu_keluarga" placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->ktp == 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="KTP">KTP</label>
                                            <input type="file" class="form-control" id="ktp" name="ktp"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->ijazah == 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="Ijazah / Transkrip Nilai">Ijazah /
                                                Transkrip Nilai</label>
                                            <input type="file" class="form-control" id="ijazah" name="ijazah"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->pengalaman == 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="pengalaman">Pengalaman
                                                Kerja (pakelarin)</label>
                                            <input type="file" class="form-control" id="pengalaman" name="pengalaman"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                    @if ($loker->vaksin == 1)
                                        <div class="col-md-6 mb-3">
                                            <label class="form-control-label" for="vaksin">vaksin</label>
                                            <input type="file" class="form-control" id="vaksin" name="vaksin"
                                                placeholder="First name" value="Mark" required>

                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if ($loker->cv === 1)
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <h3 style="color: #2e0e00">Cover Letter</h3>
                                </div>
                                <div class="col-lg-9">

                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <textarea type="text" class="form-control" id="cover" name="cover" placeholder="First name" required
                                                style="width: 100%; height: 200px;"></textarea>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        @if ($loker->tac === 1)
                            <hr>
                            <div class="row">
                                <div class="col-lg-3">
                                    <br>
                                    <h3 style="color: #2e0e00">Syarat dan Ketentuan</h3>
                                </div>
                                <div class="col-lg-9">

                                    <div class="form-row">
                                        <div class="col-md-12 mb-3">
                                            <textarea type="text" class="form-control" id="validationCustom01" placeholder="First name" required
                                                style="width: 100%; height: 900px;">Syarat dan
                                        Ketentuan (“Syarat dan Ketentuan”) ini dan segala peraturan atau kebijakan lain yang
                                        tersedia pada aplikasi Sribuu merupakan perjanjian-perjanjian yang mengikat
                                        berdasarkan Hukum yang Berlaku antara Pengguna dan PT Maju Bersama Alia

                                        Kami mewajibkan Anda untuk membaca seluruh isi Perjanjian dan apabila Anda memiliki
                                        pertanyaan apapun mengenai Perjanjian, Anda dapat menghubungi Kami melalui
                                        admin@sribuu.id.

                                        1. Definisi
                                        “Afiliasi” berarti (i) pihak pengendali dari; (ii) anak perusahaan dari; atau (iii)
                                        pihak yang berada dalam satu pengendalian dengan PT Maju Bersama Alia.
                                        “Perjanjian” berarti Syarat dan Ketentuan ini, Kebijakan Privasi, dan segala
                                        peraturan atau kebijakan lain yang tersedia pada Aplikasi, termasuk semua syarat dan
                                        ketentuan, serta kebijakan tambahan atau modifikasi lain yang berkaitan dengan
                                        Aplikasi atau segala layanan yang tersedia saat ini atau yang mungkin ditawarkan
                                        oleh Sribuu di masa depan. Perjanjian ini dibuat sesuai dengan Ketentuan
                                        Undang-Undang No. 11 Tahun 2008 tentang Informasi dan Transaksi Elektronik
                                        sebagaimana telah diubah oleh Undang-Undang No. 19 Tahun 2016 tentang Perubahan atas
                                        Undang-Undnag Nomor 11 Tahun 2008 tentang Informasi dan Transaksi Elektronik, dan
                                        semua peraturan pelaksananya dan perubahannya. Perjanjian ini adalah bukti rekam
                                        secara elektronik yang dihasilkan oleh sistem komputer dan tidak memerlukan tanda
                                        tangan fisik atau digital.
                                        “Hukum yang Berlaku” berarti setiap perundangan, undang-undang, kitab undang-undang,
                                        hukum (termasuk common law dan keadilan), peraturan, aturan, ordonansi, perintah,
                                        surat keputusan, amar putusan, penetapan, putusan atau keputusan dari instansi
                                        pemerintah mana pun.
                                        “Aplikasi” berarti situs web Sribuu di https://www.sribuu.id, aplikasi seluler
                                        Sribuu yang dikembangkan oleh PT Maju Bersama Alia di platform Android dan iOS, dan
                                        situs lain yang telah resmi dikembangkan Sribuu untuk mendukung ekosistem Layanan.
                                        “Pin Otorisasi” berarti kode sandi yang Pengguna buat dengan tujuan untuk
                                        menggunakan dan menjalankan fitur-fitur tertentu secara terbatas pada Aplikasi.
                                        “Konten” berarti setiap dan/atau seluruh informasi yang dibuat dan/atau disusun
                                        dan/atau dikembangkan dan/atau dikelola oleh Pengguna, termasuk namun tidak terbatas
                                        pada teks atau tulisan, gambar, quotes atau kutipan, foto, ilustrasi, animasi,
                                        video, rekaman suara atau musik, judul, deskripsi dan/atau setiap data dalam bentuk
                                        apapun yang disediakan dan/atau diunggah oleh Pengguna ke dalam Aplikasi, termasuk
                                        setiap tautan yang menghubungkan kepadanya. Untuk menghindari keraguan, Konten
                                        mencakup pula setiap dan/atau seluruh informasi, data, berita aktual, tulisan,
                                        gambar, kutipan, foto, ilustrasi, animasi, video, rekaman suara, yang diperoleh
                                        Pengguna dari pihak ketiga, di mana Pengguna telah memiliki kewenangan untuk
                                        menggunakan dan mendistribusikan konten tersebut.
                                        “Undang-Undang Hak Cipta” berarti Undang-Undang Nomor 28 Tahun 2014 tentang Hak
                                        Cipta dan semua peraturan pelaksananya dan perubahannya.
                                        “Hak Kekayaan Intelektual” berarti paten, merek dagang, merek jasa atau layanan, hak
                                        cipta, hak pada desain, pengetahuan, atau hak kekayaan intelektual atau industri
                                        lainnya, baik terdaftar maupun tidak terdaftar;
                                        “OTP” berarti sistem kata sandi satu kali yang digunakan Pengguna untuk mendaftarkan
                                        diri pada Aplikasi.
                                        “Informasi Pribadi” berarti informasi mengenai Pengguna yang secara pribadi dapat
                                        diidentifikasi yang dikumpulkan melalui Aplikasi, seperti nama, alamat, tanggal
                                        lahir dan pekerjaan, nomor telepon, alamat surat elektronik (e-mail), perizinan
                                        dan/atau sejenisnya, dan informasi lain yang mungkin dapat mengidentifikasi Anda
                                        sebagai Pengguna Aplikasi.
                                        “Kebijakan Privasi” berarti kebijakan yang mengatur tentang cara Sribuu
                                        mengumpulkan, mengolah, menggunakan, dan mengungkapkan data dan informasi Pengguna
                                        dalam Aplikasi.
                                        “Layanan” memiliki arti sebagaimana dimaksud pada Pasal 2 Syarat dan Ketentuan ini.
                                        “Sribuu” atau “Kami” berarti PT Maju Bersama Alia, suatu perusahaan yang didirikan
                                        berdasarkan hukum Negara Republik Indonesia, dan/ atau Afiliasi-nya.
                                        “Anda” atau “Pengguna” berarti pihak yang terdaftar sebagai pelanggan Aplikasi untuk
                                        menggunakan Layanan yang disediakan di dalam Aplikasi.</textarea>

                                        </div>
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input" id="invalidCheck" type="checkbox"
                                                value="" required>
                                            <label class="custom-control-label" for="invalidCheck">Setuju dengan Syarat
                                                dan
                                                Ketentuan</label>
                                            <div class="invalid-feedback">
                                                You must agree before submitting.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
        </form>
        <div class="row justify-content-center d-flex">
            <button class="btn btn-primary">Simpan</button>
            <button class="btn btn-secondary">Cancel</button>
        </div>

        </div>

        </div>

        <br>
        <hr>

        </div>
    </section>



@endsection
