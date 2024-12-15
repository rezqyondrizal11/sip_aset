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
                                @include('aset-tetap.index-wali._kib_a')
                            @elseif($c->id == 2)
                                @include('aset-tetap.index-wali._kib_b')
                            @elseif($c->id == 3)
                                @include('aset-tetap.index-wali._kib_c')
                            @elseif($c->id == 4)
                                @include('aset-tetap.index-wali._kib_d')
                            @elseif($c->id == 5)
                                @include('aset-tetap.index-wali._kib_e')
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>

        </div>


    </section>

@endsection

@section('script')


    @foreach ($cat as $key => $c)
    @if ($c->id == 1)
        @include('aset-tetap.index-wali._script_kib_a')
    @elseif($c->id == 2)
        @include('aset-tetap.index-wali._script_kib_b')
    @elseif($c->id == 3)
        @include('aset-tetap.index-wali._script_kib_c')
    @elseif($c->id == 4)
        @include('aset-tetap.index-wali._script_kib_d')
    @elseif($c->id == 5)
        @include('aset-tetap.index-wali._script_kib_e')
    @endif
    @endforeach

@endsection
