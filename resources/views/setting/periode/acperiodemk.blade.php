<?php
    $is_edit = isset($data);
?>
<form method="post" action="{{$page->url}}" role="form" class="form-horizontal" id="form-master">
    @csrf
    {!! ($is_edit)? method_field('PUT') : '' !!}
    <div id="modal-master" class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>

                <input type="hidden" name="new_periode_id" class="form-control" id="periode_id" value="{{ $id }}" readonly/>
                <div class="form-group required row mb-10">
                    {{-- <div class="col-12 d-flex justify-content-center">
                        <div class="form-group col-md-6">
                            <label for="periode_id">Periode</label>
                            <select name="new_periode_id" class="form-control select2" id="periode_id">
                                <option value="">-</option>
                                @foreach ($periodes as $periode)
                                    <option value="{{ $periode->periode_id }}" {{ $periode->periode_id == $id ? 'selected' : '' }}>
                                        {{ $periode->periode_id }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div> --}}

                    <div class="col-12 d-flex justify-content-center">
                        <div class="form-group col-md-6">
                        <select name="kurikulum_id" id="kurikulum_id" class="form-control select2">
                            <option value="all">Pilih Kurikulum</option>
                            @foreach ($kurikulums as $kurikulum)
                                <option value="{{ $kurikulum->kurikulum_id }}">{{ $kurikulum->kurikulum_tahun }} - {{ $kurikulum->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>
                    </div>
                    
                    <div class="col-12 d-flex justify-content-center">
                        <div class="table-responsive" style="width: 80%;">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="searchInput" placeholder="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="table-wrapper" style="height: 400px; overflow-y: auto;">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th style="width: 45px;">No</th>
                                            <th style="text-align: center;">Mata Kuliah</th>
                                            <th style="text-align: center;">Pilih</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tableBody">
                                        @foreach ($allMataKuliah as $mk)
                                        @php
                                            $isSelected = $selectedMataKuliah->firstWhere('kurikulum_mk_id', $mk->kurikulum_mk_id);
                                        @endphp
                                        <tr>
                                            <td style="text-align: center;">
                                                {{ $loop->iteration }}
                                            </td>
                                            <td style="padding-left: 10px;">
                                                <label for="checkbox_mk{{ $mk->kurikulum_mk_id }}">
                                                    {{ $mk->mk_nama }}
                                                </label>
                                            </td>
                                            <td style="text-align: center;">
                                                <div class="icheck-success d-inline">
                                                    <input type="checkbox" id="checkbox_mk{{ $mk->kurikulum_mk_id }}" name="kurikulum_mk_ids[]" value="{{ $mk->kurikulum_mk_id }}" @if ($isSelected) checked @endif>
                                                    <label for="checkbox_mk{{ $mk->kurikulum_mk_id }}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
                    
                    <script>
                        $(document).ready(function() {
                            var mataKuliahByKurikulum = @json($mataKuliahByKurikulum);
    var selectedCheckboxes = {};

    // Simpan status centang di memori lokal
    function saveCheckboxStatus() {
        $('input[name="kurikulum_mk_ids[]"]').each(function() {
            var kurikulumMkId = $(this).val();
            selectedCheckboxes[kurikulumMkId] = $(this).is(':checked');
        });
    }

    // Muat ulang tabel dengan mempertahankan status centang
    function loadTable(kurikulumId) {
        var tableBody = $('#tableBody');
        tableBody.empty();

        if (kurikulumId === 'all') {
            // Tampilkan semua data mata kuliah
            @foreach ($allMataKuliah as $mk)
                var isChecked = selectedCheckboxes['{{ $mk->kurikulum_mk_id }}'] ? 'checked' : '';
                var row = '<tr>' +
                    '<td style="text-align: center;">{{ $loop->iteration }}</td>' +
                    '<td style="padding-left: 10px;">' +
                    '<label for="checkbox_mk{{ $mk->kurikulum_mk_id }}">{{ $mk->mk_nama }}</label>' +
                    '</td>' +
                    '<td style="text-align: center;">' +
                    '<div class="icheck-success d-inline">' +
                    '<input type="checkbox" id="checkbox_mk{{ $mk->kurikulum_mk_id }}" name="kurikulum_mk_ids[]" value="{{ $mk->kurikulum_mk_id }}" ' + isChecked + '>' +
                    '<label for="checkbox_mk{{ $mk->kurikulum_mk_id }}"></label>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                tableBody.append(row);
            @endforeach
        } else if (kurikulumId && mataKuliahByKurikulum[kurikulumId]) {
            mataKuliahByKurikulum[kurikulumId].forEach(function(mk, index) {
                var isChecked = selectedCheckboxes[mk.kurikulum_mk_id] ? 'checked' : '';
                var row = '<tr>' +
                    '<td style="text-align: center;">' + (index + 1) + '</td>' +
                    '<td style="padding-left: 10px;">' +
                    '<label for="checkbox_mk' + mk.kurikulum_mk_id + '">' + mk.mk_nama + '</label>' +
                    '</td>' +
                    '<td style="text-align: center;">' +
                    '<div class="icheck-success d-inline">' +
                    '<input type="checkbox" id="checkbox_mk' + mk.kurikulum_mk_id + '" name="kurikulum_mk_ids[]" value="' + mk.kurikulum_mk_id + '" ' + isChecked + '>' +
                    '<label for="checkbox_mk' + mk.kurikulum_mk_id + '"></label>' +
                    '</div>' +
                    '</td>' +
                    '</tr>';
                tableBody.append(row);
            });
        }
    }

    $('#kurikulum_id').change(function() {
        saveCheckboxStatus();
        var kurikulumId = $(this).val();
        loadTable(kurikulumId);
    });
                        
                            // Pencarian
                            document.getElementById('searchInput').addEventListener('keyup', function() {
                                var searchValue = this.value.toLowerCase();
                                var tableBody = document.getElementById('tableBody');
                                var rows = tableBody.getElementsByTagName('tr');
                        
                                for (var i = 0; i < rows.length; i++) {
                                    var cells = rows[i].getElementsByTagName('td');
                                    var match = false;
                        
                                    for (var j = 0; j < cells.length; j++) {
                                        if (cells[j].innerText.toLowerCase().indexOf(searchValue) > -1) {
                                            match = true;
                                            break;
                                        }
                                    }
                        
                                    if (match) {
                                        rows[i].style.display = '';
                                    } else {
                                        rows[i].style.display = 'none';
                                    }
                                }
                            });
                        
                            //Initialize Select2 Elements
                            $('.select2').select2();
                        
                            //Initialize Select2 Elements
                            $('.select2bs4').select2({
                                theme: 'bootstrap4'
                            });
                        
                            unblockUI();
                        
                            $('.select2_combobox').select2();
                        
                            $("#form-master").validate({
                                rules: {
                                    new_periode_id: { required: true },
                                    'kurikulum_mk_ids[]': {  },
                                },
                                submitHandler: function (form) {
                                    blockUI(form);
                                    $(form).ajaxSubmit({
                                        url: "{{ route('updates', $id) }}", // Ensure this URL is correct
                                        type: 'POST', // Ensure the request is POST
                                        dataType: 'json',
                                        success: function (data) {
                                            unblockUI(form);
                                            setFormMessage('.form-message', data);
                                            if (data.stat) {
                                                resetForm('#form-master');
                                                dataMaster.draw(false);
                                            }
                                            closeModal($modal, data);
                                        }
                                    });
                                },
                                validClass: "valid-feedback",
                                errorElement: "div",
                                errorClass: 'invalid-feedback',
                                errorPlacement: erp,
                                highlight: hl,
                                unhighlight: uhl,
                                success: sc
                            });
                        });
                        </script>
                    

<style>
.table-wrapper {
    position: relative;
}

.table-wrapper thead th {
    position: sticky;
    top: 0;
    background: #fff;
    z-index: 2;
}
</style>
