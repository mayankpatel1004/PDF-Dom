<?php
include("connection.php");

$urlId = 4;
if(isset($_GET["id"]))
{
	$urlId = $_GET["id"];
}
$skuquery = "SELECT * FROM `catalog_product_entity` WHERE `entity_id` =$urlId";
$objsku = mysql_query($skuquery);
$arrSku = mysql_fetch_assoc($objsku);
$strSku = $arrSku["sku"];
?>
<div style="text-align:center;width:1000px;"><h1>View all customer order products</h1><span style="float:right;"><a href="<?php echo $relpath; ?>" target="_blank">Click to view as pdf</a></span></div>

<strong>Select Product : </strong><select name="product" id="product" onchange="fnGetUrl(this.value)">
<option value="0">Select Product</option>
<option value="4" <?php if($urlId == 4){echo "selected='selected'";}?>><?php echo fnGetProductname(4);?></option>
<option value="5" <?php if($urlId == 5){echo "selected='selected'";}?>><?php echo fnGetProductname(5);?></option>
<option value="15" <?php if($urlId == 15){echo "selected='selected'";}?>><?php echo fnGetProductname(15);?></option>
<option value="35" <?php if($urlId == 35){echo "selected='selected'";}?>><?php echo fnGetProductname(35);?></option>
<option value="59" <?php if($urlId == 59){echo "selected='selected'";}?>><?php echo fnGetProductname(59);?></option>
<option value="60" <?php if($urlId == 60){echo "selected='selected'";}?>><?php echo fnGetProductname(60);?></option>
<option value="61" <?php if($urlId == 61){echo "selected='selected'";}?>><?php echo fnGetProductname(61);?></option>
<option value="62" <?php if($urlId == 62){echo "selected='selected'";}?>><?php echo fnGetProductname(62);?></option>
<option value="63" <?php if($urlId == 63){echo "selected='selected'";}?>><?php echo fnGetProductname(63);?></option>
<option value="64" <?php if($urlId == 64){echo "selected='selected'";}?>><?php echo fnGetProductname(64);?></option>
<option value="71" <?php if($urlId == 71){echo "selected='selected'";}?>><?php echo fnGetProductname(71);?></option>
<option value="72" <?php if($urlId == 72){echo "selected='selected'";}?>><?php echo fnGetProductname(72);?></option>
<option value="73" <?php if($urlId == 73){echo "selected='selected'";}?>><?php echo fnGetProductname(73);?></option>
<option value="74" <?php if($urlId == 74){echo "selected='selected'";}?>><?php echo fnGetProductname(74);?></option>
<option value="75" <?php if($urlId == 75){echo "selected='selected'";}?>><?php echo fnGetProductname(75);?></option>
<option value="76" <?php if($urlId == 76){echo "selected='selected'";}?>><?php echo fnGetProductname(76);?></option>
<option value="77" <?php if($urlId == 77){echo "selected='selected'";}?>><?php echo fnGetProductname(77);?></option>
<option value="78" <?php if($urlId == 78){echo "selected='selected'";}?>><?php echo fnGetProductname(78);?></option>
<option value="79" <?php if($urlId == 79){echo "selected='selected'";}?>><?php echo fnGetProductname(79);?></option>
<option value="80" <?php if($urlId == 80){echo "selected='selected'";}?>><?php echo fnGetProductname(80);?></option>
<option value="81" <?php if($urlId == 81){echo "selected='selected'";}?>><?php echo fnGetProductname(81);?></option>
<option value="82" <?php if($urlId == 82){echo "selected='selected'";}?>><?php echo fnGetProductname(82);?></option>
<option value="88" <?php if($urlId == 88){echo "selected='selected'";}?>><?php echo fnGetProductname(88);?></option>
<option value="98" <?php if($urlId == 98){echo "selected='selected'";}?>><?php echo fnGetProductname(98);?></option>
<option value="99" <?php if($urlId == 99){echo "selected='selected'";}?>><?php echo fnGetProductname(99);?></option>
<option value="100" <?php if($urlId == 100){echo "selected='selected'";}?>><?php echo fnGetProductname(100);?></option>
<option value="101" <?php if($urlId == 101){echo "selected='selected'";}?>><?php echo fnGetProductname(101);?></option>
<option value="102" <?php if($urlId == 102){echo "selected='selected'";}?>><?php echo fnGetProductname(102);?></option>
<option value="103" <?php if($urlId == 103){echo "selected='selected'";}?>><?php echo fnGetProductname(103);?></option>
<option value="104" <?php if($urlId == 104){echo "selected='selected'";}?>><?php echo fnGetProductname(104);?></option>
<option value="105" <?php if($urlId == 105){echo "selected='selected'";}?>><?php echo fnGetProductname(105);?></option>
<option value="109" <?php if($urlId == 109){echo "selected='selected'";}?>><?php echo fnGetProductname(109);?></option>
<option value="110" <?php if($urlId == 110){echo "selected='selected'";}?>><?php echo fnGetProductname(110);?></option>
<option value="121" <?php if($urlId == 121){echo "selected='selected'";}?>><?php echo fnGetProductname(121);?></option>
</select>
<br /><br />
<?php
$sqlQuery = "select o.increment_id AS order_id, o.customer_id, oa.lastname, oa.email as shipping_email,o.customer_email as customer_email, oa.firstname, oi.sku,oi.name, oi.created_at,oa.telephone FROM sales_flat_order o INNER JOIN sales_flat_order_item oi ON o.entity_id = oi.order_id INNER JOIN sales_flat_order_address oa ON o.entity_id = oa.parent_id  WHERE oi.sku = '$strSku' AND oa.address_type = 'shipping' AND o.increment_id < 500000000";
$objQuery = mysql_query($sqlQuery);
$intRows = mysql_num_rows($objQuery);
if($intRows > 0)
{
	?>
	<table cellpadding="5" cellspacing="5" border="0">
    
    <tr>
        <th style="border:1px solid #CCC;"><?php echo "Order ID #";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Customer ID";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Firstname";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Lastname";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Email";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Product Name";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Product Sku";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Telephone";?></th>
        <th style="border:1px solid #CCC;"><?php echo "Ordered On";?></th>
    </tr>
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
		?>
		<tr>
        	<td style="border:1px solid #CCC;"><?php echo $arrResult["order_id"];?></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["customer_id"];?></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["firstname"];?></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["lastname"];?></td>
            <td style="border:1px solid #CCC;"><a style="color:#000;" href="mailto:<?php if($arrResult["shipping_email"] != ""){echo $arrResult["shipping_email"];}else{$arrResult["customer_email"];}?>"><?php echo $emaildisplay;?></a></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["name"];?></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["sku"];?></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["telephone"];?></td>
            <td style="border:1px solid #CCC;"><?php echo $arrResult["created_at"];?></td>
        </tr>
		<?php
	}
	?>
	</table>
	<?php
	}
else
{
	?>
	<div style="text-align:center;border:1px solid #CCC;">This product is not ordered yet</div>
	<?php
}	
	?>
    <br />
	
    
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
