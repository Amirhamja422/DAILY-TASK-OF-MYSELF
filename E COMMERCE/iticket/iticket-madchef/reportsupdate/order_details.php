    <?php
    include '../db.php';
   
     


    if (isset($_REQUEST['order_id'])) {
        $order_id = $_REQUEST['order_id'];
        $sql = "SELECT * FROM order_list  WHERE order_id = '". $order_id."'";
        $order =  mysql_query($sql);
        $i = 1;
        while ($row = mysql_fetch_assoc($order)) { ?>

                          <tr>
                            <th scope="row"><?php echo $i++; ?></th>
                            <td><?php echo $row['product_name']; ?></td>
                            <td><?php echo $row['qty'] ?></td>
                            <td><?php echo $row['product_price'] ?></td>
                          </tr>


            <?php }     
        
    }


    ?>



        
                         

                                 