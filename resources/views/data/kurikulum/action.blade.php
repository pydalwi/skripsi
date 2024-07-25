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
                    <label class="col-sm-3 control-label col-form-label">Nama Dosen Kurikulum</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="kurikulum_nama" placeholder="Nama Dosen Kurikulum" name="kurikulum_nama" value="{{ isset($data->kurikulum_nama) ? $data->kurikulum_nama : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Tahun Kurikulum</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="kurikulum_tahun" placeholder="Tahun Kurikulum" name="kurikulum_tahun" value="{{ isset($data->kurikulum_tahun) ? $data->kurikulum_tahun : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group required row mb-2">
                <label class="col-sm-3 control-label col-form-label">Nama Prodi</label>
                <div class="col-sm-9">
                   <select name="prodi_id" id="prodi_id" class="form-control form-control-sm" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodi as $item)
                            <option value="<?= $item->prodi_id ?>" {{ isset($data->prodi_id) && $data->prodi_id == $item->prodi_id ? 'selected' : '' }} >{{$item->nama_prodi}} ({{$item->tahun_prodi}})</option>
                        @endforeach
                   </select>
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
        $('#kurikulum_id').select2();
        $('#kurikulum_id').on('change',function(){
            console.log($(this).val())
        })
        $("#form-master").validate({
            rules: {
                kurikulum_nama: {
                    required: true
                },
                kurikulum_tahun: {
                    required: true
                },
                kurikulum_id: {
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
