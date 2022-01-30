<?php  
//Prints tables for parts list
function display_parts_table($parts) { ?>
<!-- <h1>Existing Parts</h1> -->
<table>
  <tr>
    <th>Name</th>
    <th>Url</th>
    <th>Quantity</th>
    <th>Price</th>
    <th>Importance</th>
  </tr>
<?php foreach($parts as $part) { ?>
  <tr>
    <td><?= $part['name'] ?></td>
    <td><?= $part['url'] ?></td>
    <td><?= $part['quantity'] ?></td>
    <td>$<?= $part['price'] ?></td>
    <td><?= $part['importance'] ?>%</td>
    <!--<td>
        <input type="submit" value="EDIT" name="edit"><br/><br/>
        <input type="submit" value="DELETE" name="delete"><br/><br/>

        <?php
        $delete[$part['partID']] = $part['partID'];
        ?>
    </td>-->
  </tr>
<?php } ?>
</table>

<?php
}

?>