@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}<br />
        @endforeach
    </div>
@endif

@if (session()->get('flash_success'))
    <div class="alert alert-success">
        {{ session()->get('flash_success') }}
    </div>
@endif

@if (session()->get('flash_warning'))
    <div class="alert alert-warning">
        {{ session()->get('flash_warning') }}
    </div>
@endif

@if (session()->get('flash_info') || session()->get('flash_message'))
    <div class="alert alert-info">
        {{ session()->get('flash_info') }}
    </div>
@endif

@if (session()->get('flash_danger'))
    <div class="alert alert-danger">
        {{ session()->get('flash_danger') }}
    </div>
@endif

@if (session()->has('success'))
    <div class="alert alert-success">
        @if (is_array(session('success')))
            <ul>
                @foreach (session('success') as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        @else
            {{ session('success') }}
        @endif
    </div>
@endif
