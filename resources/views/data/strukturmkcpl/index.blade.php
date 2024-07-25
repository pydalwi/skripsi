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
                                    <th rowspan="2">CPL</th>
                                    <th rowspan="2">Semester</th>
                                    <th colspan="100%" class="text-center"> Struktur CPL - MK</th>
                                    <th>SKS</th>
                                    <th>Jumlah MK</th>
                                    <th>MK WAJIB</th>
                                    <th>MK PILIHAN</th>
                                    <th>MKWK</th>   
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total_cpl = 0;
                                    $total_mk = 0;
                                @endphp
                                @for ($i = 1; $i <= 8; $i++)
                                @php
                                        $sks = 0;
                                        $jumlah_mk = 0;
                                        $ray_wajib = [];
                                        $ray_pilihan  = [];
                                        $ray_wk = [];
                                @endphp
                                @foreach ($data as $item)
                                    @php
                                        if($item->semester == $i){
                                            $sks += $item->sks;
                                            $total_sks += $sks;
                                            $jumlah_mk += 1;
                                            $total_mk += $jumlah_mk;
                                            switch ($item->mk_kategori) {
                                                case '0':
                                                   array_push($ray_wajib,$item->mk_kode);
                                                    break;
                                                case '1':
                                                array_push($ray_pilihan,$item->mk_kode);
                                                    break;
                                                case '2':
                                                array_push($ray_wk,$item->mk_kode);
                                                    break;
                                            }
                                        }
                                    @endphp
                                @endforeach
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$i}}</td>
                                        <td>{{$sks}}</td>
                                        <td>{{$jumlah_mk}}</td>
                                        <td>{{ count($ray_wajib) > 0 ? implode(",",$ray_wajib) : '-'}}</td>
                                        <td>{{count($ray_pilihan) > 0 ? implode(",",$ray_pilihan) : '-'}}</td>
                                        <td>{{count($ray_wk) > 0 ? implode(",",$ray_wk) : '-'}}</td>
                                        
                                    </tr>

                                @endfor
                              
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>{{$total_sks}}</td>
                                    <td>{{$total_mk}}</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tfoot>
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
