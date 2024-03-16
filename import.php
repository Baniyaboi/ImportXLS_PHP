<?php

if(isset($_POST['import'])){

    if ($_FILES['excel_file']['error'] == UPLOAD_ERR_OK && $_FILES['excel_file']['size'] > 0) {
        require 'vendor/autoload.php'; // Assuming you've installed PhpSpreadsheet via Composer

        $file = $_FILES['excel_file']['tmp_name'];

        $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
        $sheetData = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);

    $db = mysqli_connect('localhost', 'root', '', 'Import_DRDO');

    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }

    foreach ($sheetData as $row => $rowData) {
        if ($row > 1) {
            $SETTLEMENT_NUMBER = mysqli_real_escape_string($db, $rowData['A']);
            $SETTLEMENT_DATE = mysqli_real_escape_string($db, $rowData['B']);
            $ORDER_ID = mysqli_real_escape_string($db, $rowData['C']);
            $MERCHANT_NAME = mysqli_real_escape_string($db, $rowData['D']);
            $MERCHANT_ORDER_NO = mysqli_real_escape_string($db, $rowData['E']);
            $TRANSACTION_ID = mysqli_real_escape_string($db, $rowData['F']);
            $BOOKING_DATE_AND_TIME = mysqli_real_escape_string($db, $rowData['G']);
            $CURRENCY = mysqli_real_escape_string($db, $rowData['H']);
            $TRANSACTION_AMOUNT = mysqli_real_escape_string($db, $rowData['I']);
            $SETTLEMENT_CURRENCY = mysqli_real_escape_string($db, $rowData['J']);
            $SETTLEMENT_AMOUNT = mysqli_real_escape_string($db, $rowData['K']);
            $COMMISSION_PAYABLE = mysqli_real_escape_string($db, $rowData['L']);
            $GST = mysqli_real_escape_string($db, $rowData['M']);
            $PAYOUT_AMOUNT = mysqli_real_escape_string($db, $rowData['N']);
            $GATEWAY_NAME = mysqli_real_escape_string($db, $rowData['O']);
            $GATEWAY_TRACE_NUMBER = mysqli_real_escape_string($db, $rowData['P']);
            $PAY_MODE_CODE = mysqli_real_escape_string($db, $rowData['Q']);
            $PAY_PROC = mysqli_real_escape_string($db, $rowData['R']);
            $OTHER_DETAILS = mysqli_real_escape_string($db, $rowData['S']);
            $CIN_NUMBER = mysqli_real_escape_string($db, $rowData['T']);


            $query = "INSERT INTO drdodata (`SETTLEMENT_NUMBER`, `SETTLEMENT_DATE`, `ORDER_ID`, `MERCHANT_NAME`, `MERCHANT_ORDER_NO`,
            `TRANSACTION_ID`, `BOOKING_DATE_AND_TIME`, `CURRENCY`, `TRANSACTION_AMOUNT`, `SETTLEMENT_CURRENCY`,
            `SETTLEMENT_AMOUNT`, `COMMISSION_PAYABLE`, `GST`, `PAYOUT_AMOUNT`, `GATEWAY_NAME`,
            `GATEWAY_TRACE_NUMBER`, `PAY_MODE_CODE`, `PAY_PROC`, `OTHER_DETAILS`, `CIN_NUMBER`) ";
            $query .= "VALUES ('$SETTLEMENT_NUMBER', '$SETTLEMENT_DATE', '$ORDER_ID',
             '$MERCHANT_NAME', '$MERCHANT_ORDER_NO', '$TRANSACTION_ID', '$BOOKING_DATE_AND_TIME', '$CURRENCY', 
             '$TRANSACTION_AMOUNT', '$SETTLEMENT_CURRENCY', '$SETTLEMENT_AMOUNT', '$COMMISSION_PAYABLE', '$GST', 
             '$PAYOUT_AMOUNT', '$GATEWAY_NAME', '$GATEWAY_TRACE_NUMBER', '$PAY_MODE_CODE', '$PAY_PROC', '$OTHER_DETAILS', '$CIN_NUMBER')";

            

            if (!mysqli_query($db, $query)) {
                echo "Error: " . $query . "<br>" . mysqli_error($db);
            }
        }
    }

    mysqli_close($db);

    echo "<script>window.location.href='index.php';</script>";
               
}else {
    echo "File upload failed.";
}
    
}
?>