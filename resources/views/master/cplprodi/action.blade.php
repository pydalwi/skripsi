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
                <div class="form-message text-center"></div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Kode CPL Prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="cpl_prodi_kode" placeholder="Kode CPL Prodi" name="cpl_prodi_kode" value="{{ isset($data->cpl_prodi_kode) ? $data->cpl_prodi_kode : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Kategori Cpl Prodi</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="cpl_prodi_kategori" placeholder="Kategori CPL Prodi" name="cpl_prodi_kategori" value="{{ isset($data->cpl_prodi_kategori) ? $data->cpl_prodi_kategori : '' }}"/>
                    </div>
                </div>
            <div class="modal-body">
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama Profil Lulusan</label>
                    <div class="col-sm-9">
                       <select name="pl_id" id="pl_id" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Profil Lulusan --</option>
                            @foreach ($profil_lulusan as $item)
                                <option value="<?= $item->pl_id ?>" {{ isset($data->pl_id) && $data->pl_id == $item->pl_id ? 'selected' : '' }} >{{$item->kode_pl}} ({{$item->nama_prodi}} Tahun {{$item->tahun_prodi}})</option>
                            @endforeach
                       </select>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Deskripsi CPL Prodi</label>
                    <div class="col-sm-9">
                        <textarea rows="10" cols="30" type="text" class="form-control form-control-sm" id="cpl_prodi_deskripsi" placeholder="Deskripsi CPL Prodi" name="cpl_prodi_deskripsi">{{ isset($data->cpl_prodi_deskripsi) ? $data->cpl_prodi_deskripsi : '' }}</textarea>
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
        $('#cpl_prodi_id').select2();
        $('#cpl_prodi_id').on('change',function(){
            console.log($(this).val())
        })
        $("#form-master").validate({
            rules: {
                cpl_prodi_kategori: {
                    required: true
                },
                cpl_prodi_kode: {
                    required: true
                },
                cpl_prodi_deskripsi: {
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
