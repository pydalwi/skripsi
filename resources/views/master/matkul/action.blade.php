<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="form-master">
    @csrf
    {!! ($is_edit)? method_field('PUT') : method_field('POST') !!}
    <div id="modal-master" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama Program Studi</label>
                    <div class="col-sm-9">
                       <select name="prodi_id" id="prodi_id" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($prodi as $item)
                                <option value="<?= $item->prodi_id ?>" {{ isset($data->prodi_id) && $data->prodi_id == $item->prodi_id ? 'selected' : '' }} >{{$item->prodi_id}} ({{$item->nama_prodi}})</option>
                            @endforeach
                       </select>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Kode MK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="mk_kode" placeholder="Kode Mata Kuliah" name="mk_kode" value="{{ isset($data->mk_kode) ? $data->mk_kode : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama Matkul</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="mk_nama" placeholder="Nama Mata Kuliah" name="mk_nama" value="{{ isset($data->mk_nama) ? $data->mk_nama : '' }}"/>
                    </div>
                </div>

                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Jumlah SKS</label>
                    <div class="col-sm-3">
                        <input type="text" class="form-control form-control-sm" id="sks" placeholder="Jumlah SKS" name="sks" value="{{ isset($data->sks) ? $data->sks : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Semester</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="semester" placeholder="Semester" name="semester" value="{{ isset($data->semester) ? $data->semester : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label for="is_active" class="col-sm-3 control-label col-form-label">Jenis Matkul</label>
                    <div class="col-sm-9 mt-2">
                        <div class="icheck-{{ $theme->button }} d-inline mr-2">
                            <input type="radio" id="radioAktif" name="mk_jenis" value="T" <?php echo isset($data->mk_jenis) && $data->mk_jenis == 'T' ?  'checked' : '' ?>>
                            <label for="radioAktif">T </label>
                        </div>
                        <div class="icheck-warning d-inline">
                            <input type="radio" id="radioNonAktif" name="mk_jenis" value="P" <?php echo isset($data->mk_jenis) && $data->mk_jenis == 'P' ?  'checked' : '' ?>>
                            <label for="radioNonAktif">P</label>
                        </div>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label for="is_active" class="col-sm-3 control-label col-form-label">Mata Kuliah Kategori</label>
                    <div class="col-sm-9 mt-2">
                        <div class="icheck-{{ $theme->button }} d-inline mr-2">
                            <input type="radio" id="mk_kategori_radio_1" name="mk_kategori" value="0" <?php echo isset($data->mk_kategori) && $data->mk_kategori == '0' ?  'checked' : '' ?>>
                            <label for="mk_kategori_radio_1">MK WAJIB </label>
                        </div>
                        <div class="icheck-{{ $theme->button }} d-inline">
                            <input type="radio" id="mk_kategori_radio_2" name="mk_kategori" value="1" <?php echo isset($data->mk_kategori) && $data->mk_kategori == '1' ?  'checked' : '' ?>>
                            <label for="mk_kategori_radio_2">MK Pilihan 1</label>
                        </div>
                        <div class="icheck-{{ $theme->button }} d-inline">
                            <input type="radio" id="mk_kategori_radio_3" name="mk_kategori" value="2" <?php echo isset($data->mk_kategori) && $data->mk_kategori == '2' ?  'checked' : '' ?>>
                            <label for="mk_kategori_radio_3">MK Pilihan 2</label>
                        </div>
                        <div class="icheck-{{ $theme->button }} d-inline mr-2">
                            <input type="radio" id="mk_kategori_radio_4" name="mk_kategori" value="3" <?php echo isset($data->mk_kategori) && $data->mk_kategori == '3' ?  'checked' : '' ?>>
                            <label for="mk_kategori_radio_4">MK Pilihan 3 </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $(document).ready(function () {
        unblockUI();

        $('#mk_id').select2({
            tags:true,
            
        });
        $("#form-master").validate({
            rules: {
                mk_kode: {
                    required: true
                },
                mk_nama: {
                    required: true
                },
                sks: {
                    required: true
                },
                semester: {
                    required: true
                },
                mk_jenis: {
                    required: true
                },
            },
            submitHandler: function (form) {
                $('.form-message').html('');
                blockUI(form);
                $(form).ajaxSubmit({
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
