@extends('layout.system.main')

@section('title', 'User')
@section('content')


    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h1>User Management</h1>
            </div>
            <div class="box-header">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#createuserModal"
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
                            <th class="text-center">No</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Nama</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Role</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $row)
                            @php
                                $id = $row->id;
                                $iterationNumber = $loop->index + 1;
                                $status = $row->status; // 1 = Aktif, 0 = Inaktif
                            @endphp

                            <tr class="text-center" id="userRow-{{ $id }}">
                                <td>{{ $iterationNumber }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->name }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->role }}</td>
                                <td id="status-{{ $id }}">
                                    <span class="badge {{ $status == 1 ? 'badge-success' : 'badge-danger' }}">
                                        {{ $status == 1 ? 'Aktif' : 'Inaktif' }}
                                    </span>
                                </td>
                                <td>
                                    <button class="btn btn-warning btn-sm toggleStatus" data-id="{{ $id }}"
                                        data-status="{{ $status }}">
                                        {{ $status == 1 ? 'Nonaktifkan' : 'Aktifkan' }}
                                    </button>
                                    <a href="#" class="btn btn-primary openUpdateModal" data-toggle="modal"
                                        data-target="#updateuserModal" data-id="{{ $id }}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#"
                                        onclick="return klikDelete('{{ route('user.destroy', ['id' => $id]) }}');"
                                        class="btn btn-danger"><i class="fa fa-trash"></i>
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
        <div class="modal fade" id="createuserModal" tabindex="-1 " role="dialog" aria-labelledby="createuserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="createuserModalLabel">Create User</h5>

                    </div>
                    <div class="modal-body">
                        <div id="CreateUserFormContainer">
                            <!-- Konten dari AJAX akan dimuat di sini -->
                            <p class="text-center">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal untuk update -->
        <div class="modal fade" id="updateuserModal" tabindex="-1 " role="dialog" aria-labelledby="updateuserModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h5 class="modal-title" id="updateuserModalLabel">Update User</h5>

                    </div>
                    <div class="modal-body">
                        <div id="UpdateUserFormContainer">
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
                $('#CreateUserFormContainer').html('<p class="text-center">Loading...</p>');

                // Panggil route untuk form create menggunakan AJAX
                $.ajax({
                    url: "{{ route('user.create') }}",
                    method: "GET",
                    success: function(response) {

                        // Isi modal dengan konten yang diterima
                        $('#CreateUserFormContainer').html(response);
                    },
                    error: function() {
                        // Tampilkan pesan error jika terjadi masalah
                        $('#CreateUserFormContainer').html(
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
                    $('#userModalLabel').text('Update User');

                    // Kosongkan isi modal sebelum memuat data baru
                    $('#UpdateUserFormContainer').html('<p class="text-center">Loading...</p>');

                    // Panggil route untuk form update menggunakan AJAX
                    $.ajax({
                        url: "{{ route('user.edit', ':id') }}".replace(':id',
                            userId), // Gantilah :id dengan userId
                        method: "GET",
                        success: function(response) {
                            // Isi modal dengan konten yang diterima
                            $('#UpdateUserFormContainer').html(response);
                        },
                        error: function() {
                            // Tampilkan pesan error jika terjadi masalah
                            $('#UpdateUserFormContainer').html(
                                '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                            );
                        }
                    });
                } else {
                    console.error("User ID is missing.");
                }
            });


        });

        $(document).ready(function() {
            $(".toggleStatus").click(function() {
                let userId = $(this).data("id");
                let currentStatus = $(this).data("status");
                let newStatus = currentStatus == 1 ? 0 : 1;
                let button = $(this);
                let statusCell = $("#status-" + userId);

                $.ajax({
                    url: "/system/user/update-status", // Sesuaikan dengan route backend
                    type: "POST",
                    data: {
                        id: userId,
                        status: newStatus,
                        _token: "{{ csrf_token() }}" // Pastikan ada CSRF token
                    },
                    success: function(response) {
                        if (response.success) {
                            // Update status di tabel
                            statusCell.html(`
                        <span class="badge ${newStatus == 1 ? 'badge-success' : 'badge-danger'}">
                            ${newStatus == 1 ? 'Aktif' : 'Inaktif'}
                        </span>
                    `);

                            // Update button text
                            button.text(newStatus == 1 ? "Nonaktifkan" : "Aktifkan");
                            button.data("status", newStatus);
                        } else {
                            alert("Gagal mengubah status");
                        }
                    },
                    error: function() {
                        alert("Terjadi kesalahan, coba lagi");
                    }
                });
            });
        });
    </script>
@endsection
