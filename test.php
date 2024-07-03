<script>
	var javascript_variable = "success";
</script>

<?php
	$javascript_to_php_variable = echo "<script> document.writeln(javascript_variable); </script>" ;
	echo $javascript_to_php_variable;
?>