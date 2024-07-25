@extends('layouts.template')

@section('content')
<div class="container-fluid">
    <div class="row">
        <section class="col-lg-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Tahap dan Mekanisme Penilaian</h3>
                    <div class="card-tools">
                        <a href="{{ route('tahap_mekanisme_penilaian.create') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>CPL</th>
                                <th>MK</th>
                                <th>CPMK</th>
                                <th>Tahap Penilaian</th>
                                <th>Teknik Penilaian</th>
                                <th>Instrumen</th>
                                <th>Kriteria</th>
                                <th>Bobot</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->cpl }}</td>
                                    <td>{{ $item->mk }}</td>
                                    <td>{{ $item->cpmk }}</td>
                                    <td>{{ $item->tahap_penilaian }}</td>
                                    <td>{{ $item->teknik_penilaian }}</td>
                                    <td>{{ $item->instrumen }}</td>
                                    <td>{{ $item->kriteria }}</td>
                                    <td>{{ $item->bobot }}%</td>
                                    <td>
                                        <a href="{{ route('tahap_mekanisme_penilaian.edit', $item->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('tahap_mekanisme_penilaian.destroy', $item->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
</div>
@endsection
