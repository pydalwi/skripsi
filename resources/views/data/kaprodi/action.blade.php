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
                    <label class="col-sm-3 control-label col-form-label">Nama Kaprodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="kaprodi_nama" placeholder="Nama Kaprodi" name="kaprodi_nama" value="{{ isset($data->kaprodi_nama) ? $data->kaprodi_nama : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="modal-body">
                <div class="form-message text-center"></div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Tahun Kaprodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="tahun" placeholder="Tahun Kaprodi" name="tahun" value="{{ isset($data->tahun) ? $data->tahun : '' }}"/>
                    </div>
                </div>
            </div>
            <div class="form-group required row mb-2">
                <label class="col-sm-3 control-label col-form-label">Nama Prodi</label>
                <div class="col-sm-9">
                   <select name="prodi_id" id="prodi_id" class="form-control form-control-sm" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodi as $item)
                            <option value="<?= $item->prodi_id ?>" {{ isset($data->prodi_id) && $data->prodi_id == $item->prodi_id ? 'selected' : '' }} >{{$item->nama_prodi}} </option>
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
        $('#kaprodi_id').select2();
        $('#kaprodi_id').on('change',function(){
            console.log($(this).val())
        })
        $("#form-master").validate({
            rules: {
                kaprodi_nama: {
                    required: true
                },
                tahun: {
                    required: true
                },
                kaprodi_id: {
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
