<form method="post" action="{{ $page->url }}" role="form" class="form-horizontal" id="group-form">
    @csrf
    {!! method_field('PUT') !!}
    <div id="modal-group" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{!! $page->title .' - Level <span class="badge badge-primary">'.$data->group_name.'</span>' !!}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body p-0">
                <div class="form-message text-center"></div>
                <table class="table table-striped table-hover table-full-width table-sm" id="table_group_menu">
                    <thead>
                    <tr>
                        <th class="col-md-5" rowspan="2">No</th>
                        <th class="col-md-2 text-center" rowspan="2">Kode CPL</th>
                        <th class="col-md-1 text-center">CPL01</th>
                        <th class="col-md-1 text-center">CPL02</th>
                        <th class="col-md-1 text-center">CPL03</th>
                        <th class="col-md-1 text-center">CPL04</th>
                        <th class="col-md-1 text-center">CPL05</th>
                        <th class="col-md-1 text-center">CPL06</th>
                        <th class="col-md-1 text-center">CPL07</th>
                        <th class="col-md-1 text-center">CPL08</th>
                        <th class="col-md-1 text-center">CPL09</th>
                        <th class="col-md-1 text-center">CPL10</th>
                        <th class="col-md-1 text-center">CPL11</th>
                        <th class="col-md-1 text-center">CPL12</th>
                        <th class="col-md-1 text-center">CPL13</th>
                        <th class="col-md-1 text-center">CPL14</th>
                        <th class="col-md-1 text-center">CPL15</th>
                        <th class="col-md-1 text-center">CPL16</th>
                        <th class="col-md-1 text-center">CPL18</th>
                        <th class="col-md-1 text-center">CPL19</th>
                        <th class="col-md-1 text-center">CPL20</th>
                        <th class="col-md-1 text-center">CPL21</th>
                        <th class="col-md-1 text-center">CPL22</th>
                        <th class="col-md-1 text-center">CPL23</th>
                        <th class="col-md-1 text-center">CPL24</th>
                        <th class="col-md-1 text-center">CPL25</th>
                        <th class="col-md-1 text-center">CPL26</th>
                        <th class="col-md-1 text-center">CPL27</th>
                        <th class="col-md-1 text-center">CPL28</th>
                        <th class="col-md-1 text-center">CPL29</th>
                        <th class="col-md-1 text-center">CPL30</th>
                        <th class="col-md-1 text-center">All</th>
                    </tr>
                    <tr>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_r" value="1" type="checkbox" onchange="updateCheck(this,'.r_act')" class="r_act" id="all_tr"><label for="all_tr"></label></div></th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_c" value="1" type="checkbox" onchange="updateCheck(this,'.c_act')" class="c_act" id="all_tc"><label for="all_tc"></label></div></th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_u" value="1" type="checkbox" onchange="updateCheck(this,'.u_act')" class="u_act" id="all_tu"><label for="all_tu"></label></div></th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_d" value="1" type="checkbox" onchange="updateCheck(this,'.d_act')" class="d_act" id="all_td"><label for="all_td"></label></div></th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    {!! $menu !!}
                    </tbody>
                    <tfoot>
                    <tr>
                        <th class="col-md-5" rowspan="2">Menu</th>
                        <th class="col-md-2 text-center" rowspan="2">Scope</th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_r" value="1" type="checkbox" onchange="updateCheck(this,'.r_act')" class="r_act" id="all_br"><label for="all_br"></label></div></th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_c" value="1" type="checkbox" onchange="updateCheck(this,'.c_act')" class="c_act" id="all_bc"><label for="all_bc"></label></div></th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_u" value="1" type="checkbox" onchange="updateCheck(this,'.u_act')" class="u_act" id="all_bu"><label for="all_bu"></label></div></th>
                        <th class="text-center pr-0"><div class="icheck-success d-inline"><input name="all_d" value="1" type="checkbox" onchange="updateCheck(this,'.d_act')" class="d_act" id="all_bd"><label for="all_bd"></label></div></th>
                        <th class="text-center"></th>
                    </tr>
                    <tr>
                        <th class="col-md-1 text-center">Retrive</th>
                        <th class="col-md-1 text-center">Create</th>
                        <th class="col-md-1 text-center">Update</th>
                        <th class="col-md-1 text-center">Delete</th>
                        <th class="col-md-1 text-center">All</th>
                    </tr>
                    </tfoot>
                </table>
                <div class="form-message text-center"></div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-warning">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    function updateCheck(th, act){
        $(act).prop('checked', $(th).is(':checked'));
    }

    $(document).ready(function() {

        $('.all_line').change(function(){
            $('#r_'+$(this).val()+',#c_'+$(this).val()+',#u_'+$(this).val()+',#d_'+$(this).val()).prop('checked', $(this).is(':checked'));
        });

        $("#group-form").validate({
            rules: {
                kode: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                nama: {
                    required: true,
                    minlength: 5,
                    maxlength: 50
                },
                is_aktif: {
                    required: true
                }
            },
            submitHandler: function(form) {
                $('.form-message').html('');
                blockUI(form);
                $(form).ajaxSubmit({
                    dataType: 'json',
                    success: function(data) {
                        unblockUI(form);
                        setFormMessage('.form-message', data);
                        if (data.stat) {
                            resetForm('#group-form');
                        }
                        closeModal($modal, data);
                    }
                });
            },
            validClass: "valid-feedback",
            errorElement: "div", // contain the error msg in a small tag
            errorClass: 'invalid-feedback',
            errorPlacement: erp,
            highlight: hl,
            unhighlight: uhl,
            success: sc
        });
    });
</script>
