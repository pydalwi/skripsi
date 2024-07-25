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
                    <label class="col-sm-3 control-label col-form-label">Judul </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="judul_ref" placeholder="Judul Ref" name="judul_ref" value="{{ isset($data->judul_ref) ? $data->judul_ref : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Penulis </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="penulis_ref" placeholder="Penulis Ref" name="penulis_ref" value="{{ isset($data->penulis_ref) ? $data->penulis_ref : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Tahun </label>
                    <div class="col-sm-9">
                        <input type="text" minlength="4"  maxlength="4" class="form-control form-control-sm" id="tahun_ref" placeholder="Tahun Ref" name="tahun_ref" value="{{ isset($data->tahun_ref) ? $data->tahun_ref : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Penerbit </label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="penerbit_ref" placeholder="Penerbit Ref" name="penerbit_ref" value="{{ isset($data->penerbit_ref) ? $data->penerbit_ref : '' }}"/>
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

        $("#form-master").validate({
            rules: {
                judul_ref: {
                    required: true
                },
                penulis_ref: {
                    required: true
                },
                tahun_ref: {
                    required: true
                },
                penerbit_ref: {
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
