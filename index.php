<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 3px  solid black;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <form method="post" action="import.php" enctype="multipart/form-data">
    <input type="file" name="excel_file" accept=".xlsx">
    <input type="submit" name="import" value="Import">
    </form>
    <table>
    <tr>
    <th>SNO</th>
    <th>SETTLEMENT_NUMBER</th>
    <th>SETTLEMENT_DATE</th>
    <th>ORDER_ID</th>
    <th>MERCHANT_NAME</th>
    <th>MERCHANT_ORDER_NO</th>
    <th>TRANSACTION_ID </th>
    <th>BOOKING_DATE_AND_TIME</th>
    <th>CURRENCY</th>
    <th>TRANSACTION_AMOUNT</th>
    <th>SETTLEMENT_CURRENCY</th>
    <th>SETTLEMENT_AMOUNT</th>
    <th>COMMISSION_PAYABLE</th>
    <th>GST</th>
    <th>PAYOUT_AMOUNT</th>
    <th>GATEWAY_NAME</th>
    <th>GATEWAY_TRACE_NUMBER</th>
    <th>PAY_MODE_CODE</th>
    <th>PAY_PROC</th>
    <th>OTHER_DETAILS</th>
    <th>CIN_NUMBER</th>
    
    </tr>

    <?php
    $db = mysqli_connect('localhost','root','','Import_DRDO');
    $query="SELECT * FROM drdodata";
    $row = mysqli_query($db,$query);

    while($data = mysqli_fetch_array($row)){
        ?>
<tr>
<td><?=$data['SNO']?></td>
<td><?=$data['SETTLEMENT_NUMBER']?></td>
<td><?=$data['SETTLEMENT_DATE']?></td>
<td><?=$data['ORDER_ID']?></td>
<td><?=$data['MERCHANT_NAME']?></td>
<td><?=$data['MERCHANT_ORDER_NO']?></td>
<td><?=$data['TRANSACTION_ID']?></td>
<td><?=$data['BOOKING_DATE_AND_TIME']?></td>
<td><?=$data['CURRENCY']?></td>
<td><?=$data['TRANSACTION_AMOUNT']?></td>
<td><?=$data['SETTLEMENT_CURRENCY']?></td>
<td><?=$data['SETTLEMENT_AMOUNT']?></td>
<td><?=$data['COMMISSION_PAYABLE']?></td>
<td><?=$data['GST']?></td>
<td><?=$data['PAYOUT_AMOUNT']?></td>
<td><?=$data['GATEWAY_NAME']?></td>
<td><?=$data['GATEWAY_TRACE_NUMBER']?></td>
<td><?=$data['PAY_MODE_CODE']?></td>
<td><?=$data['PAY_PROC']?></td>
<td><?=$data['OTHER_DETAILS']?></td>
<td><?=$data['CIN_NUMBER']?></td>

</tr>
        <?php
    }
    
    ?>
    </table>
</body>