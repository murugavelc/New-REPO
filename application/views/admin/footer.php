
                    <!-- Footer -->
                    <div class="footer text-muted">
                        &copy; <?php echo date('Y'); ?>. <a href="#">company</a>
                    </div>
                    <!-- /footer -->

                </div>
                <!-- /content area -->

            </div>
            <!-- /main content -->

        </div>
        <!-- /page content -->

    </div>
    <!-- /page container -->

</body>
</html>
<script src="<?php echo BASE; ?>assets/js/plugins/jquery.mCustomScrollbar.concat.min.js"></script>
<script>
    $(window).on("load",function() {
//        $("#ProjectSearchResult").mCustomScrollbar({
//            setHeight:200,
//            theme: "minimal-dark",
//        });
    });
    $(document).on('keyup','#ProjectSearch',function (e) {
        e.preventDefault();
        var psval = $(this).val();
        if(psval.length > 1){
            console.log(psval);
            $.ajax({
                url : '<?php echo BASE; ?>projects/searchProject',
                type : 'POST',
                data: {psval : psval},
                success: function (data) {
//                    console.log(data);
                    if(data){
                        $('#ProjectSearchResult').html(data);
                        $('#ProjectSearchResult').show();
//                        $("#ProjectSearchResult").mCustomScrollbar({
//                            setHeight:200,
//                            theme: "minimal-dark",
//                        });
                    }
                }
            });
        }else{
            $('#ProjectSearchResult').hide();
        }
    });
</script>