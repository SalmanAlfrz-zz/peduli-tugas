@extends('layout.master')

@push('plugin-styles')
<link href="{{ asset('assets/plugins/bootstrap-datepicker/css/bootstrap-datepicker.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.min.css') }}" rel="stylesheet"/>
@endpush


@section('content')
{{-- <script>
@if(Session::has('success'))
// swal("Hey", "Sdas", "success")
  Swal.fire(
    'Good job',
    '{{ session('success') }}',
    'success')
@endif
</script>
<button onclick="showSwal('deleteSuccess')"></button> --}}

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
  <div>
    <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
  </div>
  <div class="d-flex align-items-center flex-wrap text-nowrap">
    <div class="input-group date datepicker wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
      <span class="input-group-text input-group-addon bg-transparent border-primary"><i data-feather="calendar" class=" text-primary"></i></span>
      <input type="text" class="form-control border-primary bg-transparent">
    </div>
    <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
      <i class="btn-icon-prepend" data-feather="printer"></i>
      Print
    </button>
    <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0" data-bs-toggle="modal" data-bs-target="#addDataModal">
      <i class="btn-icon-prepend" data-feather="download-cloud"></i>
      Tambah Tugas
    </button>

    {{-- Add Data Modal --}}
    <div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="varyingModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="varyingModalLabel">Tambah Tugas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="btn-close"></button>
          </div>
          <div class="modal-body">

            <form method="POST" action="/tambah">
              @csrf
              <div class="mb-3">
                <label class="form-label">Judul Tugas</label>
                <input class="form-control" type="text" name="judulTugas" placeholder="Ex: Tugas Matematika Dasar" required>
              </div>
              <div class="mb-3">
                <div class="row">
                 <label class="form-label">Waktu Deadline</label>
                 <div class="input-group date timepicker" id="datetimepickerExample" data-target-input="nearest">
                  <input class="form-control mb-4 mb-md-0" data-inputmask="'alias': 'datetime'" data-inputmask-inputformat="dd-mm-yyyy HH:MM:ss" name="deadline" placeholder="dd-mm-yyyy HH:MM:ss" />
                  <span class="input-group-text"><i data-feather="clock"></i></span>
                </div>
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label">Jenis Tugas</label>
              <select class="form-select" multiple="multiple" data-width="100%" name="jenisTugas" required>
                <option value="1">Individu</option>
                <option value="2">Kelompok</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Tingkat Kesulitan</label>
              <select class="form-select" multiple="multiple" data-width="100%" name="bobotTugas" required>
                <option value="1">Sulit</option>
                <option value="2">Sedang</option>
                <option value="3">Mudah</option>
              </select>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <input class="btn btn-primary" type="submit" value="Tambah">
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
</div>

