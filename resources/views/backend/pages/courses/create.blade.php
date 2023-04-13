@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">{{ __('string.backend.table.course.title_create') }}</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <!-- form start -->
            @php
                $url = route('admin.courses.store');
                $method = 'POST';
            @endphp
            @include('backend.pages.courses.detail_form.section')
        </div>
    </div>
@stop
