@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Users</h1>
  <!-- Button trigger modal -->
</div>
<div class="d-flex justify-content-end gap-2 mb-2">
  <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#adminModal">
    + Admin
  </button>
  <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#karyawanModal">
    + Karyawan
  </button>
</div>

<div class="table-responsive col-lg-12">
  <table class="table">
    <thead class="table-dark">
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Nama</th>
        <th scope="col">Email</th>
        <th scope="col">Divisi</th>
        <th scope="col">Jabatan</th>
        <th scope="col">Role</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->divisi === "NULL" ? "-" : $user->divisi}}</td>
          <td>{{ $user->jabatan === "NULL" ? "-" : $user->jabatan }}</td>
          <td>{{ $user->role }}</td>
          <td class="d-flex align-items-center gap-1">
            <button href="" class="badge bg-warning" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}"><span data-feather="edit" class="align-text-bottom"></span></button>
            <form id="deleteSubmit" action="{{ url('dashboard/users/'. $user->id .'/delete') }}" method="POST">
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

<!-- Admin Modal -->

<div class="modal fade" id="adminModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data Admin</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/dashboard/users" method="POST">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="divisi" value="NULL">
        <input type="hidden" name="jabatan" value="NULL">
        <input type="hidden" name="role" value="ADMIN">
        <div class="mb-2">
          <label for="exampleInputName" class="form-label">Nama</label>
          <input required name="name" placeholder="John Doe" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input required name="email" placeholder="johndoe@gmail.com" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword" class="form-label">Password</label>
          <input required name="password" placeholder="123" type="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp">
        </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-dark">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>


<!-- Karyawan Modal -->

<div class="modal fade" id="karyawanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah data Karyawan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form action="/dashboard/users" method="POST">
        @csrf
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="role" value="KARYAWAN">
        <div class="mb-2">
          <label for="exampleInputName" class="form-label">Nama</label>
          <input required name="name" placeholder="John Doe" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input required name="email" placeholder="johndoe@gmail.com" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputPassword" class="form-label">Password</label>
          <input required name="password" placeholder="123" type="password" class="form-control" id="exampleInputPassword" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputDivisi" class="form-label">Divisi</label>
          <input required name="divisi" placeholder="Humas" type="text" class="form-control" id="exampleInputDivisi" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputJabatan" class="form-label">Jabatan</label>
          <input required name="jabatan" placeholder="Kepala Dinas" type="text" class="form-control" id="exampleInputJabatan" aria-describedby="emailHelp">
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
@foreach ($users as $user)
<div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit data {{ ucfirst(strtolower($user->role)) }}</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <form method="POST">
        @csrf {!! method_field('PUT') !!}  
        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
        <input type="hidden" name="id" value="{{ $user->id}}">
        <input type="hidden" name="password" value="{{ $user->password}}">
        <input type="hidden" name="role" value="{{ $user->role }}">
        <div class="mb-2">
          <label for="exampleInputName" class="form-label">Nama</label>
          <input required name="name" value="{{ $user->name }}" placeholder="John Doe" type="text" class="form-control" id="exampleInputName" aria-describedby="emailHelp">
        </div>
        <div class="mb-2">
          <label for="exampleInputEmail1" class="form-label">Email</label>
          <input required name="email" value="{{ $user->email }}" placeholder="johndoe@gmail.com" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="{{$user->role === "ADMIN" ? "d-none" : ""}}">
          <div class="mb-2">
            <label for="exampleInputDivisi" class="form-label">Divisi</label>
            <input type="{{$user->role === "ADMIN" ? "hidden" : "text"}}" required name="divisi" value="{{ $user->divisi }}" placeholder="Humas" class="form-control" id="exampleInputDivisi" aria-describedby="emailHelp">
          </div>
          <div class="mb-2">
            <label for="exampleInputJabatan" class="form-label">Jabatan</label>
            <input type="{{$user->role === "ADMIN" ? "hidden" : "text"}}" required name="jabatan" value="{{ $user->jabatan }}" placeholder="Kepala Dinas" type="text" class="form-control" id="exampleInputJabatan" aria-describedby="emailHelp">
          </div>
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