@extends('admin.index')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/quill.snow.css') }}" rel="stylesheet">
<script src="{{ asset('js/app.js') }}" defer></script>
<script src="{{ asset('js/quill.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

@section('isi')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Tambah Postingan</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboardadmindesa">Home</a></li>
                    <li class="breadcrumb-item"><a href="pariwisata">Postingan</a></li>
                    <li class="breadcrumb-item">Tambah Postingan</li>
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
                        <h5 class="card-title">Tambah Postingan</h5>
                        <form action="{{ route('tambahpost') }}" method="POST" enctype="multipart/form-data"
                            class="row g-3">
                            @csrf
                            <!-- Vertical Form -->
                            <form class="row g-3">
                                <div class="row mb-3">
                                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Image Image</label>
                                    <div class="col-md-8 col-lg-9">
                    <img id="showImage" src="{{ (!empty($data->cover)) ? asset('storage/admin_images/' . $data->cover) : asset('upload/no_image.png') }}"  alt="Profile"
                    class="rounded-rectangle"
                    style="width: 120px; height: 120px; object-fit: cover; border-radius: 50%; margin: 0 auto; display: block;">

                                  </div>
                              </div>

                                <label>
                                    <p class="mb-0 fw-bold">Masukkan Cover</p>
                                    <div class="input-group mb-3">
                                        <input type="file" class="form-control @error('cover') is-invalid @enderror"
                                            name="cover" id="image">
                                        @error('cover')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </label>
                                <div class="col-12">
                                    <label for="judul" class="form-label fw-bold">Judul postingan</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                        name="judul" id="judul">

                                </div>
                                <div class="col-12">
                                    <label for="koordinat" class="form-label fw-bold">Subjudul Postingan</label>
                                    <textarea type="text" class="form-control @error('subjudul') is-invalid @enderror" name="subjudul" id="subjudul"></textarea>
                                    <div class="col-12">
                                        <label for="tangga" class="form-label fw-bold">Tanggal Postingan</label>
                                        <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                            name="tanggal" id="tanggal">

                                    </div>
                                </div>
                                <div id="editor-container" class="col-12">
                                    <label for="isi" class="form-label fw-bold">Isi Postingan</label>
                                    <textarea class="form-control @error('isi') is-invalid @enderror" id="editor" name="isi" cols="30"
                                        rows="10" placeholder="Tuliskan isi artikel disini"></textarea>
                                    @error('isi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>  <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-primary">Tambahkan</button>
                                </div>
                            </form><!-- Vertical Form -->
                            <a href="postingan"> <button type="submit" class="btn btn-danger">Kembali</button></a>

                    </div>
                </div>


            </div>
            </div>
        </section>
        <script type="text/javascript">
            $(document).ready(function(){
            $('#image').change(function(e){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);

                });
            });
        </script>


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
    $(document).ready(function() {
        var quill = new Quill('#editor', {
            theme: 'snow'
        });
    });
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
