<!DOCTYPE html>
<html lang="en">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>Question Bank Admin - Shiba Survey by DreamOn LLC</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script language="javascript">
		var urlForJs="<?php echo SITE_URL ?>";
	</script>
	<?php
		echo $this->Html->meta('icon');
		/* Bootstrap CSS */
		echo $this->Html->css('bootstrap.css?q='.QRDN);
		
		/* Usermgmt Plugin CSS */
		echo $this->Html->css('/usermgmt/css/umstyle.css?q='.QRDN);
		
		/* Jquery latest version taken from http://jquery.com */
		echo $this->Html->script('jquery-1.10.2.min.js');
		
		/* Bootstrap JS */
		echo $this->Html->script('bootstrap.js?q='.QRDN);

		/* Usermgmt Plugin JS */
		echo $this->Html->script('/usermgmt/js/umscript.js?q='.QRDN);
		echo $this->Html->script('/usermgmt/js/ajaxValidation.js?q='.QRDN);

		echo $this->Html->script('/usermgmt/js/chosen/chosen.ajaxaddition.jquery.js?q='.QRDN);

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div class="container">
		<div class="content">
			<?php
				if($this->UserAuth->isLogged()) {
					echo $this->element('Usermgmt.dashboard');
				} ?>
			<?php echo $this->element('Usermgmt.message'); ?>
			<?php echo $this->element('Usermgmt.message_validation'); ?>
			<?php echo $this->fetch('content'); ?>
			<div style="clear:both"></div>
		</div>
	</div>
	<div id="footer">
		<div class="container">
			<p class="muted">Copyright &copy; 2010-<?php echo date('Y');?> <a href="http://dreamons.jp/" target='_blank'>DreamOn LLC.</a> All Rights Reserved.</p>
		</div>
    </div>
	<?php if(class_exists('JsHelper') && method_exists($this->Js, 'writeBuffer')) { echo $this->Js->writeBuffer(); } ?>
</body>
</html>