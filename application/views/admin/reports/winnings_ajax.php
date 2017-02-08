
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/ui/moment/moment.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/pickers/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/components_page_header.js"></script>-->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_extension_buttons_html5.js"></script>
<!--<script type="text/javascript" src="--><?php //echo BASE; ?><!--assets/js/pages/datatables_basic.js"></script>-->
<!-- /theme JS files -->

                <table class="table datatable-button-html5-basic2 table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Base Price</th>
                        <th>Winner</th>
                        <th>Close Price</th>
                        <th>Closed Date</th>
                        <th>Start Datetime</th>
                        <th>End Datetime</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php GLOBAL $USER_ROLES; if(!empty($winnings)){ foreach ($winnings as $product){ ?>
                        <tr>
                            <td><?php echo $product->product_id; ?></td>
                            <td><?php echo $product->title; ?></td>
                            <td><?php echo $product->base_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                            <td><?php echo $product->first_name.' '.$product->last_name.' (#'.$product->user_id.')'; ?></td>
                            <td><?php echo $product->bid_close_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                            <td><?php echo date('d M, Y h:i A',strtotime($product->bid_close_date)); ?></td>
                            <td><?php echo date('d M, Y h:i A',strtotime($product->start_datetime)); ?></td>
                            <td><?php echo date('d M, Y h:i A',strtotime($product->end_datetime)); ?></td>
                        </tr>
                    <?php } } ?>
                    </tbody>
                </table>
            