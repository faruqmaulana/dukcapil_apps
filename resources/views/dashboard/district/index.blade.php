@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Kecamatan</h1>
</div>

<div class="col-lg-7 d-flex justify-content-end gap-2 mb-2">
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#kecamatanModal">
    + Kecamatan
  </button>
</div>

<div class="table-responsive col-lg-7">
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama Kecamatan</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($districts as $district)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $district->name }}</td>
          <td class="d-flex align-items-center gap-1">
            <button href="" class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $district->id }}"><span data-feather="edit" class="align-text-bottom"></span></button>
            <form id="deleteSubmit" action="{{ url('dashboard/districts/'. $district->id .'/delete') }}" method="POST">
              @csrf
              <input name="_method" type="hidden" value="DELETE">
              <button type="submit" class="badge bg-danger delete-data">
              <span data-feather="x-circle" class="align-text-bottom"></span>
              </button>
            </form>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div>

<!-- Tambah data -->
<div class="modal fade" id="kecamatanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data kecamatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="/dashboard/districts" method="POST">
        <div class="modal-body">
          @csrf 
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <div class="mb-2">
            <label for="exampleInputName" class="form-label">Nama Kecamatan</label>
            <input required name="name" placeholder="Mojo" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Update data -->
@foreach ($districts as $district)
<div class="modal fade" id="editModal{{ $district->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit data kecamatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        <div class="modal-body">
          @csrf {!! method_field('PUT') !!}  
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <input type="hidden" name="id" value="{{ $district->id}}">
          <div class="mb-2">
            <label for="exampleInputName" class="form-label">Nama Kecamatan</label>
            <input required name="name" value="{{ $district->name }}" placeholder="John Doe" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

@endsection