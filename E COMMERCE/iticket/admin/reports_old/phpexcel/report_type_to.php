<?php
/*Get Data*/
$id  = $_GET['idate'];  // Date Initial
$ed  = $_GET['edate'];  // Date End
$branch=$_GET["branch"];


?>

<?php
error_reporting(E_ALL);
ini_set('include_path', ini_get('include_path').';../Classes/');
include 'PHPExcel.php';
include 'PHPExcel/Writer/Excel2007.php';



/****************************************************************
* Author:     Saurav Debnath Dipu               *
* E-Mail:     s.debnath@live.com                *
* Reviewed By:  Saurav Debnath                  *
* File:     excellibrary.php                *
* Purpose:    Generating Excel (.xls) file from MySQL table.  *
*****************************************************************/



/****** Configuration  *******/

$DB_Server = "localhost";           //your MySQL Server 
$DB_Username = "root";          //your MySQL User Name 
$DB_Password = "iHelpBD@2017";          //your MySQL Password 
$DB_DBName = "ticket";              //your MySQL Database Name 
//$sql = 'select * from crm limit 1,200';     //Your MySQL Query
$filename="iTicket_Report_I_HELP_BD".date("Y-m-d");             //File Name to be Exported
$topgap=2;                    //Line Gap in Excel File Top (Must Greater than 1)
$color='F28A8C';
$color2='FFFFFF';


$sql = "SELECT `id` as 'ID', `branch_name` as 'TYPES', `agent` as 'Raised', (select user_id from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name', `branch_name` as 'branch_name', `date` as 'Create Date', `details` as 'Details',(SELECT details FROM `history` where id = `ticket`.`id` ORDER BY `history`.`date` DESC limit 1) as 'Last Detail',(SELECT date FROM `history` where id = `ticket`.`id` ORDER BY `history`.`date` DESC limit 1) as 'Last Detail Date' FROM `ticket` WHERE  branch_name='".$branch."' AND date >='".$id." 00:00:00'  AND date <='".$ed." 23:59:59'";

//  if($branch == 'all'){
//  $sql = "SELECT `id` as 'ID', `branch_name` as 'TYPES', `agent` as 'Raised', (select user_id from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name', `branch_name` as 'branch_name', `date` as 'Create Date', `details` as 'Details',(SELECT details FROM `history` where id = `ticket`.`id` ORDER BY `history`.`date` DESC limit 1) as 'Last Detail',(SELECT date FROM `history` where id = `ticket`.`id` ORDER BY `history`.`date` DESC limit 1) as 'Last Detail Date' FROM `ticket` WHERE branch_name='".$branch."' AND date >='".$id." 00:00:00'  AND date <='".$ed." 23:59:59'";
// }else{
//    $sql = "SELECT `id` as 'ID', `branch_name` as 'TYPES', `agent` as 'Raised', (select user_id from users where id = `ticket`.`assignd`) as 'Assigned', `cus_contact` as 'Phone', `cus_name` as 'Name', `branch_name` as 'branch_name', `date` as 'Create Date', `details` as 'Details',(SELECT details FROM `history` where id = `ticket`.`id` ORDER BY `history`.`date` DESC limit 1) as 'Last Detail',(SELECT date FROM `history` where id = `ticket`.`id` ORDER BY `history`.`date` DESC limit 1) as 'Last Detail Date' FROM `ticket` WHERE  date >='".$id." 00:00:00'  AND date <='".$ed." 23:59:59'";
//  }
$styleArray = array(
      'font' => array(
      'bold'  => true,
        'name' => 'Calibri Light',
        'size' => '12',
      ),
      'borders' => array(
        'left' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'right' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    'top' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'bottom' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
          'rgb' => $color,
        ),
      ),
    );

$styleArray2 = array(
      'font' => array(
        'name' => 'Verdana',
        'size' => '9',
      ),
      'borders' => array(
        'left' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'right' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
    'top' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ),
        'bottom' => array(
          'style' => PHPExcel_Style_Border::BORDER_THIN,
        ), 
      ),
      'fill' => array(
        'type' => PHPExcel_Style_Fill::FILL_SOLID,
        'startcolor' => array(
          'rgb' => $color2,
        ),
      ),
    );

$objPHPExcel = new PHPExcel();

$objPHPExcel->getProperties()->setCreator("Saurav Debnath");
$objPHPExcel->getProperties()->setLastModifiedBy("iDialer");
$objPHPExcel->getProperties()->setTitle("iDialer Call Report");
$objPHPExcel->getProperties()->setSubject("iDialer Report");
$objPHPExcel->getProperties()->setDescription("Generated using Saurav Debnath's Library.");


$objPHPExcel->setActiveSheetIndex(0);


$Connect = @mysql_connect($DB_Server, $DB_Username, $DB_Password);
$Db = @mysql_select_db($DB_DBName, $Connect);
mysql_query("SET CHARACTER SET utf8");
mysql_query("SET SESSION collation_connection =utf8_general_ci"); 
$result = @mysql_query($sql,$Connect);


$gap = $topgap;
for($col=0;$col<mysql_num_fields($result);$col++)  
  {
  $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $gap-1, mysql_field_name($result,$col));     
  $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow ($col, $gap-1)->applyFromArray($styleArray);
  }
while($data_array = mysql_fetch_row($result))
  {
    for($col=0;$col<mysql_num_fields($result);$col++)
        {
      $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow($col, $gap, strip_tags($data_array[$col]));
      $objPHPExcel->getActiveSheet()->getStyleByColumnAndRow ($col, $gap)->applyFromArray($styleArray2);
      }


  $gap++;
  }


foreach(range('A', $objPHPExcel->getActiveSheet()->getHighestDataColumn()) as $col) 
    {
        $objPHPExcel->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
    }
  
  


 



$objPHPExcel->getActiveSheet()->setTitle('CurrentSheet');
header('Content-type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="'.$filename.'.xls"');
$objWriter = new PHPExcel_Writer_Excel5($objPHPExcel);
ob_clean();
$objWriter->save('php://output');

?>