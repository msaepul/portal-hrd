@extends('layout.mainlayout')

@section('title', 'Detail_Wo')

@section('content')
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Lowonga Kerja</h6>
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
    <!-- Page content -->
    <div class="container-fluid mt--6 d-flex justify-content-center align-items-center">
        <div class="card d-flex col-lg-10 mb-2">
            <!-- Card header -->
            <div class="card-header">
                <h3 class="mb-0">Form group in grid</h3>
            </div>
            <!-- Card body -->
            <div class="card-body">
                <!-- Form groups used in grid -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="example3cols1Input">Cabang</label>
                            <input type="text" class="form-control" id="example3cols1Input" placeholder="Cabang">
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="example3cols3Input">Departemen</label>
                            <input type="text" class="form-control" id="example3cols3Input" placeholder="Departemen">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="example2cols2Input">Deskripsi Pekerjaan</label>
                            <div data-toggle="quill" data-quill-placeholder="Quill WYSIWYG"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="form-control-label" for="example2cols2Input">Persyaratan Pekerjaan</label>
                            <div data-toggle="quill" data-quill-placeholder="Quill WYSIWYG"></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="example3cols1Input">Start Date</label>
                            <input type="date" class="form-control" id="example3cols1Input"
                                placeholder="One of three cols">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="example3cols2Input">End Date</label>
                            <input type="date" class="form-control" id="example3cols2Input"
                                placeholder="One of three cols">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="example3cols1Input">Ask Application For</label>
                            <div class="custom-control custom-checkbox mb-3">
                                <input class="custom-control-input" id="customCheck1" type="checkbox">
                                <label class="custom-control-label" for="customCheck1">Unchecked</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-control-label" for="example3cols2Input">End Date</label>
                            <input type="date" class="form-control" id="example3cols2Input"
                                placeholder="One of three cols">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
