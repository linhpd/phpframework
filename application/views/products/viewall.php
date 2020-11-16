

<a href="../products/insert">Add a Product</a>
<br>
<br>

<?php $number = 0 ?>

<table>
    <tr>
        <th class = "product">Product</th>
        <th class = "cost">Cost</th>
        <th class = "weight">Weight</th>
        <th class = "number">Number available</th>
    </tr>'

<?php foreach ($product as $todoitem): ?>


    <?php echo '<tr>' ?>
    <span class="Product">
        <td class = "product">
            <a class="big" href="../products/view/<?php echo $todoitem['Product']['ProductID'] ?>/<?php echo strtolower(str_replace(" ", "-", $todoitem['Product']['ProductID'])) ?>">
                <?php echo $todoitem['Product']['Product_desc'] ?>
            </a>
        </td>
        <td class = "cost">
            <a class="big" href="../products/view/<?php echo $todoitem['Product']['ProductID'] ?>/<?php echo strtolower(str_replace(" ", "-", $todoitem['Product']['ProductID'])) ?>">
                <?php echo $todoitem['Product']['Cost'] ?>
            </a>
        </td>
        <td class = "weight">
            <a class="big" href="../products/view/<?php echo $todoitem['Product']['ProductID'] ?>/<?php echo strtolower(str_replace(" ", "-", $todoitem['Product']['ProductID'])) ?>">
                <?php echo $todoitem['Product']['Weight'] ?>
            </a>
        </td>
        <td class = "number">
            <a class="big" href="../products/view/<?php echo $todoitem['Product']['ProductID'] ?>/<?php echo strtolower(str_replace(" ", "-", $todoitem['Product']['ProductID'])) ?>">
                <?php echo $todoitem['Product']['Numb'] ?>
            </a>
        </td>
    </span>
    <br/><?php echo '</tr>' ?>

<?php endforeach ?>
</table>