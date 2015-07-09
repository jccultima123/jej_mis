<script type="text/javascript">

    $(function() {
        $(".drag").sortable();
        $(".drag").disableSelection();
        $("#resizable" ).resizable();
    });
    
    var url = "<?php echo URL; ?>";
    $("document").ready(function(){
        function refresh_box() {
            $("#pending_orders").load('<?php echo URL . 'admin/fetch/orders'; ?>');
            $("#pending_users").load('<?php echo URL . 'admin/fetch/users'; ?>');
            //$("#sales_count").load('<?php echo URL . 'SOM/fetch/sales'; ?>');
            //$("#order_count").load('<?php echo URL . 'SOM/fetch/orders'; ?>');
            //$("#asset_count").load('<?php echo URL . 'AMS/fetch/assets'; ?>');
            //$("#customer_count").load('<?php echo URL . 'CRM/fetch/customers'; ?>');
            //$("#feedback_count").load('<?php echo URL . 'CRM/fetch/feedbacks'; ?>');
            //$("#product_count").load('<?php echo URL . 'admin/fetch/products'; ?>');
        };
        setInterval(refresh_box(), 10000);
    });

</script>