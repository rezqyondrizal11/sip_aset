@extends('layout.system.main')
@section('title', 'Data Aset Tetap')
@section('content')
    {{-- <style>
        /* Mencegah teks di dalam th dan td untuk terpotong ke bawah */
        th,
        td {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            /* Menambahkan elipsis (...) jika teks terlalu panjang */
        }

        /* Menambahkan pengguliran horizontal pada tabel */
        .table-responsive {
            overflow-x: auto;
        }
    </style> --}}
    <section class="content">

        <div class="box">
            <div class="box-header">
                <h1>Data Aset Tetap</h1>
            </div>
            <div class="box-body">
                <div class="nav-tabs-custom">


                    <ul class="nav nav-tabs">
                        @foreach ($cat as $key => $c)
                            <li class="{{ $key === 0 ? 'active' : '' }}">
                                <a href="#tab{{ $key }}" data-toggle="tab">{{ $c->name }}</a>
                            </li>
                        @endforeach

                    </ul>



                    <div class="tab-content">
                        <!-- Dynamic Tabs -->
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($cat as $key => $c)
                            @if ($c->id == 1)
                                @include('aset-tetap.index._kib_a')
                            @elseif($c->id == 2)
                                @include('aset-tetap.index._kib_b')
                            @elseif($c->id == 3)
                                @include('aset-tetap.index._kib_c')
                            @elseif($c->id == 4)
                                @include('aset-tetap.index._kib_d')
                            @elseif($c->id == 5)
                                @include('aset-tetap.index._kib_e')
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


    </section>
    <!--begin::Post-->
    <!-- Modal untuk update -->
    <div class="modal fade" id="updateModal" tabindex="-1 " role="dialog" aria-labelledby="updateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h5 class="modal-title" id="updateModalLabel">Update Aset Tetap</h5>

                </div>
                <div class="modal-body">
                    <div id="UpdateFormContainer">
                        <!-- Konten dari AJAX akan dimuat di sini -->
                        <p class="text-center">Loadingsss...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
{{-- @section('datatable')
    @php
        $totalcat = count($cat);
        $no = 2; // Mulai dari angka 2
    @endphp

    <script>
        $(function() {
            @for ($index = 0; $index < $totalcat; $index++)
                $("#example{{ $no }}").DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true,
                    "responsive": true, // Menambahkan fitur responsif
                    "scrollX": true, // Menambahkan scroll horizontal jika diperlukan
                    "dom": '<"d-flex justify-content-between"lf>rt<"bottom"ip><"clear">'
                });
                @php $no++; @endphp
            @endfor
        });
    </script>

@endsection --}}
@section('script')
    <script>
        $(document).ready(function() {
            // Event ketika tombol create diklik
            $('[id^="openCreateModal"]').click(function() {
                var key = $(this).attr('id').replace('openCreateModal',
                    ''); // Ambil key dari ID tombol
                var idcat = $(this).data('id'); // Mengambil id user yang diklik

                // Kosongkan isi modal sebelum memuat data baru
                $('#CreateFormContainer' + key).html('<p class="text-center">Loading...</p>');

                // Panggil route untuk form create menggunakan AJAX
                $.ajax({
                    url: "{{ route('asettetap.create', ':id') }}".replace(':id',
                        idcat),
                    method: "GET",
                    success: function(response) {
                        // Isi modal dengan konten yang diterima
                        $('#CreateFormContainer' + key).html(response);
                    },
                    error: function() {
                        // Tampilkan pesan error jika terjadi masalah
                        $('#CreateFormContainer' + key).html(
                            '<p class="text-center text-danger">Failed to load form. Please try again.</p>'
                        );
                    }
                });
            });


        });
    </script>
    <script>
        $(document).ready(function() {
            // Delegasi event untuk tombol Update
            $(document).on('click', '.openUpdateModal', function() {
                var Id = $(this).data('id'); // Mengambil id aset yang diklik

                if (Id) { // Pastikan Id ada (tidak undefined)
                    // Set judul modal untuk Update
                    $('#ModalLabel').text('Update Aset Tetap');

                    // Kosongkan isi modal sebelum memuat data baru
                    $('#UpdateFormContainer').html('<p class="text-center">Loading...</p>');

                    // Panggil route untuk form update menggunakan AJAX
                    $.ajax({
                        url: "{{ route('asettetap.edit', ':id') }}".replace(':id',
                            Id), // Gantilah :id dengan Id
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
                    console.error("ID is missing.");
                }
            });
        });
    </script>

    @foreach ($cat as $key => $c)
        @if ($c->id == 1)
            @include('aset-tetap.index._script_kib_a')
        @elseif($c->id == 2)
            @include('aset-tetap.index._script_kib_b')
        @elseif($c->id == 3)
            @include('aset-tetap.index._script_kib_c')
        @elseif($c->id == 4)
            @include('aset-tetap.index._script_kib_d')
        @elseif($c->id == 5)
            @include('aset-tetap.index._script_kib_e')
        @endif
    @endforeach



@endsection
