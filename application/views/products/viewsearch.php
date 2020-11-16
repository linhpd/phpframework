<?php $number = 0?>

<?php foreach ($product as $todoitem):?>
<a class="big" href="../products/view/<?php echo $todoitem['Product']['ProductID']?>/<?php echo strtolower(str_replace(" ","-",$todoitem['Product']['ProductID']))?>">
	<span class="Product">
	<?php echo ++$number?>
	<?php echo $todoitem['Product']['Product_desc']?>
	</span>
	</a><br/>
<?php endforeach?>