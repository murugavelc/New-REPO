
</div>
    <!-- /Footer panel -->
    <footer class="fixed-bottom">
        <div class="container">
            <div class="row">

                <!--Copyright-->
                <div class="col-md-6 col-xs-12">
                    <span class="text-green">كل الحقوق محفوظة &copy 2016</span>
                </div>
                <!--/.Copyright-->


                <!--social-->
                <div class="col-md-6 col-xs-12">
                    <ul class="social">
                        <li class="facebook"><a href=""><i class="fa fa-fw fa-facebook"></i></a></li>
                        <li class="twitter"><a href=""><i class="fa fa-fw fa-twitter"></i></a></li>
                        <li class="pinterest"><a href=""><i class="fa fa-fw fa-linkedin"></i></a></li>
                    </ul>
                </div>
                <!--/.social-->

            </div></div>
    </footer>

    <!-- /Footer panel -->


<?php
$start = date("Y")-20;
$end   = date("Y");
?>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/jQuery-2.1.4.min.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-english.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/jquery.jcarousel.pack.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/bootstrap-slider.js"></script>
<script type="text/javascript" src="<?php echo BASE; ?>assets/js/sweetalert.min.js"></script>
<script type="text/javascript">
   $('.carousel .vertical .item').each(function(){
  var next = $(this).next();
  if (!next.length) {
    next = $(this).siblings(':first');
  }
  next.children(':first-child').clone().appendTo($(this));

  for (var i=1;i<2;i++) {
    next=next.next();
    if (!next.length) {
        next = $(this).siblings(':first');
    }

    next.children(':first-child').clone().appendTo($(this));
  }
});

$("#ex16b").slider({ min: <?php echo $start;?>, max: <?php echo $end;?>, value: [0,<?php echo $end;?>], focus: true });
function languagechange(langid)
{
$.ajax({
		url:"<?php echo base_url('index.php/login/language_change'); ?>",
		type: "POST",
		data: { 
            lang_id: langid
		},
		success:function(result) {				
			location.reload();
		}		
	});
		return false; 
}
</script>
</body>
</html>


