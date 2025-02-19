<script>
    $(document).ready(function() {
        let table{{ $key }} = $("#example{{ $key }}").DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('penghapusanaset.data', $c->id) }}",
                data: function(d) {
                    // Mengambil nilai tahun dari dropdown filter
                    d.year = $('#filterYear{{ $key }}').val();
                }
            },
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'aksi',
                    name: 'aksi'
                },
                {
                    data: 'nama_barang',
                    name: 'nama_barang'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'register',
                    name: 'register'
                },
                {
                    data: 'luas',
                    name: 'luas'
                },
                {
                    data: 'tahun_pengadaan',
                    name: 'tahun_pengadaan'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'status_tanah',
                    name: 'status_tanah'
                },
                {
                    data: 'sertifikat_tgl',
                    name: 'sertifikat_tgl'
                },
                {
                    data: 'sertifikat_no',
                    name: 'sertifikat_no'
                },
                {
                    data: 'penggunaan',
                    name: 'penggunaan'
                },
                {
                    data: 'asal_usul',
                    name: 'asal_usul'
                },
                {
                    data: 'harga_beli',
                    name: 'harga_beli'
                },
                {
                    data: 'harga',
                    name: 'harga'
                },
                {
                    data: 'tanggal_perolehan',
                    name: 'tanggal_perolehan'
                },
                {
                    data: 'usia_aset',
                    name: 'usia_aset',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'ket',
                    name: 'ket'
                }
            ]
        });


        // Menangani perubahan tahun yang dipilih
        $('#filterYear{{ $key }}').change(function() {
            table{{ $key }}.draw(); // Menyaring ulang DataTable dengan tahun yang dipilih


            // Memperbarui URL cetak dengan tahun yang dipilih
            let selectedYear = $('#filterYear{{ $key }}').val();
            let printLink =
                "{{ route('asettetap.print', ['id' => $c->id, 'year' => 'null']) }}"; // Default 'null' untuk year

            // Jika tahun dipilih, masukkan tahun tersebut
            if (selectedYear) {
                printLink = printLink.replace('null',
                    selectedYear); // Ganti 'null' dengan tahun yang dipilih
            }

            // Memperbarui href link print
            $('#btnPrintPDF{{ $key }}').attr('href', printLink);
        });
    });
</script>
