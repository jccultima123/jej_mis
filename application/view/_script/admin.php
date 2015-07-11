<script type="text/javascript">

    $(function() {
        $(".drag").sortable();
        $(".drag").disableSelection();
        $("#resizable" ).resizable();
    });
    
    var url = "<?php echo URL; ?>";
    $("document").ready(function(){
        refresh_pending();
        function refresh_pending() {
            setTimeout(refresh_pending, 3000);
            $("#pending_orders").load('<?php echo URL . 'admin/fetch/orders'; ?>');
            $("#pending_users").load('<?php echo URL . 'admin/fetch/users'; ?>');
        };
        function update_unread() {
            setTimeout(update_unread, 3000);
        };
    });

</script>