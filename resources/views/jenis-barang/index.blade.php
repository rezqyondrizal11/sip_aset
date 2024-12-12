@extends('layout.system.main')

@section('title', 'Data Jenis Barang')
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h1>Data Jenis Barang</h1>
            </div>
            <div class="box-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createModal"
                    id="openCreateModal">
                    <i class="fa fa-plus"></i> Tambah Data
                </button>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ $message }}</p>
                    </div>
                @endif
                <table id="example1" class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Jenis</th>


                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            @php
                                $id = $row->id;
                                $iterationNumber = $loop->index + 1;
                            @endphp

                            <tr id="jenis-{{ $id }}">
                                <td>{{ $iterationNumber }}</td>
                                <td><?= $row->name ?></td>

                                <td class="text-center">
                                    <a href="#" class="btn btn-primary openUpdateModal" data-toggle="modal"
                                        data-target="#updateModal" data-id="{{ $id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <a href="#"
                                        onclick="return klikDelete('{{ route('jenisbarang.destroy', ['id' => $id]) }}');"
                                        class="btn btn-danger">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
        </div>

        <!-- Modal untuk Create -->
        <div class="modal fade" id="createModal" tabindex="-1 " role="dialog" aria-labelledby="createModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="createModalLabel">Create Kategori Aset</h5>

                    </div>
                    <div class="modal-body">
                        <div id="CreateFormContainer">
                            <!-- Konten dari AJAX akan dimuat di sini -->
                            <p class="text-center">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk update -->
        <div class="modal fade" id="updateModal" tabindex="-1 " role="dialog" aria-labelledby="updateModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="updateModalLabel">Update Kategori Aset</h5>

                    </div>
                    <div class="modal-body">
                        <div id="UpdateFormContainer">
                            <!-- Konten dari AJAX akan dimuat di sini -->
                            <p class="text-center">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@section('script')
    <script>
        $(document).ready(function() {
            // Event ketika tombol create diklik
            $('#openCreateModal').click(function() {

                // Kosongkan isi modal sebelum memuat data baru
                $('#CreateFormContainer').html('<p class="text-center">Loading...</p>');

                // Panggil route untuk form create menggunakan AJAX
                $.ajax({

                    url: "{{ route('jenisbarang.create') }}",
                    method: "GET",
                    success: function(response) {

                        // Isi modal dengan konten yang diterima
                        $('#CreateFormContainer').html(response);
                    },
                    error: function() {
                        // Tampilkan pesan error jika terjadi masalah
                        $('#CreateFormContainer').html(
                            '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                        );
                    }
                });
            });
            // Event untuk tombol Update
            $('.openUpdateModal').click(function() {

                var userId = $(this).data('id'); // Mengambil id user yang diklik

                if (userId) { // Pastikan userId ada (tidak undefined)
                    // Set judul modal untuk Update
                    $('#ModalLabel').text('Update Jenis Barang');

                    // Kosongkan isi modal sebelum memuat data baru
                    $('#UpdateFormContainer').html('<p class="text-center">Loading...</p>');

                    // Panggil route untuk form update menggunakan AJAX
                    $.ajax({
                        url: "{{ route('jenisbarang.edit', ':id') }}".replace(':id',
                            userId), // Gantilah :id dengan userId
                        method: "GET",
                        success: function(response) {
                            // Isi modal dengan konten yang diterima
                            $('#UpdateFormContainer').html(response);
                        },
                        error: function() {
                            // Tampilkan pesan error jika terjadi masalah
                            $('#UpdateFormContainer').html(
                                '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                            );
                        }
                    });
                } else {
                    console.error("User ID is missing.");
                }
            });


        });
    </script>
@endsection
