<?php
    // jika $data ada ISI-nya maka actionnya adalah edit, jika KOSONG : insert
    $is_edit = isset($data);
?>

<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="form-data">
    @csrf
    {!! ($is_edit)? method_field('PUT') : method_field('POST') !!}
    <div id="modal-data" class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Nama Prodi</label>
                    <div class="col-sm-9">
                       <select name="prodi_id" id="prodi_id" class="form-control form-control-sm" required>
                            <option value="">-- Pilih Prodi --</option>
                            @foreach ($prodi as $item)
                                <option value="<?= $item->prodi_id ?>" {{ isset($data->prodi_id) && $data->prodi_id == $item->prodi_id ? 'selected' : '' }} >{{$item->nama_prodi}}</option>
                            @endforeach
                       </select>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="form-group required row mb-2">
                        <label class="col-sm-3 control-label col-form-label">CPL</label>
                        <div class="col-sm-9">
                           <select name="cpl_prodi_id" id="cpl_prodi_id" class="form-control form-control-sm" required>
                                <option value="">-- Pilih CPL --</option>
                                @foreach ($cplprodi as $item)
                                    <option value="<?= $item->cpl_prodi_id ?>" {{ isset($data->cpl_prodi_id) && $data->cpl_prodi_id == $item->cpl_prodi_id ? 'selected' : '' }} >{{$item->cpl_prodi_kode}} ({{$item->cpl_prodi_deskripsi}})</option>
                                @endforeach
                           </select>
                        </div>
                    </div>
                    
                <div class="form-message text-center"></div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Kode CPMK</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control form-control-sm" id="cpmk_kode" placeholder="Kode CPMK" name="cpmk_kode" value="{{ isset($data->cpmk_kode) ? $data->cpmk_kode : '' }}"/>
                    </div>
                </div>
                <div class="form-group required row mb-2">
                    <label class="col-sm-3 control-label col-form-label">Deskripsi CPMK</label>
                    <div class="col-sm-9">
                        <textarea rows="10" cols="30" type="text" class="form-control form-control-sm" id="cpmk_deskripsi" placeholder="Deskripsi CPMK" name="cpmk_deskripsi">{{ isset($data->cpmk_deskripsi) ? $data->cpmk_deskripsi : '' }}</textarea>
                    </div>
                </div>
            </div>
           {{-- <div class="form-group required row mb-2">
                <label class="col-sm-3 control-label col-form-label">MK</label>
                <div class="col-sm-9">
                   <select name="mk_id[]" id="mk_id" class="form-control form-control-sm" required multiple>
                        <option value="">-- MK --</option>
                        @foreach ($matkul as $item)
                            <option value="<?= $item->mk_id ?>" {{ isset($data->mk_id) && $data->mk_id == $item->mk_id ? 'selected' : '' }} >{{$item->mk_kode}}</option>
                        @endforeach
                   </select>
                </div>
            </div> --}}
            <div class="form-group required row mb-2">
                <label class="col-sm-3 control-label col-form-label">MK</label>
                <div class="col-sm-9">
                    <div class="form-check">
                        @foreach ($matkul as $item)
                            <div class="form-check">
                                <input 
                                    type="checkbox" 
                                    name="mk_id[]" 
                                    id="mk_id{{ $item->mk_id }}" 
                                    value="{{ $item->mk_id }}" 
                                    class="form-check-input" 
                                    {{ isset($data->mk_id) && in_array($item->mk_id, $data->mk_id) ? 'checked' : '' }}
                                >
                                <label class="form-check-label" for="mk_id_{{ $item->mk_id }}">
                                    {{ $item->mk_kode }}
                                </label>
                            </div>
                        @endforeach
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

        $("#form-data").validate({
            rules: {
                kode_cpmk: {
                    required: true
                },
                deskripsi_cpmk: {
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
                            resetForm('#form-data');
                            dataData.draw(false);
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
