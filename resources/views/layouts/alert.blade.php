<div class="container">
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors = session("errors"))
        <div class="alert alert-danger  alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            <ul class="list-unstyled">
            @foreach ($errors->all("<li>:message</li>") as $error)
                {!! $error !!}
            @endforeach
            </ul>
        </div>
    @endif
</div>