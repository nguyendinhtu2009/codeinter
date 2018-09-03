<?php
require_once 'API/lazada/LazopSdk.php';
require_once 'API/lazada/PHPExcel.php';
require_once 'API/lazada/PHPExcel/IOFactory.php';
ini_set('max_execution_time', 0);
//error_reporting(0);
/**
* 
*/
class ProductLazModel extends CI_Model
{

	public function Get_Product($start_date, $accessToken, $appkey, $appsecret){
		$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
		$request = new LazopRequest('/products/get','GET');
		$request->addApiParam('filter','live');
		$request->addApiParam('create_after',$start_date);
		$request->addApiParam('update_after',$start_date);
		$request->addApiParam('limit','500');
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
					$warranty_type = $res['data']['products'][$k]['attributes']['warranty_type'];
					
				}else{
					$warranty_type = 'No Warranty';
				}
				@$warranty = $res['data']['products'][$k]['attributes']['warranty'];
				@$kid_years = $res['data']['products'][$k]['attributes']['kid_years'];
				$this->db->trans_start(FALSE);
					$data = array(
						'name' => $res['data']['products'][$k]['attributes']['name'], 
						'primarycategory' => $res['data']['products'][$k]['primary_category'],
						'item_id' => $res['data']['products'][$k]['item_id'],
						'short_description' => $res['data']['products'][$k]['attributes']['short_description'],
						'description_laz' => str_replace('/><img','/><br /><img',$res['data']['products'][$k]['attributes']['description']),
						'brand' => $res['data']['products'][$k]['attributes']['brand'],
						'model' => $res['data']['products'][$k]['attributes']['model'],
						'warranty_type' => $warranty_type,
						'warranty' => (!empty($warranty)) ? $warranty : 0,
						'kid_years' => (!empty($kid_years)) ? $kid_years : 0,
						'sellersku' => $sku,
						'package_length' => $res['data']['products'][$k]['skus'][0]['package_length'],
						'package_height' => $res['data']['products'][$k]['skus'][0]['package_height'],
						'package_weight' => $res['data']['products'][$k]['skus'][0]['package_weight'],
						'package_width' => $res['data']['products'][$k]['skus'][0]['package_width']
						);
					$this->db->insert('product', $data);
			        $this->db->trans_complete();
			        $db_error = $this->db->error();
			        if (!empty($db_error)) {
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
						$this->db->where('item_id', $res['data']['products'][$k]['item_id']);
            			$this->db->update('product', $data);
			        }
					$a['sql_success'][] = TRUE;
				}catch(Exception $e){
					#code
				}
			}
			return $a;
			}


		public function Remove_Product_Laz($sku, $accessToken, $appkey, $appsecret){
			$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
			$request = new LazopRequest('/product/remove');
			$request->addApiParam('seller_sku_list','['.$sku.']');
			return $c->execute($request, $accessToken);
		}


		public function Public_Product_Laz($seller_id, $accessToken ,$appkey, $appsecret){
			$a = array();
			$post = $this->db->query("SELECT * FROM `product` WHERE `status` = 0 AND `seller_id` NOT LIKE '%{$seller_id}%'");
			$post = $post->result();
			for($i=0;$i<count($post);$i++){

				$xml = '';
				$xml .= '<?xml version="1.0" encoding="UTF-8" ?> 
							<Request>
							     <Product>';
				$xml .= '<PrimaryCategory>'.$post[$i]->primarycategory.'</PrimaryCategory>';
				$xml .= '<SPUId>'.$post[$i]->spuid.'</SPUId>';
				$xml .= '<AssociatedSku>'.$post[$i]->associatedsku.'</AssociatedSku>';
				$xml .= '<Attributes>';
				$xml .= '<name>'.$post[$i]->name.'</name>';
				$xml .= '<short_description><![CDATA['.$post[$i]->short_description.']]></short_description>';
				$xml .= '<description><![CDATA['.$post[$i]->description_laz.']]></description>';
				$xml .= '<brand>'.$post[$i]->brand.'</brand>';
				$xml .= '<model>'.$post[$i]->model.'</model>';
				$xml .= '<warranty_type>'.$post[$i]->warranty_type.'</warranty_type>';
				$xml .= '<warranty>'.$post[$i]->warranty.'</warranty>';
				$xml .= '<kid_years>'.$post[$i]->kid_years.'</kid_years>';
				$xml .= '</Attributes>';
				$xml .= '<Skus>';
				$sku = json_decode($post[$i]->sellersku, TRUE);
				for($j=0;$j<count($sku);$j++){
				$xml .= '<Sku>';
					foreach ($sku[$j] as $key => $value) {
						$xml .= '<'.$key.'>'.$value.'</'.$key.'>';
					}
			    $xml .= '                        
			            <package_length>'.$post[$i]->package_length.'</package_length>                 
			            <package_height>'.$post[$i]->package_height.'</package_height>                
			            <package_weight>'.$post[$i]->package_weight.'</package_weight>                 
			            <package_width>'.$post[$i]->package_width.'</package_width>                 
			            <package_content>No</package_content>                
			            <Images>';
				$img = explode(',', $sku[$j]['image']);
				    for($k=0;$k<count($img);$k++){
				    	if($img[$k] != null){
				    	$xml .= '<Image>'.$img[$k].'</Image>';
				    	}
				    }

			    $xml .= '</Images></Sku>';
			    } 
				$xml .= '</Skus>';
				$xml .= '</Product>';
				$xml .= '</Request>';
				if($post[$i]->primarycategory != null){
					$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
					$request = new LazopRequest('/product/create');
					$request->addApiParam('payload',$xml);
					$res_a = $c->execute($request, $accessToken);
					$res = json_decode($res_a, TRUE);
					if($res['code'] == 0){
						$data = array('seller_id' => $post[$i]->seller_id.','.$seller_id);
						$this->db->where('item_id', $post[$i]->item_id);
            			$this->db->update('product', $data);
						$a['success'][] = true;
						$file = 'log.txt';
						$current = file_get_contents($file);
						$current .= "\n".hatime."|".$post[$i]->item_id."|".$seller_id."|DONE";
						file_put_contents($file, $current);
					}else{
						if($res['detail'][0]['field'] == 'SellerSku'){
						$data = array('seller_id' => $post[$i]->seller_id.','.$seller_id);
						$this->db->where('item_id', $post[$i]->item_id);
            			$this->db->update('product', $data);
						}else{
						$data = array('status' => 2);
						$this->db->where('item_id', $post[$i]->item_id);
            			$this->db->update('product', $data);
						$file = 'log.txt';
						$current = file_get_contents($file);
						$current .= "\n".hatime."|".$post[$i]->item_id."|".$seller_id."|".$res_a;
						file_put_contents($file, $current);
						$a['fail'][] = true;
					}
					}
				}
					
			}
			return $a;
		}


		public function Update_Product_Laz($seller_id, $accessToken ,$appkey, $appsecret){
			$a = array();
			$post = $this->db->query("SELECT * FROM `product` WHERE `status` = 0 AND `update_sellerid` NOT LIKE '%{$seller_id}%'");
			$post = $post->result();
			for($i=0;$i<count($post);$i++){

				$xml = '';
				$xml .= '<?xml version="1.0" encoding="UTF-8" ?> 
							<Request>
							     <Product>';
				$xml .= '<PrimaryCategory>'.$post[$i]->primarycategory.'</PrimaryCategory>';
				$xml .= '<SPUId>'.$post[$i]->spuid.'</SPUId>';
				$xml .= '<AssociatedSku>'.$post[$i]->associatedsku.'</AssociatedSku>';
				$xml .= '<Attributes>';
				$xml .= '<name>'.$post[$i]->name.'</name>';
				$xml .= '<short_description><![CDATA['.$post[$i]->short_description.']]></short_description>';
				$xml .= '<description><![CDATA['.$post[$i]->description_laz.']]></description>';
				$xml .= '<brand>'.$post[$i]->brand.'</brand>';
				$xml .= '<model>'.$post[$i]->model.'</model>';
				$xml .= '<warranty_type>'.$post[$i]->warranty_type.'</warranty_type>';
				$xml .= '<warranty>'.$post[$i]->warranty.'</warranty>';
				$xml .= '<kid_years>'.$post[$i]->kid_years.'</kid_years>';
				$xml .= '</Attributes>';
				$xml .= '<Skus>';
				$sku = json_decode($post[$i]->sellersku, TRUE);
				for($j=0;$j<count($sku);$j++){
				$xml .= '<Sku>';
					foreach ($sku[$j] as $key => $value) {
						$xml .= '<'.$key.'>'.$value.'</'.$key.'>';
					}
			    $xml .= '                        
			            <package_length>'.$post[$i]->package_length.'</package_length>                 
			            <package_height>'.$post[$i]->package_height.'</package_height>                
			            <package_weight>'.$post[$i]->package_weight.'</package_weight>                 
			            <package_width>'.$post[$i]->package_width.'</package_width>                 
			            <package_content>No</package_content>                
			            <Images>';
				$img = explode(',', $sku[$j]['image']);
				    for($k=0;$k<count($img);$k++){
				    	if($img[$k] != null){
				    	$xml .= '<Image>'.$img[$k].'</Image>';
				    	}
				    }

			    $xml .= '</Images></Sku>';
			    } 
				$xml .= '</Skus>';
				$xml .= '</Product>';
				$xml .= '</Request>';
				if($post[$i]->primarycategory != null){
					$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
					$request = new LazopRequest('/product/update');
					$request->addApiParam('payload',$xml);
					$res_a = $c->execute($request, $accessToken);
					$res = json_decode($res_a, TRUE);
					if($res['code'] == 0){
						$data = array('update_sellerid' => $post[$i]->seller_id.','.$seller_id);
						$this->db->where('item_id', $post[$i]->item_id);
            			$this->db->update('product', $data);
						$a['success'][] = true;
						$file = 'update_log.txt';
						$current = file_get_contents($file);
						$current .= "\n".hatime."|".$post[$i]->item_id."|".$seller_id."|DONE";
						file_put_contents($file, $current);
					}else{
						if($res['detail'][0]['field'] == 'SellerSku'){
						$data = array('update_sellerid' => $post[$i]->seller_id.','.$seller_id);
						$this->db->where('item_id', $post[$i]->item_id);
            			$this->db->update('product', $data);
						}else{
						$data = array('need_update' => 2);
						$this->db->where('item_id', $post[$i]->item_id);
            			$this->db->update('product', $data);
						$file = 'update_log.txt';
						$current = file_get_contents($file);
						$current .= "\n".hatime."|".$post[$i]->item_id."|".$seller_id."|".$res_a;
						file_put_contents($file, $current);
						$a['fail'][] = true;
					}
					}
				}
					
			}
			return $a;
		}





}