@if ($errors->count())
    <div class="alert alert-danger">
        Please correct the following errors before proceeding.

        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif