@extends('admin.index')
@section('isi')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Edit postingan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboardadmindesa">Home</a></li>
                    <li class="breadcrumb-item"><a href="penghargaan">postingan</a></li>
                    <li class="breadcrumb-item">Edit postingan</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section">
            <div class="row">
                <div class="col-lg-6">




                </div>
            </div>

            </div>

            <div class="col-lg-12 ms-auto me-auto">

                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Edit postingan</h5>
                        <form class="row g-3" action="/editpost/{{ $data->id }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <!-- Vertical Form -->
                            <form class="row g-3">
                                <label for="defaultFormControlInput" class="form-label mb-3 fw-bold">Gambar</label>
                                <div class="mb-3 row">
                                    <div class="col-12">
                                        <img src="{{ asset('storage/admin_post/' . $data->cover) }} " alt="" width="200px"
                                            height="200px" class="my-3">
                                        <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                            name="cover" id="cover" value="{{ $data->cover }}">
                                        @error('cover')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                              
                                <div class="col-12">
                                    <label for="judul" class="form-label fw-bold">Judul postingan</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        name="judul" id="judul" value="{{ $data->judul }}">
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="subjudul" class="form-label fw-bold">Subjudul postingan</label>
                                    <input type="text" class="form-control @error('subjudul') is-invalid @enderror"
                                        name="subjudul" id="subjudul" value="{{ $data->subjudul }}">
                                    @error('subjudul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="tanggal" class="form-label fw-bold">Tanggal</label>
                                    <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                        name="tanggal" id="tanggal" value="{{ $data->tanggal }}">
                                    @error('tanggal')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <label for="isi" class="form-label fw-bold">Isi postingan</label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" id="editor" name="isi" cols="30"
                                        rows="10" placeholder="Tuliskan isi pengahargaan disini">{!! $data->isi !!}</textarea>
                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Ubah</button>
                                </div>
                            </form><!-- Vertical Form -->
                            <a href="/postingan"> <button type="submit" class="btn btn-danger">Kembali</button></a>

                    </div>
                </div>


            </div>
            </div>
        </section>



        <script>
            jQuery(document).ready(function() {
                ImgUpload();
            });

            function ImgUpload() {
                var imgWrap = "";
                var imgArray = [];
                $('.upload__inputfile').each(function() {
                    $(this).on('change', function(e) {
                        imgWrap = $(this).closest('.upload_box').find('.upload_img-wrap');
                        var maxLength = $(this).attr('data-max_length');

                        var files = e.target.files;
                        var filesArr = Array.prototype.slice.call(files);
                        var iterator = 0;
                        filesArr.forEach(function(f, index) {

                            if (!f.type.match('image.*')) {
                                return;
                            }

                            if (imgArray.length > maxLength) {
                                return false
                            } else {
                                var len = 0;
                                for (var i = 0; i < imgArray.length; i++) {
                                    if (imgArray[i] !== undefined) {
                                        len++;
                                    }
                                }
                                if (len > maxLength) {
                                    return false;
                                } else {
                                    imgArray.push(f);

                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        var html =
                                            "<div class='upload__img-box'><div style='background-image: url(" +
                                            e.target.result + ")' data-number='" + $(
                                                ".upload__img-close").length + "' data-file='" + f
                                            .name +
                                            "' class='img-bg'><div class='upload__img-close'></div></div></div>";
                                        imgWrap.append(html);
                                        iterator++;
                                    }
                                    reader.readAsDataURL(f);
                                }
                            }
                            // console.log(imgArray);
                        });
                    });
                });

                $('body').on('click', ".upload__img-close", function(e) {
                    var file = $(this).parent().data("file");
                    for (var i = 0; i < imgArray.length; i++) {
                        if (imgArray[i].name === file) {
                            imgArray.splice(i, 1);
                            break;
                        }
                    }
                    $(this).parent().parent().remove();
                });
            }
        </script>
        <script>
            var quill = new Quill('#editor', {
                theme: 'snow'
            });

            quill.root.innerHTML = document.querySelector('#content').value;

            var form = document.querySelector('form');
            form.onsubmit = function() {
                // Update hidden input with content from Quill editor
                var contentInput = document.querySelector('#content');
                contentInput.value = quill.root.innerHTML;

                // Submit form
                return true;
            };
        </script>



    </main>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var quill = new Quill('#editor', {
                theme: 'snow'
            });
            $('form').on('submit', function() {
                var content = quill.getContents();
                $('input[name="content"]').val(JSON.stringify(content));
            });
        });
    </script>
@endsection
@section('editor')
    <script src="{{ asset('assets/js/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('editor');
    </script>
@endsection
