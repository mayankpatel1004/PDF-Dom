<?php
include("connection.php");
?>
<div style="text-align:center;width:1000px;"><h1>View all customer order products</h1><span style="float:right;"><a href="<?php echo $relpath; ?>" target="_blank">Click to view as pdf</a></span></div>


<script type="text/javascript">
function fnGetUrl(id)
{
	window.location = '<?php echo $exportUrl.'/?id=';?>'+id;
}
</script>

<?php
/*require('pdf/html2fpdf.php');
require('pdf/html2fpdf_site.php');	
	
$filename='orderproduct.pdf';
$pdf = new PDF();
$pdf->AddPage('P');
$pdf->SetDisplayMode("real",'default'); 
$pdf->SetFont('Arial','',11);
$pdf->PutTitle('Sugargliderinfo');
$pdf->PutAuthor('Sugargliderinfo');


$content = '<b>mayankpatel</b>';
$html = str_replace("&amp;", "&", $content);
$pdf->WriteHTML($html);
$filepath = JPATH_SITE.'/'.$filename;
$pdf->Output('pdf_generated/'.$filename,'I');	///
exit;*/
?>
<?php
require_once("dompdf/dompdf_config.inc.php");
spl_autoload_register('DOMPDF_autoload');
	
function fnGetProductname($intProductid)
{
	$sqlNameQuery = "SELECT * FROM `catalog_product_entity_varchar` WHERE `attribute_id` = 65 AND `entity_id` = $intProductid";
	$ojbQry = mysql_query($sqlNameQuery);
	$intRows = mysql_num_rows($ojbQry);
	if($intRows > 0)
	{
		$arrName = mysql_fetch_assoc($ojbQry);
		return $strName = $arrName["value"];
	}
}

$urlId = 4;
if(isset($_GET["id"]))
{
	$urlId = $_GET["id"];
}
$skuquery = "SELECT * FROM `catalog_product_entity` WHERE `entity_id` =$urlId";
$objsku = mysql_query($skuquery);
$arrSku = mysql_fetch_assoc($objsku);
$strSku = $arrSku["sku"];
	$html = "";
		$sqlQuery = "select o.increment_id AS order_id, o.customer_id, oa.lastname, oa.email as shipping_email,o.customer_email as customer_email, oa.firstname, oi.sku,oi.name, oi.created_at,oa.telephone FROM sales_flat_order o INNER JOIN sales_flat_order_item oi ON o.entity_id = oi.order_id INNER JOIN sales_flat_order_address oa ON o.entity_id = oa.parent_id  WHERE oi.sku = '$strSku' AND oa.address_type = 'shipping' AND o.increment_id < 500000000";
$objQuery = mysql_query($sqlQuery);
$intRows = mysql_num_rows($objQuery);
		if($intRows > 0)
		{
			$html = "";
			$html .= '<table cellpadding="5" cellspacing="5" border="1">
			<tr>
				
				<th style="border:1px solid #CCC;">Order ID #</th>
				<th style="border:1px solid #CCC;">Customer ID</th>
				<th style="border:1px solid #CCC;">Firstname</th>
				<th style="border:1px solid #CCC;">Lastname</th>
				<th style="border:1px solid #CCC;">Email</th>
				<th style="border:1px solid #CCC;">Product Name</th>
				<th style="border:1px solid #CCC;">Product Sku</th>
				<th style="border:1px solid #CCC;">Telephone</th>
				<th style="border:1px solid #CCC;">Ordered On</th>
			</tr>';
			?>
			
			
			<?php
			while($arrResult = mysql_fetch_assoc($objQuery))
			{
				
				if($arrResult["shipping_email"] != "")
				{
					$emaildisplay = $arrResult["shipping_email"];
				}
				else
				{
					$emaildisplay = $arrResult["customer_email"];
				}
				//$emaildisplay = str_replace("."," ",$emaildisplay);
				//$emaildisplay = str_replace("@"," ",$emaildisplay);
				$html.= '
				<tr>
					
					<td>'.$arrResult["order_id"].'</td>
					<td>'.$arrResult["customer_id"].'</td>
					<td>'.$arrResult["firstname"].'</td>
					<td>'.$arrResult["lastname"].'</td>
					<td>'.$emaildisplay.'</td>
					<td>'.$arrResult["name"].'</td>
					<td>'.$arrResult["sku"].'</td>
					<td>'.$arrResult["telephone"].'</td>
					<td>'.$arrResult["created_at"].'</td>
				</tr>';
			}
			$html .= "</table>";
			}
		else
		{
			$html.='<div style="text-align:center;border:1px solid #CCC;">This product is not ordered yet</div>';
		}
	
	//echo $html;exit;
	$dompdf = new DOMPDF();
	$dompdf->set_paper("A4", "landscape");            
	$dompdf->load_html($html);
	$dompdf->render();
	$pdf = $dompdf->output();
	
	file_put_contents($fileName, $pdf);
?>
