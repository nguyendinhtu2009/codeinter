<?php
require_once 'API/lazada/LazopSdk.php';
require_once 'API/lazada/PHPExcel.php';
require_once 'API/lazada/PHPExcel/IOFactory.php';
/**
* 
*/
class Product_Laz extends CI_Model
{

	public function Get_Product($start_date, $accessToken, $appkey, $appsecret){
		$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
		$request = new LazopRequest('/products/get','GET');
		$request->addApiParam('filter','live');
		//$request->addApiParam('search','product_name');
		//$request->addApiParam('create_before','2018-01-01T00:00:00+0800');
		//$request->addApiParam('offset','0');
		$request->addApiParam('create_after',$start_date);
		$request->addApiParam('update_after',$start_date);
		$request->addApiParam('limit','500');
		//$request->addApiParam('options','1');
		//$request->addApiParam('sku_seller_list',' [\"39817:01:01\", \"Apple 6S Black\"]');
		//var_dump($c->execute($request, $accessToken));
		$res = json_decode($c->execute($request, $accessToken), TRUE);
		$a['total'] = $res['data']['total_products'];
			for($k=0;$k<$res['data']['total_products'];$k++){
			$sku = array();
			for ($i=0;$i<count($res['data']['products'][$k]['skus']);$i++)
				{
					foreach ($res['data']['products'][$k]['skus'][$i] as $key => $value) {
						$sku[$i][$key] = $value;
					}
					unset($sku[$i]['Images']);
					unset($sku[$i]['ShopSku']);
					unset($sku[$i]['SkuId']);
					unset($sku[$i]['Status']);
					unset($sku[$i]['Url']);
					if($sku[$i]['special_price'] == 0){
						unset($sku[$i]['special_price']);
					}
					$sku[$i]['image'] = '';
					for($j=0;$j<count($res['data']['products'][$k]['skus'][$i]['Images']);$j++){
						$sku[$i]['image'] .= $res['data']['products'][$k]['skus'][$i]['Images'][$j].',';
					}
				}
			$sku = json_encode($sku);
			try{
				if(isset($res['data']['products'][$k]['attributes']['warranty_type'])){
					$warranty_type = 'No Warranty';
				}else{
					$warranty_type = $res['data']['products'][$k]['attributes']['warranty_type'];
				}

					$data = array(
						'name' => $res['data']['products'][$k]['attributes']['name'], 
						'primarycategory' => $res['data']['products'][$k]['primary_category'],
						'item_id' => $res['data']['products'][$k]['item_id'],
						'short_description' => $res['data']['products'][$k]['attributes']['short_description'],
						'description_laz' => str_replace('/><img','/><br /><img',$res['data']['products'][$k]['attributes']['description']),
						'brand' => $res['data']['products'][$k]['attributes']['brand'],
						'model' => $res['data']['products'][$k]['attributes']['model'],
						'warranty_type' => $warranty_type,
						'warranty' => $res['data']['products'][$k]['attributes']['warranty'],
						'kid_years' => $res['data']['products'][$k]['attributes']['kid_years'],
						'sellersku' => $sku,
						'package_length' => $res['data']['products'][$k]['skus'][0]['package_length'],
						'package_height' => $res['data']['products'][$k]['skus'][0]['package_height'],
						'package_weight' => $res['data']['products'][$k]['skus'][0]['package_weight'],
						'package_width' => $res['data']['products'][$k]['skus'][0]['package_width']
						);
					$this->db->insert('product_main', $data);
					$a['sql_success'][] = TRUE;
				}catch(Exception $e){
					try {
						$data = array(
						'name' => $res['data']['products'][$k]['attributes']['name'], 
						'primarycategory' => $res['data']['products'][$k]['primary_category'],
						'item_id' => $res['data']['products'][$k]['item_id'],
						'short_description' => $res['data']['products'][$k]['attributes']['short_description'],
						'description_laz' => str_replace('/><img','/><br /><img',$res['data']['products'][$k]['attributes']['description']),
						'brand' => $res['data']['products'][$k]['attributes']['brand'],
						'model' => $res['data']['products'][$k]['attributes']['model'],
						'warranty_type' => $warranty_type,
						'warranty' => $res['data']['products'][$k]['attributes']['warranty'],
						'kid_years' => $res['data']['products'][$k]['attributes']['kid_years'],
						'sellersku' => $sku,
						'package_length' => $res['data']['products'][$k]['skus'][0]['package_length'],
						'package_height' => $res['data']['products'][$k]['skus'][0]['package_height'],
						'package_weight' => $res['data']['products'][$k]['skus'][0]['package_weight'],
						'package_width' => $res['data']['products'][$k]['skus'][0]['package_width']
						);
						$a['sql_update'][] = TRUE;
					} catch (Exception $e) {
						$a['sql_fail'][] = TRUE;
					}
				}
			}
			return $a;
			}
}