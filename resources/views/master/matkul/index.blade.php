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
                        <div class="card-tools">
                            @if($allowAccess->create)
                                <button type="button" data-block="body" class="btn btn-sm btn-{{ $theme->button }} mt-1 ajax_modal" data-url="{{ $page->url }}/create"><i class="fas fa-plus"></i> Tambah</button>
                            @endif
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                        <table class="table table-striped table-hover table-full-width" id="table_master">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Kode MK</th>
                                    <th>Nama Mata Kuliah</th>
                                    <th>SKS</th>
                                    <th>Semester</th>
                                    <th>Jenis</th>
                                    <th>Kategori</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                    <tr>
                                        <td>{{$loop->index + 1}}</td>
                                        <td>{{$item->mk_kode}}</td>
                                        <td>{{$item->mk_nama}}</td>
                                        <td>{{$item->sks}}</td>
                                        <td>{{$item->semester}}</td>
                                        <td>{{$item->mk_jenis}}</td>
                                        <td>@switch($item->mk_kategori)
                                            @case(0)
                                                <span class="badge badge-primary">MK Wajib</span>
                                                @break
                                            @case(1)
                                                <span class="badge badge-warning">MK Pilihan</span>
                                                @break
                                            @case(2)
                                                <span class="badge badge-danger">MKWK</span>
                                                @break
                                            @default
                                                
                                        @endswitch</td>
                                        <td>
                                            @if($allowAccess->update)<a href="#" data-block="body" data-url="{{ $page->url }}/{{$item->mk_id}}/edit" class="ajax_modal btn btn-xs btn-warning tooltips text-secondary" data-placement="left" data-original-title="Edit Data" ><i class="fa fa-edit"></i></a>@endif
                                            @if($allowAccess->delete)<a href="#" data-block="body" data-url="{{ $page->url }}/{{$item->mk_id}}/delete" class="ajax_modal btn btn-xs btn-danger tooltips text-light" data-placement="left" data-original-title="Hapus Data" ><i class="fa fa-trash"></i></a> @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
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

            $('.filter_combobox').select2();
            dataMaster = $('#table_master').DataTable();
            // var v = 0;
            //  dataMaster = $('#table_master').DataTable({
            //      "bServerSide": true,
            //      "bAutoWidth": false,
            //      "ajax": {
            //          "url": "{{ $page->url }}/list",
            //          "dataType": "json",
            //          "type": "POST"
            //      },
            //      "aoColumns": [{
            //              "mData": "no",
            //              "sClass": "text-center",
            //              "sWidth": "5%",
            //              "bSortable": false,
            //              "bSearchable": false
            //          },
            //          {
            //              "mData": "mk_kode",
            //              "sClass": "",
            //              "sWidth": "20%",
            //              "bSortable": true,
            //              "bSearchable": true
            //          },
            //          {
            //              "mData": "mk_nama",
            //              "sClass": "",
            //              "sWidth": "20%",
            //              "bSortable": true,
            //              "bSearchable": true
            //          },
            //          {
            //              "mData": "sks",
            //              "sClass": "",
            //              "sWidth": "20%",
            //              "bSortable": true,
            //              "bSearchable": true
            //          },
            //          {
            //              "mData": "semester",
            //              "sClass": "",
            //              "sWidth": "20%",
            //              "bSortable": true,
            //              "bSearchable": true
            //          },
            //            {
            //                "mData": "is_active",
            //                "sClass": "",
            //                "sWidth": "8%",
            //                "bSortable": true,
            //                "bSearchable": false,
            //                 "mRender": function(data, type, row, meta) {
            //                    return data == 1 ? '<span class="badge badge-success">Aktif</span>' : '<span class="badge badge-danger">Non-Aktif</span>';
            //                }
            //            },
            //            {
            //                "mData": "mk_kategori",
            //                "sClass": "",
            //                "sWidth": "8%",
            //                "bSortable": true,
            //                "bSearchable": false,
            //                 "mRender": function(data, type, row, meta) {
            //                     if (data != null || data == 0) {
            //                        return '<span class="badge badge-success">Wajib</span>'
            //                     }
            //                     if (data != null || data == 1) {
            //                        return '<span class="badge badge-success">MK Pilihan</span>'
            //                     }
            //                     if (data != null || data == 2) {
            //                        return '<span class="badge badge-success">MKWK</span>'
            //                     }
                              
            //                }
            //            },
            //            {
            //               "mData": "mk_jenis",
            //               "sClass": "text-center pr-2",
            //               "sWidth": "10%",
            //               "bSortable": false,
            //               "bSearchable": false,
            //           },
            //           {
            //             "mData": "mk_id",
            //             "sClass": "text-center pr-2",
            //             "sWidth": "10%",
            //             "bSortable": false,
            //             "bSearchable": false,
            //             "mRender": function(data, type, row, meta) {
            //                 return  ''
            //                         @if($allowAccess->update) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/edit" class="ajax_modal btn btn-xs btn-warning tooltips text-secondary" data-placement="left" data-original-title="Edit Data" ><i class="fa fa-edit"></i></a> ` @endif
            //                         @if($allowAccess->delete) + `<a href="#" data-block="body" data-url="{{ $page->url }}/${data}/delete" class="ajax_modal btn btn-xs btn-danger tooltips text-light" data-placement="left" data-original-title="Hapus Data" ><i class="fa fa-trash"></i></a> ` @endif
            //                 ;
            //             }
            //         }
            //      ],
            //      "fnDrawCallback": function ( nRow, aData, iDisplayIndex, iDisplayIndexFull) {
            //          $( 'a', this.fnGetNodes() ).tooltip();
            //      }
            //  });

            // $('.dataTables_filter input').unbind().bind('keyup', function(e) {
            //     if (e.keyCode == 13) {
            //         dataMaster.search($(this).val()).draw();
            //     }
            //     });
        });
    
    </script>

@endpush
