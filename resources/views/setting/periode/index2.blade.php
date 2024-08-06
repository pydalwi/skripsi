@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-12">
            <div class="card card-outline card-{{ $theme->card_outline }}">
                <div class="card-header">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-angle-double-right text-md text-{{ $theme->card_outline }} mr-1"></i>
                        {!! $page->title !!}
                    </h3>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('periode.update') }}" role="form" class="form-horizontal" id="form-submit">
                        <div class="form-message-submit text-center"></div>
                        @csrf
                        <div class="form-group row mb-1">
                            <label for="periode" class="col-sm-3 col-form-label">Periode</label>
                            <div class="col-sm-9">
                                <select class="form-control form-control-sm select2" id="periode" name="periode_id">
                                    @foreach($periodes as $periode)
                                        <option value="{{ $periode->periode_id }}" {{ $periode->is_active ? 'selected' : '' }}>
                                            {{ $periode->periode_name }} - {{ $periode->periode_semester }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-3"></label>
                            <div class="col-sm-9">
                                <button type="submit" class="btn btn-{{ $theme->button }}">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card card-outline card-{{ $theme->card_outline }} mt-3">
                <div class="card-header">
                    <h3 class="card-title mt-1">
                        <i class="fas fa-angle-double-right text-md text-{{ $theme->card_outline }} mr-1"></i>
                        Daftar Periode
                    </h3>
                    <div class="card-tools">
                        @if($allowAccess->create)
                            <button type="button" data-block="body" class="btn btn-sm btn-{{ $theme->button }} mt-1 ajax_modal" data-url="{{ $page->url }}/create">
                                <i class="fas fa-plus"></i> Tambah
                            </button>
                        @endif
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-full-width" id="table_master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tahun Periode</th>
                                    <th>Periode</th>
                                    <th>Status</th>
                                    <th>#</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection

@push('content-js')
<script>
   $(document).ready(function() {
      // Initialize Select2 Elements
      $('.select2').select2({
          theme: 'bootstrap4'
      });

      $("#form-submit").validate({
         rules: {
            periode_id: {
               required: true
            }
         },
         submitHandler: function(form) {
            $('.form-message-submit').html('');
            $(form).ajaxSubmit({
               dataType: 'json',
               success: function(data) {
                  setFormMessage('.form-message-submit', data);
                  if (data.stat) {
                      setTimeout(function(){
                          location.reload();
                      }, 2000);
                  }
               }
            });
         },
         validClass: "valid-feedback",
         errorElement: "div",
         errorClass: 'invalid-feedback',
         errorPlacement: function(error, element) {
             error.addClass('invalid-feedback');
             element.closest('.form-group').append(error);
         },
         highlight: function(element, errorClass, validClass) {
             $(element).addClass('is-invalid').removeClass('is-valid');
         },
         unhighlight: function(element, errorClass, validClass) {
             $(element).addClass('is-valid').removeClass('is-invalid');
         }
      });
   });

      $(document).ready(function() {

$('.filter_combobox').select2();

var v = 0;
dataMaster = $('#table_master').DataTable({
    "bServerSide": true,
    "bAutoWidth": false,
    "ajax": {
        "url": "{{ $page->url }}/list",
        "dataType": "json",
        "type": "POST"
    },
    "aoColumns": [{
            "mData": "no",
            "sClass": "text-center",
            "sWidth": "5%",
            "bSortable": false,
            "bSearchable": false
        },
        {
            "mData": "periode_name",
            "sClass": "",
            "sWidth": "30%",
            "bSortable": true,
            "bSearchable": true
        },
        {
            "mData": "periode_semester",
            "sClass": "",
            "sWidth": "30%",
            "bSortable": true,
            "bSearchable": true
        },
        {
            "mData": "is_active",
            "sClass": "",
            "sWidth": "25%",
            "bSortable": true,
            "bSearchable": false,
            "mRender": function(data, type, row, meta) {
                return data == 1 ? '<span class="badge badge-success">Aktif</span>' : '';
            }
        },
        {
            "mData": "periode_id",
            "sClass": "text-center pr-2",
            "sWidth": "10%",
            "bSortable": false,
            "bSearchable": false,
            "mRender": function(data, type, row, meta) {
                return  ''
                        @if($allowAccess->update) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/edits" class="ajax_modal btn btn-xs btn-info tooltips text-light" data-placement="left" data-original-title="Edit Data" ><i class="fa fa-cogs"></i></a> ` @endif
                        @if($allowAccess->update) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/edit" class="ajax_modal btn btn-xs btn-warning tooltips text-secondary" data-placement="left" data-original-title="Edit Data" ><i class="fa fa-edit"></i></a> ` @endif
                        @if($allowAccess->delete) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/delete" class="ajax_modal btn btn-xs btn-danger tooltips text-light" data-placement="left" data-original-title="Hapus Data" ><i class="fa fa-trash"></i></a> ` @endif
                ;
            }
        }
    ],
    "fnDrawCallback": function ( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
        $( 'a', this.fnGetNodes() ).tooltip();
    }
});

$('.dataTables_filter input').unbind().bind('keyup', function(e) {
    if (e.keyCode == 13) {
        dataMaster.search($(this).val()).draw();
    }
});
});
</script>
@endpush