<div class="row mb-4">
  <div class="col-lg-11 col-xl-12 stretch-card">
    <div class="card">
      <div class="card-body">
        <div class="d-flex justify-content-between align-items-baseline mb-2">
          <h6 class="card-title mb-0">Projects</h6>
          <div class="dropdown mb-2">
            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
              <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead>
              <tr>
                <th class="pt-0">#</th>
                <th class="pt-0">Nama Tugas</th>
                <th class="pt-0">Deadline</th>
                <th class="pt-0">Jenis</th>
                <th class="pt-0">Kesulitan Tugas</th>
                <th class="pt-0">Prioritas Tugas</th>
                <th class="pt-0"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($tugas as $t)
              <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $t->nama }}</td>
                <td>{{ $t->deadline }}</td>
                <td>
                  @if($t->jenis == 1)
                  individu
                  @elseif($t->jenis == 2)
                  kelompok
                  @else
                  {{ $t->jenis }}
                  @endif
                </td>
                <td>
                  @if($t->bobot == 3)
                  Mudah
                  @elseif($t->bobot == 2)
                  Sedang
                  @elseif($t->bobot == 1)
                  sulit
                  @else
                  {{ $t->bobot }}
                  @endif
                </td>
                <td>
                  @if($t->priority_value <= 2.25 && $t->status == "Belum Selesai")
                    <span class="badge bg-danger">Sangat Penting</span>
                    @elseif($t->priority_value > 2.25 && $t->priority_value < 4.6 && $t->status == "Belum Selesai")
                    <span class="badge bg-warning">Penting</span>
                    @elseif($t->priority_value >= 4.6 && $t->status == "Belum Selesai")
                    <span class="badge bg-success">Kurang Penting</span>
                    @elseif($t->status == "Selesai")
                    <span class="badge bg-primary">Sudah Selesai</span>
                    @endif
                  </td>
                  <td>
                    {{-- {{ $t->priority_value }} --}}
                    <div class="dropdown mb-2">
                      <button class="btn p-0" type="button" id="dropdownMenuButton8" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton8">
                        @if($t->status == "Belum Selesai")
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"></i><span class="">Tandai Selesai</span></a>
                        @elseif($t->status == "Selesai")
                        <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="x-circle" class="icon-sm me-2"><span class="">Tandai Belum Selesai</span></a>
                          @endif
                          <a class="dropdown-item d-flex align-items-center" href="javascript:;"><span class="">Ubah</span></a>
                          <a class="dropdown-item d-flex align-items-center" href="/hapus/{{ $t->id }}"><span class="">Hapus</span></a>
                        </div>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div> 
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-12 col-xl-12 stretch-card">
        <div class="row flex-grow-1">
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">New Customers</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">3,897</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span>+3.3%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p>
                    </div>
                  </div>
                  <div class="col-6 col-md-12 col-xl-7">
                    <div id="customersChart" class="mt-md-3 mt-xl-0"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">New Orders</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">35,084</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-danger">
                        <span>-2.8%</span>
                        <i data-feather="arrow-down" class="icon-sm mb-1"></i>
                      </p>
                    </div>
                  </div>
                  <div class="col-6 col-md-12 col-xl-7">
                    <div id="ordersChart" class="mt-md-3 mt-xl-0"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-4 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline">
                  <h6 class="card-title mb-0">Growth</h6>
                  <div class="dropdown mb-2">
                    <button class="btn p-0" type="button" id="dropdownMenuButton2" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton2">
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                      <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-6 col-md-12 col-xl-5">
                    <h3 class="mb-2">89.87%</h3>
                    <div class="d-flex align-items-baseline">
                      <p class="text-success">
                        <span>+2.8%</span>
                        <i data-feather="arrow-up" class="icon-sm mb-1"></i>
                      </p>
                    </div>
                  </div>
                  <div class="col-6 col-md-12 col-xl-7">
                    <div id="growthChart" class="mt-md-3 mt-xl-0"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-12 col-xl-12 grid-margin stretch-card">
        <div class="card overflow-hidden">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-4 mb-md-3">
              <h6 class="card-title mb-0">Revenue</h6>
              <div class="dropdown">
                <button class="btn p-0" type="button" id="dropdownMenuButton3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton3">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
              </div>
            </div>
            <div class="row align-items-start mb-2">
              <div class="col-md-7">
                <p class="text-muted tx-13 mb-3 mb-md-0">Revenue is the income that a business has from its normal business activities, usually from the sale of goods and services to customers.</p>
              </div>
              <div class="col-md-5 d-flex justify-content-md-end">
                <div class="btn-group mb-3 mb-md-0" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-outline-primary">Today</button>
                  <button type="button" class="btn btn-outline-primary d-none d-md-block">Week</button>
                  <button type="button" class="btn btn-primary">Month</button>
                  <button type="button" class="btn btn-outline-primary">Year</button>
                </div>
              </div>
            </div>
            <div id="revenueChart"></div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-lg-7 col-xl-8 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Monthly sales</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton4">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
              </div>
            </div>
            <p class="text-muted">Sales are activities related to selling or the number of goods or services sold in a given time period.</p>
            <div id="monthlySalesChart"></div>
          </div> 
        </div>
      </div>
      <div class="col-lg-5 col-xl-4 grid-margin stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Cloud storage</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton5" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton5">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
              </div>
            </div>
            <div id="storageChart"></div>
            <div class="row mb-3">
              <div class="col-6 d-flex justify-content-end">
                <div>
                  <label class="d-flex align-items-center justify-content-end tx-10 text-uppercase fw-bolder">Total storage <span class="p-1 ms-1 rounded-circle bg-secondary"></span></label>
                  <h5 class="fw-bolder mb-0 text-end">8TB</h5>
                </div>
              </div>
              <div class="col-6">
                <div>
                  <label class="d-flex align-items-center tx-10 text-uppercase fw-bolder"><span class="p-1 me-1 rounded-circle bg-primary"></span> Used storage</label>
                  <h5 class="fw-bolder mb-0">~5TB</h5>
                </div>
              </div>
            </div>
            <div class="d-grid">
              <button class="btn btn-primary">Upgrade storage</button>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- row -->

    <div class="row">
      <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Inbox</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton6">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
              </div>
            </div>
            <div class="d-flex flex-column">
              <a href="javascript:;" class="d-flex align-items-center border-bottom pb-3">
                <div class="me-3">
                  <img src="{{ url('https://via.placeholder.com/35x35') }}" class="rounded-circle wd-35" alt="user">
                </div>
                <div class="w-100">
                  <div class="d-flex justify-content-between">
                    <h6 class="fw-normal text-body mb-1">Leonardo Payne</h6>
                    <p class="text-muted tx-12">12.30 PM</p>
                  </div>
                  <p class="text-muted tx-13">Hey! there I'm available...</p>
                </div>
              </a>
              <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                <div class="me-3">
                  <img src="{{ url('https://via.placeholder.com/35x35') }}" class="rounded-circle wd-35" alt="user">
                </div>
                <div class="w-100">
                  <div class="d-flex justify-content-between">
                    <h6 class="fw-normal text-body mb-1">Carl Henson</h6>
                    <p class="text-muted tx-12">02.14 AM</p>
                  </div>
                  <p class="text-muted tx-13">I've finished it! See you so..</p>
                </div>
              </a>
              <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                <div class="me-3">
                  <img src="{{ url('https://via.placeholder.com/35x35') }}" class="rounded-circle wd-35" alt="user">
                </div>
                <div class="w-100">
                  <div class="d-flex justify-content-between">
                    <h6 class="fw-normal text-body mb-1">Jensen Combs</h6>
                    <p class="text-muted tx-12">08.22 PM</p>
                  </div>
                  <p class="text-muted tx-13">This template is awesome!</p>
                </div>
              </a>
              <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                <div class="me-3">
                  <img src="{{ url('https://via.placeholder.com/35x35') }}" class="rounded-circle wd-35" alt="user">
                </div>
                <div class="w-100">
                  <div class="d-flex justify-content-between">
                    <h6 class="fw-normal text-body mb-1">Amiah Burton</h6>
                    <p class="text-muted tx-12">05.49 AM</p>
                  </div>
                  <p class="text-muted tx-13">Nice to meet you</p>
                </div>
              </a>
              <a href="javascript:;" class="d-flex align-items-center border-bottom py-3">
                <div class="me-3">
                  <img src="{{ url('https://via.placeholder.com/35x35') }}" class="rounded-circle wd-35" alt="user">
                </div>
                <div class="w-100">
                  <div class="d-flex justify-content-between">
                    <h6 class="fw-normal text-body mb-1">Yaretzi Mayo</h6>
                    <p class="text-muted tx-12">01.19 AM</p>
                  </div>
                  <p class="text-muted tx-13">Hey! there I'm available...</p>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-7 col-xl-8 stretch-card">
        <div class="card">
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-baseline mb-2">
              <h6 class="card-title mb-0">Projects</h6>
              <div class="dropdown mb-2">
                <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="eye" class="icon-sm me-2"></i> <span class="">View</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Edit</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="trash" class="icon-sm me-2"></i> <span class="">Delete</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="printer" class="icon-sm me-2"></i> <span class="">Print</span></a>
                  <a class="dropdown-item d-flex align-items-center" href="javascript:;"><i data-feather="download" class="icon-sm me-2"></i> <span class="">Download</span></a>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table class="table table-hover mb-0">
                <thead>
                  <tr>
                    <th class="pt-0">#</th>
                    <th class="pt-0">Project Name</th>
                    <th class="pt-0">Start Date</th>
                    <th class="pt-0">Due Date</th>
                    <th class="pt-0">Status</th>
                    <th class="pt-0">Assign</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>NobleUI jQuery</td>
                    <td>01/01/2021</td>
                    <td>26/04/2021</td>
                    <td><span class="badge bg-danger">Released</span></td>
                    <td>Leonardo Payne</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>NobleUI Angular</td>
                    <td>01/01/2021</td>
                    <td>26/04/2021</td>
                    <td><span class="badge bg-success">Review</span></td>
                    <td>Carl Henson</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>NobleUI ReactJs</td>
                    <td>01/05/2021</td>
                    <td>10/09/2021</td>
                    <td><span class="badge bg-info">Pending</span></td>
                    <td>Jensen Combs</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>NobleUI VueJs</td>
                    <td>01/01/2021</td>
                    <td>31/11/2021</td>
                    <td><span class="badge bg-warning">Work in Progress</span>
                    </td>
                    <td>Amiah Burton</td>
                  </tr>
                  <tr>
                    <td>5</td>
                    <td>NobleUI Laravel</td>
                    <td>01/01/2021</td>
                    <td>31/12/2021</td>
                    <td><span class="badge bg-danger">Coming soon</span></td>
                    <td>Yaretzi Mayo</td>
                  </tr>
                  <tr>
                    <td>6</td>
                    <td>NobleUI NodeJs</td>
                    <td>01/01/2021</td>
                    <td>31/12/2021</td>
                    <td><span class="badge bg-primary">Coming soon</span></td>
                    <td>Carl Henson</td>
                  </tr>
                  <tr>
                    <td class="border-bottom">3</td>
                    <td class="border-bottom">NobleUI EmberJs</td>
                    <td class="border-bottom">01/05/2021</td>
                    <td class="border-bottom">10/11/2021</td>
                    <td class="border-bottom"><span class="badge bg-info">Pending</span></td>
                    <td class="border-bottom">Jensen Combs</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div> 
        </div>
      </div>
    </div> <!-- row -->




    @endsection

    @push('plugin-scripts')
  <script src="{{ asset('assets/plugins/inputmask/jquery.inputmask.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/chartjs/chart.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery.flot/jquery.flot.resize.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/progressbar-js/progressbar.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/tempusdominus-bootstrap-4.js') }}"></script>
    @endpush

    @push('custom-scripts')
  <script src="{{ asset('assets/js/inputmask.js') }}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/sweet-alert.js') }}"></script>
    <script src="{{ asset('assets/js/datepicker.js') }}"></script>
    <script src="{{ asset('assets/js/timepicker.js') }}"></script>
    @endpush