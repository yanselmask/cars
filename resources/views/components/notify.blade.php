<!-- CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.css" />
<!-- JS -->
<script src="https://cdn.jsdelivr.net/npm/simple-notify@1.0.4/dist/simple-notify.min.js"></script>
@session('notify')
<script>
        new Notify({
            status: "{{session('notify')[0]}}",
            title: "{{session('notify')[1]}}",
            text: "{{session('notify')[2]}}",
            effect: 'fade',
            speed: 300,
            customClass: null,
            customIcon: null,
            showIcon: true,
            showCloseButton: true,
            autoclose: true,
            autotimeout: 3000,
            gap: 20,
            distance: 20,
            type: 'outline',
            position: 'right top'
        });
</script>
@endsession
