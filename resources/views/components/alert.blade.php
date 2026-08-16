<!-- show errors -->
@if($errors->any())
    <div class="alert alert-danger" id="errorMessage">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- show success -->
@if(session('success'))
    <div class="alert alert-success" id="successMessaage">
        {{ session('success') }}
    </div>
@endif

<script>
setTimeout(
    function () {
        /*  give the different id because sometimes show error message for long time 
            and success message for short time. */
        // ? -> if id not found then not give the error
        document.getElementById('errorMessage')?.remove();
        document.getElementById('successMessaage')?.remove();
    } , 3000
);
</script>