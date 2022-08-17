@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">{{count($tasks) == 0 ? "Anda belum memiliki tugas ✨" : "Tugas"}}</h1>
</div>

@can('admin')
<div class="d-flex justify-content-end gap-2 mb-2">
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#taskModal">
    + Tugas
  </button>
</div>
@endcan

@if(!count($tasks) == 0)
<div class="table-responsive col-lg-12">
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama Karyawan</th>
        <th scope="col">Nama Tugas</th>
        <th scope="col">Kecamatan</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($tasks as $task)
      <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $task->users->name }}</td>
        <td>{{ $task->task_name}}</td>
        <td>{{ $task->district->name}}</td>
        <td>
          <div class="rounded-pill text-center text-white {{ $task->status  === "Belum terlaksana" ? "bg-danger" : "bg-success" }}" style="width: 60%;">
            {{ $task->status }}
          </div>
        </td>
        <td class="d-flex align-items-center gap-1">
          <button class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $task->id }}">
            <span data-feather="{{ auth()->user()->role === 'ADMIN' ? 'edit' : 'check-circle' }}" class="align-text-bottom"></span>
          </button>
          @can('admin')
          <form id="deleteSubmit" action="{{ url('dashboard/tasks/'. $task->id .'/delete') }}" method="POST">
            @csrf
            <input name="_method" type="hidden" value="DELETE">
            <button type="submit" class="badge bg-danger delete-data">
              <span data-feather="x-circle" class="align-text-bottom"></span>
            </button>
          </form>
          @endcan
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endif


<!-- Tugas Modal -->
@can('admin')
<div class="modal fade" id="taskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="/dashboard/tasks" method="POST">
          @csrf
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <input type="hidden" name="status" value="Belum terlaksana">
          <div class="mb-2">
            <label for="exampleInputName" class="form-label">Nama Tugas</label>
            <input required name="task_name" placeholder="Ex: Setor data" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
          </div>
          <div class="mb-2">
            <label for="exampleInputKaryawan" class="form-label">Pilih Karyawan</label>
            <select name="user_id" class="form-select" aria-label="Default select example" id="exampleInputKaryawan">
              <option value="" selected disabled>Pilih Karyawan</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}">{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-2">
            <label for="exampleInputKaryawan" class="form-label">Pilih Kecamatan</label>
            <select name="district_id" class="form-select" aria-label="Default select example" id="exampleInputKaryawan">
              <option value="" selected disabled>Pilih Kecamatan</option>
              @foreach($districts as $district)
              <option value="{{ $district->id }}">{{ $district->name }}</option>
              @endforeach
            </select>
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-dark">Submit</button>
      </div>
      </form>
    </div>
  </div>
</div>
@endcan

<!-- Update Data -->
@if(auth()->user()->role === 'ADMIN')
@foreach ($tasks as $task)
<div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit data tugas</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="POST">
          @csrf {!! method_field('PUT') !!}
          <input type="hidden" name="_token" value="{{ csrf_token() }}" />
          <input type="hidden" name="id" value="{{ $task->id }}">
          <input type="hidden" name="status" value="Belum terlaksana">
          <div class="mb-2">
            <label for="exampleInputName" class="form-label">Nama Tugas</label>
            <input required name="task_name" value="{{ $task->task_name }}" placeholder="Ex: Setor data" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
          </div>
          <div class="mb-2">
            <label for="exampleInputKaryawan" class="form-label">Pilih Karyawan</label>
            <select name="user_id" class="form-select" aria-label="Default select example" id="exampleInputKaryawan">
              <option value="" selected disabled>Pilih Karyawan</option>
              @foreach($users as $user)
              <option value="{{ $user->id }}" {{ $user->id === $task->user_id ? 'selected' : ''}}>{{ $user->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-2">
            <label for="exampleInputKaryawan" class="form-label">Pilih Kecamatan</label>
            <select name="district_id" class="form-select" aria-label="Default select example" id="exampleInputKaryawan">
              <option value="" selected disabled>Pilih Kecamatan</option>
              @foreach($districts as $district)
              <option value="{{ $district->id }}" {{ $district->id === $task->district_id ? 'selected' : ''}}>{{ $district->name }}</option>
              @endforeach
            </select>
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
@endif

@if(auth()->user()->role !== 'ADMIN')
@foreach ($tasks as $task)
<!-- editModal{{ $task->status === 'Belum terlaksana' ? $task->id : '' }} -->
<div class="modal fade" id="editModal{{ $task->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="POST">
        @csrf {!! method_field('PUT') !!}
        <div class="modal-body text-center">
          @if($task->status === 'Belum terlaksana')
          <p style="font-size: 1.25rem; font-weight: 600;">Apakah tugas <strong>'{{ $task->task_name }}'</strong> sudah anda selesaikan?</p>
          @else
          <img src="https://c.tenor.com/rMxNr07CxSMAAAAC/cat-crazy-cat.gif" class="mb-2" alt="crazy-cat">
          <p style="font-size: 1.25rem; font-weight: 600;">✨✨ Anda telah menyelasaikan tugas ini ✨✨</p>
          @endif
          <div class="d-flex justify-content-center gap-2 mt-4">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <input type="hidden" name="id" value="{{ $task->id }}">
            <input type="hidden" name="task_name" value="{{ $task->task_name }}">
            <input type="hidden" name="user_id" value="{{ $task->user_id }}">
            <input type="hidden" name="district_id" value="{{ $task->district_id }}">
            <input type="hidden" name="status" value="{{ $task->status === 'Belum terlaksana' ? 'Terlaksana' : 'Belum terlaksana'}}">
            @if($task->status === 'Belum terlaksana')
            <button type="submit" class="btn btn-dark ml-auto">Iya</button>
            <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Belum</button>
            @endif
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach
@endif

@endsection