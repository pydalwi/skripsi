@extends('layouts.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            
            <div class="card">
                <div class="card-header">
                        <h3 class="card-title mt-1">
                        <i class="fas fa-angle-double-right text-md text-{{ $theme->card_outline }} mr-1"></i>
                        {!! $page->title !!}
                    </h3>
                    {{-- <div class="card-tools">
                        @if($allowAccess->create)
                            <button type="button" data-block="body" class="btn btn-sm btn-{{ $theme->button }} mt-1 ajax_modal" data-url="{{ $page->url }}/create"><i class="fas fa-plus"></i> Tambah</button>
                        @endif
                    </div> --}}
                </div>
                <form action="{{$page->url}}" method="post">
                    @csrf
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="table-responsive">   
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Mata Kuliah</th>
                                    <th colspan="100%" class="text-center"> Bahan Kajian</th>
                                </tr>
                                <tr>
                                    @foreach ($bahankajian as $bk)
                                        <th>{{$bk->bk_kode}}</th> 
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($matkul as $mk)
                                    <tr>
                                        <td>{{$loop->index+1}}</td>
                                        <td>{{$mk->mk_kode}}</td>
                                        @foreach ($bahankajian as $bk)  
                                        <td>
                                            @if(isset($mkbk[$mk->mk_id][$bk->bk_id]))
                                                <input {{ ($mkbk[$mk->mk_id][$bk->bk_id] == 1)? 'checked' : '' }} type="checkbox" name="mkbk[{{$mk->mk_id}}][{{$bk->bk_id}}]" value="1">
                                            @else
                                                <input type="checkbox" name="mkbk[{{$mk->mk_id}}][{{$bk->bk_id}}]" value="1">
                                            @endif
                                        </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                   
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save"></i> Simpan</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    </div>
</div>
@endsection


 