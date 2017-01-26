<div class="container">
    <div class="flash-message">
        @if (session('success'))
            @if(session('success') != 'showmodalplease')
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
        @endif
        @if (session('fail'))
            <div class="alert alert-danger">
                {{ session('fail') }}
            </div>
        @endif
    </div> <!-- end .flash-message -->
</div>