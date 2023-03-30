<?php
include('../db.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_FILES['file'])){
        // Allowed mime types
		$csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain');

        // Validate whether selected file is a CSV file
		if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $csvMimes)){

            // If the file is uploaded
			if(is_uploaded_file($_FILES['file']['tmp_name'])){

                // Open uploaded CSV file with read-only mode
				$csvFile = fopen($_FILES['file']['tmp_name'], 'r');

                // Skip the first line
				fgetcsv($csvFile);

                // Parse data from CSV file line by line
				while(($line = fgetcsv($csvFile)) !== FALSE){
					$id          = $line[0];
					$product_price          = $line[1];
					$product_image           = $line[2];
					$product_size        = $line[3];
					$product_code      = $line[4];
					$branch = $line[5];
					$brand         = $line[6];
					$status    = $line[7];
					$vat         = $line[8];
					$sd      = $line[9];
					$check = mysql_fetch_assoc(mysql_query("SELECT * FROM `product` WHERE  `branch`='".$branch."' AND `brand`='".$brand."' AND `product_size`='".$product_size."'"));
					if($check['total_product'] <= 0 ){
						$sql ="INSERT INTO `product`(`id`,`product_price`, `product_image`, `product_size`, `product_code`, `branch`, `brand`, `status`, `vat`, `sd`) VALUES ('$id','$product_price','$product_image','$product_size','$product_code','$branch','$brand','$status','0','$sd')";
						if (mysql_query($sql)) {
							$status = "File Uploaded Successfully...";
						}else{
							$status = "failed to upload ";
						}						
					}else{
						$status = "Data Already Exist";
					}					
				}
                // Close opened CSV file
                echo $status;
				fclose($csvFile);				
			}else{
				echo "Failed to Upload file";
			}
		}else{
			echo "invalid file type ";
		}
	}else{
		echo "No file selected..";
	}
}else{
	echo "Not a vailid Method";
}
?>