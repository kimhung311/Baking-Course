@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    <div class="card card-info">
        <div class="card-header">
            <h3 class="card-title">Login</h3>
        </div>
        <div class="card-body">
            <form action="#" method="post" enctype="multipart/form-data">
                @csrf
                <textarea class="tinymce" name="tinymce"></textarea>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
@stop

@push('after-js')
    <script>
        console.log('Hi!');
    </script>
@endpush
