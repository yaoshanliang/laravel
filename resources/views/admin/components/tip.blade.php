@if ((count($errors) > 0) && ($validateErrors = $errors->toArray()))
    <div class="alert alert-danger danger-warning">
        <strong>Whoops!</strong> There were some problems with your input.
        <ul>
            @if (isset($validateErrors['message']))
                @foreach ($validateErrors['message'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @else
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            @endif
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        <ul>
            <li>{{ session('success') }}</li>
        </ul>
    </div>
@endif