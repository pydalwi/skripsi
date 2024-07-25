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
                    <label class="col-sm-3 control-label col-form-label">Kode CPL</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="kode_cpl" placeholder="Kode CPL" name="kode_cpl" value="{{ isset($data->kode_cpl) ? $data->kode_cpl : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Deskripsi CPL</label>
                    <div class="col-sm-9">
                        <textarea rows="10" cols="30" type="text" class="form-control form-control-sm" id="deskripsi_cpl" placeholder="Deskripsi CPL" name="deskripsi_cpl">{{ isset($data->deskripsi_cpl) ? $data->deskripsi_cpl : '' }}</textarea>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Profile Lulusan</label>
                    <div class="col-sm-9">
                        <select name="kodeprofil_lulusan_id" id="kodeprofil_lulusan_id" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Profile Lulusan --</option>
                            @foreach ($pl as $item_pl)
                                <option value="{{$item_pl->kode_profil}}" {{ isset($data->kodeprofil_lulusan_id) && $data->kodeprofil_lulusan_id == $item_pl->kode_profil ? 'selected' : '' }}>( {{$item_pl->kodeprofil_lulusan}} ) {{$item_pl->deskripsi_pl}}</option>
                            @endforeach
                        </select>
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
        $('#kodeprofil_lulusan_id').select2();
        $('#kodeprofil_lulusan_id').on('change',function(){
            console.log($(this).val())
        })
        $("#form-master").validate({
            rules: {
                kode_cpmk: {
                    required: true
                },
                deskripsi_cpmk: {
                    required: true
                },
                kodeprofil_lulusan_id: {
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
