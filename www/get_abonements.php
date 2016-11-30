    <?php
        include_once 'conn.php';
     
        $id = mysql_real_escape_string($_REQUEST['idClient']);
     
        $rs = mysql_query("select nameAb, firstDate, statusAb, countOfTrains, isPaid
                            from clients, abonementofclient, abonement
                            where abonementofclient.idClient = '$id'
                            and abonementofclient.idAbonement = abonement.idAbonement
                            and abonementofclient.idClient = clients.idClient");

        while($row = mysql_fetch_array($rs)){ 
    ?>       
                <p>Абонемент: <?php echo $row['nameAb'];?></p>
                <table class="dv-table" border="0" style="width:100%;">
                    <tr>
                        <td class="dv-label" >первый день: </td>
                        <td><?php echo $row['firstDate'];?></td>
                    </tr>
                    <tr>
                        <td class="dv-label">статус: </td>
                        <td><?php echo $row['statusAb'];?></td>
                    </tr>
                    <tr>
                        <td class="dv-label">посетил занятий: </td>
                        <td><?php echo $row['countOfTrains'];?></td>
                    </tr>
                    <tr>
                        <td class="dv-label">оплачено: </td>
                        <td colspan="dv-label"><?php echo $row['isPaid'];?></td>
                    </tr>
                </table>
            
     <?php } ?>
