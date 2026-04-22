@push('tinymce-run')
<script>
    addEventListener("DOMContentLoaded", (event) => {

        tinymce.init({
            selector: 'textarea'
        });
     })
</script>
@endpush