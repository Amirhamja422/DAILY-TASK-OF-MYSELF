<?php
$id=$_GET["idate"];
$ed=$_GET["edate"];
$st=$_GET["status"];
//$type=$_GET["type"];

//echo $st;
//echo $et;


include('../../db.php');
 
 //$query = "SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised BY', `assignd` as 'Assigned TO', `cus_contact` as 'CONTACT', `cus_name` as 'Name', `cus_ac` as 'Account ID', `cus_product` as 'Product Details', `cus_amount` as 'Disagreement Amount ', `status` as 'Last Status', `date` as 'Create Date', `priority` as 'Priority' FROM `ticket` WHERE status='$st' AND date >='$id'  AND date <='$ed'  ";
 $query = "SELECT `id` as 'ID', `ticket_type` as 'TYPE', `from` as 'Raised BY', (select user_id from users where id = `ticket`.`assignd`) as 'Assigned TO', `cus_contact` as 'CONTACT', `cus_name` as 'Name', `cus_ac` as 'Account ID', `cus_product` as 'Product Details', `cus_amount` as 'Disagreement Amount ', `status` as 'Last Status', `date` as 'Create Date', `priority` as 'Priority' FROM `ticket` WHERE status='".$st."' AND date >='".$id."'  AND date <='".$ed."'  ";
 
 
 
$header = '';
$data ='';
$export = mysql_query ($query ) or die ( "Sql error : " . mysql_error( ) );
 
$fields = mysql_num_fields ( $export );
 
for ( $i = 0; $i < $fields; $i++ )
{
    $header .= mysql_field_name( $export , $i ) . "\t";
}
 
while( $row = mysql_fetch_row( $export ) )
{
    $line = '';
    foreach( $row as $value )
    {                                            
        if ( ( !isset( $value ) ) || ( $value == "" ) )
        {
            $value = "\t";
        }
        else
        {
            $value = str_replace( '"' , '""' , $value );
            $value = '"' . $value . '"' . "\t";
        }
        $line .= $value;
    }
    $data .= trim( $line ) . "\n";
}
$data = str_replace( "\r" , "" , $data );
 
if ( $data == "" )
{
    $data = "\nNo Record(s) Found!\n";                        
}
 
header("Content-type: application/octet-stream");
header("Content-Disposition: attachment; filename=Ticketing_report_"."Ticket_Status".".xls");
header("Pragma: no-cache");
header("Expires: 0");
print "$header\n$data";
  




// --------------------------------------   Search By Status
 


?>