<script type="text/javascript">

    $(function() {
        $(".drag").sortable();
        $(".drag").disableSelection();
        $("#resizable" ).resizable();
    });
    
    var url = "<?php echo URL; ?>";
    $("document").ready(function(){
        refresh_box();
        function refresh_box() {
            setInterval(refresh_box, 10000);
            $("#pending_orders").load('<?php echo URL . 'admin/fetch/orders'; ?>');
            $("#pending_users").load('<?php echo URL . 'admin/fetch/users'; ?>');
        };
    });

</script>