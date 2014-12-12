<div class="emailDebug">
<h2>.: Dumping email</h2>
<p>The email extension is in debug mode, which means that the email was not actually sent but is dumped below instead</p>
<h3>Email</h3>
<strong>To:</strong>
<?php echo CHtml::encode($to) ?>
<br /><strong>Subject:</strong>
<?php echo CHtml::encode($subject) ?>
<div class="emailMessage"><?php echo $message ?></div>
<h3>Additional headers</h3>
<p><?php
foreach ($headers as $value) {
	echo CHtml::encode($value)."<br />\n";
}
?></p>
</div>