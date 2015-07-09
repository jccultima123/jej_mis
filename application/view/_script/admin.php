<script type="text/javascript">

    $(function() {
        $(".drag").sortable();
        $(".drag").disableSelection();
        $("#resizable" ).resizable();
    });
    
    var url = "<?php echo URL; ?>";
    $("document").ready(function(){
        function refresh_box() {
            $("#pending_orders").load('<?php echo URL . 'admin/updatePending/orders'; ?>');
            $("#pending_users").load('<?php echo URL . 'admin/updatePending/users'; ?>');
            //$("#live_count").load('<?php echo URL . 'admin/updateCount'; ?>');
        };
        setInterval(refresh_box(), 10000);
    });

</script>