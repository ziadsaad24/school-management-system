@extends('layouts.master')

@section('styles')
    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.5/css/dataTables.bootstrap5.min.css" rel="stylesheet">
@endsection




@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <h3 class="mb-0">{{ trans('main_trans.Grades_list') }}</h3>

        <!-- زر إضافة مرحلة -->
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addGradeModal">
            {{ trans('Grades_trans.add_Grade') }}
        </button>
    </div>

    <table id="gradesTable" class="table table-striped table-bordered text-center">
        <thead class="thead-dark">
            <tr>
                <th>#</th>
                <th>{{ trans('Grades_trans.Name') }}</th>
                <th>{{ trans('Grades_trans.Notes') }}</th>
                <th>{{ trans('Grades_trans.Processes') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($grades as $grade)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $grade->Name }}</td>
                <td>{{ $grade->Notes }}</td>
                <td>
                    <!-- Edit -->
                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $grade->id }}">
                        <i class="fa fa-edit"></i>
                    </button>

                    <!-- Delete -->
                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $grade->id }}">
                        <i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
            <!-- ===== Edit Grade Modal ===== -->
<div class="modal fade" id="edit{{ $grade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">{{ trans('Grades_trans.add_Grade') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('Grades_trans.Close') }}">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <form id="addGradeForm" action="{{ route('Grades.update',$grade->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="modal-body">
          
          <!-- Stage name Arabic -->
          <div class="form-group">
              <label for="stage_name_ar">{{ trans('Grades_trans.stage_name_ar') }}</label>
              <input type="text" name="Name_ar" id="stage_name_ar" class="form-control" value="{{ $grade->getTranslation('Name','ar') }}" >
          </div>

          <!-- Stage name English -->
          <div class="form-group">
              <label for="stage_name_en">{{ trans('Grades_trans.stage_name_en') }}</label>
              <input type="text" name="Name_en" id="stage_name_en" class="form-control" value="{{ $grade->getTranslation('Name','en') }}" >
          </div>

          <!-- Notes -->
          <div class="form-group">
              <label for="Notes">{{ trans('Grades_trans.Notes') }}</label>
              <textarea name="Notes" id="Notes" class="form-control" rows="3">{{ $grade->Notes }}</textarea>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            {{ trans('Grades_trans.Close') }}
          </button>
          <button type="submit" class="btn btn-success">
            {{ trans('Grades_trans.submit') }}
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- ===== End Add Grade Modal ===== -->

            <!-- Delete Modal -->
<div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ trans('Grades_trans.Delete') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('Grades_trans.Close') }}">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <form action="{{ route('Grades.destroy', $grade->id) }}" method="POST">
        @csrf
        @method('DELETE')

        <div class="modal-body">
          <p>{{ trans('Grades_trans.Warning_Grade') }}</p>
          <p><strong>{{ $grade->Name }}</strong></p>
        </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            {{ trans('Grades_trans.Close') }}
          </button>
          <button type="submit" class="btn btn-danger">
            {{ trans('Grades_trans.Delete') }}
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- End Delete Modal -->


            @endforeach
        </tbody>
    </table>
</div>

<!-- ===== Add Grade Modal ===== -->
<div class="modal fade" id="addGradeModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

      <!-- Header -->
      <div class="modal-header">
        <h5 class="modal-title">{{ trans('Grades_trans.add_Grade') }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="{{ trans('Grades_trans.Close') }}">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <!-- Body -->
      <form id="addGradeForm" action="{{ route('Grades.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          
          <!-- Stage name Arabic -->
          <div class="form-group">
              <label for="stage_name_ar">{{ trans('Grades_trans.stage_name_ar') }}</label>
              <input type="text" name="Name_ar" id="stage_name_ar" class="form-control" required>
          </div>

          <!-- Stage name English -->
          <div class="form-group">
              <label for="stage_name_en">{{ trans('Grades_trans.stage_name_en') }}</label>
              <input type="text" name="Name_en" id="stage_name_en" class="form-control" required>
          </div>

          <!-- Notes -->
          <div class="form-group">
              <label for="Notes">{{ trans('Grades_trans.Notes') }}</label>
              <textarea name="Notes" id="Notes" class="form-control" rows="3"></textarea>
          </div>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">
            {{ trans('Grades_trans.Close') }}
          </button>
          <button type="submit" class="btn btn-success">
            {{ trans('Grades_trans.submit') }}
          </button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- ===== End Add Grade Modal ===== -->


@endsection

@section('scripts')
    <!-- jQuery (لو مش موجود عندك) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#gradesTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.13.5/i18n/ar.json"
                }
            });
        });
    </script>
@endsection
