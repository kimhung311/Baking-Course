{{-- <a class="btn btn-xs btn-primary" href="#">
    {{ __('string.backend.table.course.btn_show') }}
</a> --}}
<a class="btn btn-xs btn-info" href="{{ $routeEdit }}">
    {{ __('string.backend.table.course.btn_edit') }}
</a>
<form action="{{ $routeDelete }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
    style="display: inline-block;">
    <input type="hidden" name="_method" value="DELETE">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-xs btn-danger" value="{{ __('string.backend.table.course.btn_delete') }}">
</form>
