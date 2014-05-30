<div style="clear:both;"></div>
	<hr />
	<footer>
        <div style="float:left"><p>&copy; <a href="http://www.matthirschfelt.com/" target="_blank">Matt Hirschfelt</a> <?php echo date('Y'); ?> | <a href="pp.php">Privacy Policy</a></p></div>
</div>
    </footer>

    </div> <!-- /container -->

   <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./assets/js/jquery.js"></script>
    <script src="./assets/js/bootstrap.min.js"></script>
	<script src="./assets/js/jquery.validate.js"></script>
	<script src="./assets/js/jquery.validation.functions.js"></script>
	<script src="./assets/js/jquery.tablesorter.min.js"></script> 
	<script type="text/javascript">
    $("[rel=tooltip]").tooltip();
	<?php if(isset($_POST['submit'])) {
	echo"
	$('#collapseOne').collapse('hide');
	$('#collapseSix').collapse('show');
	"; } ?>
	</script>
	<script type="text/javascript">
		function check(what){	
			var length=what.query.value.length;	
			if (length > 1)
			what.submit();
		else
			alert("Your search must be at least two characters long.");
		}
	</script>
	<?php if ($exactsearch === "true" && $searchtype ==="p") {
			} else { ?>
	<script type="text/javascript">
		$(document).ready(function() 
			{ 
				$("#tablelist").tablesorter(); 
			} 
		); 
	</script> <?php }
	
 mysql_close($con); ?>
  </body>
</html>