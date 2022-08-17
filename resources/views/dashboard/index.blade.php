@extends('dashboard.layouts.main')

@section('container')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
  <h1 class="h2">Statistic</h1>
</div>

<div class="d-flex flex-wrap">
  <div class="col col-sm-12 col-md-12 col-lg-3 px-4 m-2 py-3 shadow">
    <div class="d-flex justify-content-between flex-column">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h5 class="card-title text-uppercase text-muted mb-0">Tugas</h5>
          <span class="h2 font-weight-bold mb-0">{{ $tasks_count }}</span>
        </div>
        <div>
          <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
            <span data-feather="file-text" style="width: 40px; height: 40px;"></span>
          </div>
        </div>
      </div>
      <hr />
      <p class="text-muted text-sm">
        <strong class="mr-2">{{ $unfinished_tasks_count }}</strong>
        <span class="px-2">Belum terlaksana</span>
      </p>
      <p class="text-muted text-sm">
        <strong class="text-success mr-2">{{ $finished_tasks_count }}</strong>
        <span class="px-2">Terlaksana</span>
      </p>
    </div>
  </div>

  @can('admin')
  <div class="col col-sm-12 col-md-12 col-lg-3 px-4 m-2 py-3 shadow">
    <div class="d-flex justify-content-between flex-column">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h5 class="card-title text-uppercase text-muted mb-0">Kecamatan</h5>
          <span class="h2 font-weight-bold mb-0">{{ $districts_count }}</span>
        </div>
        <div>
          <div class="icon icon-shape bg-orange text-white rounded-circle shadow">
            <span data-feather="flag" style="width: 40px; height: 40px;"></span>
          </div>
        </div>
      </div>
      <hr />
    </div>
  </div>

  <div class="col col-sm-12 col-md-12 col-lg-3 px-4 m-2 py-3 shadow">
    <div class="d-flex justify-content-between flex-column">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h5 class="card-title text-uppercase text-muted mb-0">Users</h5>
          <span class="h2 font-weight-bold mb-0">{{ $users_count }}</span>
        </div>
        <div>
          <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
            <span data-feather="users" style="width: 40px; height: 40px;"></span>
          </div>
        </div>
      </div>
      <hr />
      <div class="text-muted text-sm">
        <strong class="mr-2">{{ $admin_count }}</strong>
        <span class="px-2">Admin</span>
      </div>
      <p class="text-muted text-sm">
        <strong class="text-success mr-2">{{ $karyawan_count }}</strong>
        <span class="px-2">Karyawan</span>
      </p>
    </div>
  </div>
  @endcan
</div>


<div class="col-12">
  <div class="row">
    @if(!count($unfinished_tasks) == 0)
    <div class="table-responsive col-lg-5">
      <p style="font-weight: bold; font-size: 1.25rem;" class="mt-4">5 tugas terakhir yang belum selesai</p>
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Tugas</th>
            <th scope="col">Nama Karyawan</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($unfinished_tasks as $task)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $task->task_name}}</td>
            <td>{{ $task->users->name }}</td>
            <td>
              <div class="rounded-pill d-block text-center text-white {{ $task->status  === "Belum terlaksana" ? "bg-danger" : "bg-success" }}" style="width: 100%; font-size: 0.75rem;">
                {{ $task->status }}
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
    @if(!count($finished_tasks) == 0)
    <div class="table-responsive col-lg-5">
      <p style="font-weight: bold; font-size: 1.25rem;" class="mt-4">5 tugas terakhir yang selesai</p>
      <table class="table">
        <thead class="table-dark">
          <tr>
            <th scope="col">No.</th>
            <th scope="col">Nama Tugas</th>
            <th scope="col">Nama Karyawan</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($finished_tasks as $task)
          <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $task->task_name}}</td>
            <td>{{ $task->users->name }}</td>
            <td>
              <div class="rounded-pill d-block text-center text-white {{ $task->status  === "Belum terlaksana" ? "bg-danger" : "bg-success" }}" style="width: 100%; font-size: 0.75rem;">
                {{ $task->status }}
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    @endif
  </div>
</div>
@endsection