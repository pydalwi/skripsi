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
            
            <div class="modal-body">
                <div class="form-message text-center"></div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Kode BK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="bk_kode" placeholder="Kode BK" name="bk_kode" value="{{ isset($data->bk_kode) ? $data->bk_kode : '' }}"/>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-message text-center"></div>
                    <div class="form-group required row mb-2">
                        <label class="col-sm-3 control-label col-form-label">Kategori BK</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control form-control-sm" id="bk_kategori" placeholder="Kategori BK" name="bk_kategori" value="{{ isset($data->bk_kategori) ? $data->bk_kategori : '' }}"/>
                        </div>
                    </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Deskripsi BK</label>
                    <div class="col-sm-9">
                        <textarea rows="10" cols="30" type="text" class="form-control form-control-sm" id="bk_deskripsi" placeholder="Deskripsi BK" name="bk_deskripsi">{{ isset($data->bk_deskripsi) ? $data->bk_deskripsi : '' }}</textarea>
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
        $('#bahan_kajian_id').select2();
        $('#bahan_kajian_id').on('change',function(){
            console.log($(this).val())
        })
        $("#form-master").validate({
            rules: {
                bk_id: {
                    required: true
                },
                bk_kategori: {
                    required: true
                },
                bk_kode: {
                    required: true
                },
                bk_deskripsi: {
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
