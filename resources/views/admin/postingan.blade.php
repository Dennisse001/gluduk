@extends('admin.index')
@section('isi')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Postingan Admin</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboardadmindesa">Home</a></li>
                <li class="breadcrumb-item active">Postingan</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->
    <a href={{ route('admin.uploadp') }}>
        <button style="margin-left: 13px;margin-bottom: 12px;" class="btn btn-primary btn-sm  " type="button">Tambah Postingan</button>
    </a>

    <section class="section">
        <div class="row align-items-top mx-auto">
            <div class="col-lg-12 d-flex flex-row">
                {{-- @dd($data) --}}


                @foreach ($data as $row)

                <!-- Card with an image on top -->
                <div class="card me-2 col-3">
                    <div class="card" style="margin-bottom: -30px;">
                        <img src="{{ (!empty($row->cover)) ? asset('storage/admin_post/' . $row->cover) : asset('upload/no_image.png') }}" class="card-img-top" alt="..."
                            style="height: 180px">
                        <div class="card-body">
                            <h5 class="card-title">{{ Str::limit($row->judul, 25) }}</h5>
                            <p class="card-text">{{ Str::limit($row->subjudul, 35) }}</p>
                                        <div class="d-flex">
                                            <a href="{{ route('tampilpost', $row->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('deletepost', $row->id) }}" method="GET  " style="display: inline-block;">
                                                @csrf

                                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- End Card with an image on top -->
                        @endforeach

                <!-- Card with an image on top -->

            </div>
        </div>
    </section>

</main><!-- End #main -->
<script>
    $(document).ready(function() {
        $('.delete').on('click', function() {
            var postId = $(this).data('id');

            if (confirm('Apakah Anda yakin ingin menghapus postingan ini?')) {
                $.ajax({
                    url: '/deletepost/' + postId,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });
    });
</script>

@endsection
