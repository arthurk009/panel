<script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
        
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
        
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
        
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        
        @endif

        @if(count($errors) > 0)
            @foreach($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
        </script>
    