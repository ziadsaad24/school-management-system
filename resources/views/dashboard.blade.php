@extends('layouts.master') {{-- ده الماستر اللي بعتها لنا --}}

@section('page-header')
    <div class="page-header">
        <h1>{{trans('main_trans.Dashboard')}}</h1>
    </div>
@endsection
@section('PageTitle')
{{ trans('main_trans.Dashboard') }}
@stop
@section('title')
    {{ trans('main_trans.Dashboard') }}
@stop

@section('content')
    <div class="dashboard-content">
        <p>{{trans('main_trans.Dashboard_content')}}</p>

        {{-- مثال لو عايز تعرض جداول أو بيانات --}}
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">أحدث الدرجات</h5>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>الاسم</th>
                            <th>الدرجة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>محمد أحمد</td>
                            <td>95</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>علي حسن</td>
                            <td>88</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
