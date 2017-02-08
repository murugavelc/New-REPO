
<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/datatables.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/forms/selects/select2.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/buttons.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/jszip/jszip.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/pdfmake/pdfmake.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/plugins/tables/datatables/extensions/pdfmake/vfs_fonts.min.js"></script>

<script type="text/javascript" src="<?php echo BASE; ?>assets/js/core/app.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_extension_buttons_html5.js"></script>
<script>var target = {columnDefs: [{
        orderable: false,
        width: '200px',
        targets: [ 5 ]
    }],};</script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/pages/datatables_basic.js"></script>
<!-- /theme JS files -->


                <table class="table datatable-button-html5-basic2 table-striped table-hover table-bordered">
                    <thead>
                    <tr>
                        <th>S.No</th>
                        <th>Bidder Name</th>
                        <th>Bid Amount</th>
                        <th>Datetime</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($biddings)){ $i = 1;
                        foreach ($biddings as $bid){ ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $bid->first_name.' '.$bid->last_name; ?></td>
                                <td><?php echo $bid->bid_price; ?><small> <?php echo PRICE_PRE; ?></small></td>
                                <td><?php echo date('d M, Y h:i:s A',strtotime($bid->created_on)); ?></td>
                            </tr>
                            <?php $i++; }
                    } ?>

                    </tbody>
                </table>

