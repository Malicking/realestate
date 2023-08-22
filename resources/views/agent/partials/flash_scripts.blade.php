<!-- Toastr -->
{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> --}}
<script type="text/javascript" src="{{ asset('backend/assets/js/toastr.min.js') }}"></script>
 
<script>
    @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;

        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;

        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;

        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break; 
        }
    @endif 
</script>
<!-- Toastr -->
 
<!-- Sweet alert -->
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> --}}
<script src="{{ asset('backend/assets/js/sweetalert2@10.js') }}"></script>        
<script src="{{ asset('backend/assets/js/code.js') }}"></script>        
<!-- Sweet alert -->
