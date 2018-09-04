<?php
require_once 'API/lazada/LazopSdk.php';
require_once 'API/lazada/PHPExcel.php';
require_once 'API/lazada/PHPExcel/IOFactory.php';
error_reporting(0);
/**
* 
*/
class ProductShopeeCreatModel extends CI_Model
{
	public function __contruct(){
		parent::__construct();
	}


	public function Shopee_To_Excel_Creat(){
		$objPHPExcel = new PHPExcel();
		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'ps_category_list_id');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'ps_product_name');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'ps_product_description');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ps_price');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'ps_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'ps_product_weight');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ps_days_to_ship');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ps_sku_ref_no_parent');
		$objPHPExcel->getActiveSheet()->setCellValue('I1', 'ps_mass_upload_variation_help');
		$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ps_variation 1 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ps_variation 1 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ps_variation 1 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ps_variation 1 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('N1', 'ps_variation 2 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('O1', 'ps_variation 2 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('P1', 'ps_variation 2 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ps_variation 2 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('R1', 'ps_variation 3 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('S1', 'ps_variation 3 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('T1', 'ps_variation 3 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('U1', 'ps_variation 3 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('V1', 'ps_variation 4 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('W1', 'ps_variation 4 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('X1', 'ps_variation 4 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'ps_variation 4 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('Z1', 'ps_variation 5 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AA1', 'ps_variation 5 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AB1', 'ps_variation 5 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AC1', 'ps_variation 5 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AD1', 'ps_variation 6 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AE1', 'ps_variation 6 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AF1', 'ps_variation 6 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AG1', 'ps_variation 6 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AH1', 'ps_variation 7 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AI1', 'ps_variation 7 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AJ1', 'ps_variation 7 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AK1', 'ps_variation 7 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AL1', 'ps_variation 8 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AM1', 'ps_variation 8 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AN1', 'ps_variation 8 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AO1', 'ps_variation 8 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AP1', 'ps_variation 9 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AQ1', 'ps_variation 9 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AR1', 'ps_variation 9 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AS1', 'ps_variation 9 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AT1', 'ps_variation 10 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AU1', 'ps_variation 10 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AV1', 'ps_variation 10 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('AW1', 'ps_variation 10 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('AX1', 'ps_variation 11 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('AY1', 'ps_variation 11 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('AZ1', 'ps_variation 11 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BA1', 'ps_variation 11 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BB1', 'ps_variation 12 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BC1', 'ps_variation 12 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BD1', 'ps_variation 12 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BE1', 'ps_variation 12 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BF1', 'ps_variation 13 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BG1', 'ps_variation 13 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BH1', 'ps_variation 13 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BI1', 'ps_variation 13 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BJ1', 'ps_variation 14 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BK1', 'ps_variation 14 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BL1', 'ps_variation 14 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BM1', 'ps_variation 14 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BN1', 'ps_variation 15 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BO1', 'ps_variation 15 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BP1', 'ps_variation 15 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BQ1', 'ps_variation 15 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BR1', 'ps_variation 16 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BS1', 'ps_variation 16 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BT1', 'ps_variation 16 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BU1', 'ps_variation 16 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BV1', 'ps_variation 17 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('BW1', 'ps_variation 17 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('BX1', 'ps_variation 17 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('BY1', 'ps_variation 17 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('BZ1', 'ps_variation 18 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('CA1', 'ps_variation 18 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('CB1', 'ps_variation 18 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('CC1', 'ps_variation 18 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('CD1', 'ps_variation 19 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('CE1', 'ps_variation 19 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('CF1', 'ps_variation 19 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('CG1', 'ps_variation 19 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('CH1', 'ps_variation 20 ps_variation_sku');
		$objPHPExcel->getActiveSheet()->setCellValue('CI1', 'ps_variation 20 ps_variation_name');
		$objPHPExcel->getActiveSheet()->setCellValue('CJ1', 'ps_variation 20 ps_variation_price');
		$objPHPExcel->getActiveSheet()->setCellValue('CK1', 'ps_variation 20 ps_variation_stock');
		$objPHPExcel->getActiveSheet()->setCellValue('CL1', 'ps_img_1');
		$objPHPExcel->getActiveSheet()->setCellValue('CM1', 'ps_img_2');
		$objPHPExcel->getActiveSheet()->setCellValue('CN1', 'ps_img_3');
		$objPHPExcel->getActiveSheet()->setCellValue('CO1', 'ps_img_4');
		$objPHPExcel->getActiveSheet()->setCellValue('CP1', 'ps_img_5');
		$objPHPExcel->getActiveSheet()->setCellValue('CQ1', 'ps_img_6');
		$objPHPExcel->getActiveSheet()->setCellValue('CR1', 'ps_img_7');
		$objPHPExcel->getActiveSheet()->setCellValue('CS1', 'ps_img_8');
		$objPHPExcel->getActiveSheet()->setCellValue('CT1', 'ps_img_9');
		$objPHPExcel->getActiveSheet()->setCellValue('CU1', 'ps_mass_upload_shipment_help');
		$objPHPExcel->getActiveSheet()->setCellValue('CV1', 'channel 50010 switch');
		$objPHPExcel->getActiveSheet()->setCellValue('CW1', 'channel 50011 switch');
		$objPHPExcel->getActiveSheet()->setCellValue('CX1', 'channel 50012 switch');
		$objPHPExcel->getActiveSheet()->setCellValue('CY1', 'channel 500166 switch');

		$row = 2;
		$this->load->database();
		$data = $this->db->get('product');
		$data = $data->result();
	for($i=0;$i<count($data);$i++){
				$cot = $row++;
				$sku = json_decode($data[$i]->sellersku, TRUE);
				$objPHPExcel->getActiveSheet()->setCellValue('A'.$cot, $data[$i]->shopee_category);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$cot, $data[$i]->name);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$cot, strip_tags(html_entity_decode($data[$i]->short_description)));
			if(count($sku) == 1){
				$weight = $sku[0]['package_weight'] * 1000;
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$cot, $sku[0]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$cot, $sku[0]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$cot, $weight);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$cot, 2);
				$objPHPExcel->getActiveSheet()->setCellValue('H'.$cot, $sku[0]['SellerSku']);
			}
				$objPHPExcel->getActiveSheet()->setCellValue('I'.$cot, '');
			if(count($sku) > 1){
				$objPHPExcel->getActiveSheet()->setCellValue('J'.$cot, $sku[0]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('K'.$cot, $sku[0]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('L'.$cot, $sku[0]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('M'.$cot, $sku[0]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('N'.$cot, $sku[1]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('O'.$cot, $sku[1]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('P'.$cot, $sku[1]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('Q'.$cot, $sku[1]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('R'.$cot, $sku[2]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('S'.$cot, $sku[2]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('T'.$cot, $sku[2]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('U'.$cot, $sku[2]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('V'.$cot, $sku[3]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('W'.$cot, $sku[3]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('X'.$cot, $sku[3]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('Y'.$cot, $sku[3]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('Z'.$cot, $sku[4]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AA'.$cot, $sku[4]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AB'.$cot, $sku[4]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AC'.$cot, $sku[4]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AD'.$cot, $sku[5]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AE'.$cot, $sku[5]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AF'.$cot, $sku[5]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AG'.$cot, $sku[5]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AH'.$cot, $sku[6]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AI'.$cot, $sku[6]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AJ'.$cot, $sku[6]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AK'.$cot, $sku[6]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AL'.$cot, $sku[7]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AM'.$cot, $sku[7]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AN'.$cot, $sku[7]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AO'.$cot, $sku[7]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AP'.$cot, $sku[8]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AQ'.$cot, $sku[8]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AR'.$cot, $sku[8]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AS'.$cot, $sku[8]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AT'.$cot, $sku[9]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AU'.$cot, $sku[9]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AV'.$cot, $sku[9]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('AW'.$cot, $sku[9]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('AX'.$cot, $sku[10]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AY'.$cot, $sku[10]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('AZ'.$cot, $sku[10]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BA'.$cot, $sku[10]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BB'.$cot, $sku[11]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BC'.$cot, $sku[11]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BD'.$cot, $sku[11]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BE'.$cot, $sku[11]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BF'.$cot, $sku[12]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BG'.$cot, $sku[12]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BH'.$cot, $sku[12]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BI'.$cot, $sku[12]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BJ'.$cot, $sku[13]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BK'.$cot, $sku[13]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BL'.$cot, $sku[13]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BM'.$cot, $sku[13]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BN'.$cot, $sku[14]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BO'.$cot, $sku[14]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BP'.$cot, $sku[14]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BQ'.$cot, $sku[14]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BR'.$cot, $sku[15]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BS'.$cot, $sku[15]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BT'.$cot, $sku[15]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BU'.$cot, $sku[15]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BV'.$cot, $sku[16]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BW'.$cot, $sku[16]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('BX'.$cot, $sku[16]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('BY'.$cot, $sku[16]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('BZ'.$cot, $sku[17]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CA'.$cot, $sku[17]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CB'.$cot, $sku[17]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('CC'.$cot, $sku[17]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('CD'.$cot, $sku[18]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CE'.$cot, $sku[18]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CF'.$cot, $sku[18]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('CG'.$cot, $sku[18]['Available']);
				$objPHPExcel->getActiveSheet()->setCellValue('CH'.$cot, $sku[19]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CI'.$cot, $sku[19]['SellerSku']);
				$objPHPExcel->getActiveSheet()->setCellValue('CJ'.$cot, $sku[19]['price']);
				$objPHPExcel->getActiveSheet()->setCellValue('CK'.$cot, $sku[19]['Available']);
			}
				$img = explode(',', $sku[0]['image']);
				$objPHPExcel->getActiveSheet()->setCellValue('CL'.$cot, $img[0]);
				$objPHPExcel->getActiveSheet()->setCellValue('CM'.$cot, $img[1]);
				$objPHPExcel->getActiveSheet()->setCellValue('CN'.$cot, $img[2]);
				$objPHPExcel->getActiveSheet()->setCellValue('CO'.$cot, $img[3]);
				$objPHPExcel->getActiveSheet()->setCellValue('CP'.$cot, $img[4]);
				$objPHPExcel->getActiveSheet()->setCellValue('CQ'.$cot, $img[5]);
				$objPHPExcel->getActiveSheet()->setCellValue('CR'.$cot, $img[6]);
				$objPHPExcel->getActiveSheet()->setCellValue('CS'.$cot, $img[7]);
				$objPHPExcel->getActiveSheet()->setCellValue('CT'.$cot, $img[8]);
				$objPHPExcel->getActiveSheet()->setCellValue('CU'.$cot, '');
				$objPHPExcel->getActiveSheet()->setCellValue('CV'.$cot, 'Mở');
				$objPHPExcel->getActiveSheet()->setCellValue('CW'.$cot, 'Mở');
				$objPHPExcel->getActiveSheet()->setCellValue('CX'.$cot, 'Mở');
				$objPHPExcel->getActiveSheet()->setCellValue('CY'.$cot, '');
	}

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();
		// Add some data to the second sheet, resembling some different data types
		//$objPHPExcel->setActiveSheetIndex(1);
		//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'loading');
		// Rename 2nd sheet
		//$objPHPExcel->getActiveSheet()->setTitle('Sheet2');
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Product.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	return $objWriter;
	}

	public function Shopee_Import_Product($file, $seller_id){
		$path = $file;
			   $object = PHPExcel_IOFactory::load($path);
				   foreach($object->getWorksheetIterator() as $worksheet)
				   {
					    $highestRow = $worksheet->getHighestRow();
					    $highestColumn = $worksheet->getHighestColumn();
					    for($row=4; $row<=$highestRow; $row++)
						    {
						     $tab_1 = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
						     $tab_2 = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
						     $tab_3 = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
						     $tab_4 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
						     $tab_5 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
						     $tab_6 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
						     $data = array(
						      'id_shopee'  => $tab_1,
						      'sku'   => $tab_2,
						      'name'  => $tab_3,
						      'category_id' => $tab_4,
						      'source'    => $seller_id
						     );
						     $this->db->trans_start(FALSE);
							 $this->db->insert('product_shopee', $data);
							 $this->db->trans_complete();
						     $db_error = $this->db->error();
						        if (!empty($db_error)) {
						        	$this->db->where('id_shopee', $tab_1);
            						$this->db->update('product_shopee', $data);
						        }
						    }
				   }

			   return FALSE;
	}

	public function Shopee_Update_Product($seller_id){
		$objPHPExcel = new PHPExcel();
		// Create a first sheet, representing sales data
		$objPHPExcel->setActiveSheetIndex(0);
		$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Số ID sản phẩm');
		$objPHPExcel->getActiveSheet()->setCellValue('B1', 'Mã SKU gốc');
		$objPHPExcel->getActiveSheet()->setCellValue('C1', 'Tên sản phẩm');
		$objPHPExcel->getActiveSheet()->setCellValue('D1', 'Mã ID ngành hàng');
		$objPHPExcel->getActiveSheet()->setCellValue('E1', 'Trọng Lượng');
		$objPHPExcel->getActiveSheet()->setCellValue('F1', 'Giá');
		$objPHPExcel->getActiveSheet()->setCellValue('G1', 'Số lượng');
		$objPHPExcel->getActiveSheet()->setCellValue('H1', 'Giao hàng');
		$row = 3;
		$this->load->database();
		$this->db->where('source', $seller_id);
		$data = $this->db->get('product_shopee');
		$data = $data->result();
	for($i=0;$i<count($data);$i++){
				$cot = $row++;

				$objPHPExcel->getActiveSheet()->setCellValue('A'.$cot, $data[$i]->id_shopee);
				$objPHPExcel->getActiveSheet()->setCellValue('B'.$cot, $data[$i]->sku);
				$objPHPExcel->getActiveSheet()->setCellValue('C'.$cot, $data[$i]->name);
				$objPHPExcel->getActiveSheet()->setCellValue('D'.$cot, $data[$i]->category_id);

				
				$objPHPExcel->getActiveSheet()->setCellValue('E'.$cot, 0);
				$objPHPExcel->getActiveSheet()->setCellValue('F'.$cot, 0);
				$objPHPExcel->getActiveSheet()->setCellValue('G'.$cot, 2);
	}

		// Rename sheet
		$objPHPExcel->getActiveSheet()->setTitle('Sheet1');
		// Create a new worksheet, after the default sheet
		$objPHPExcel->createSheet();
		// Add some data to the second sheet, resembling some different data types
		//$objPHPExcel->setActiveSheetIndex(1);
		//$objPHPExcel->getActiveSheet()->setCellValue('A1', 'loading');
		// Rename 2nd sheet
		//$objPHPExcel->getActiveSheet()->setTitle('Sheet2');
		// Redirect output to a client’s web browser (Excel5)
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="ProductShopeeUpdate.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
	return $objWriter;
	}
	
}