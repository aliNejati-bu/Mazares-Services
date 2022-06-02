<script src="/assets/js/toastr.min.js"></script>

<script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };

    <?php
    if (isError()){
    foreach (errors() as $error){
    ?>
    toastr.error('<?= $error ?>')
    <?php
    }
    }
    ?>
    <?php
    if (isMessage()){
    foreach (messages() as $error){
    ?>
    toastr.info('<?= $error ?>')
    <?php
    }
    }
    ?>
</script>
