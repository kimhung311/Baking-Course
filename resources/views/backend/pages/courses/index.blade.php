@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('string.backend.table.course.title_index') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            {{ $dataTable->table() }}
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@stop

@push('after-js')
    {{$dataTable->scripts()}}
@endpush
