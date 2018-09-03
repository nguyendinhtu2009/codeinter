<?php
	/**
	* 
	*/
require_once 'API/lazada/LazopSdk.php';
require_once 'API/lazada/PHPExcel.php';
require_once 'API/lazada/PHPExcel/IOFactory.php';

	class OrderDetailModel extends CI_Model
	{
		
		public function getOrder_Laz()
		{
			$this->load->database();
			$data = $this->db->get('orderid');
			return $data->result();
		}

		public function cancel_order_Laz($accessToken, $appkey, $appsecret, $ItemID){
			$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
			$request = new LazopRequest('/order/cancel');
			$request->addApiParam('reason_detail','Out of stock');
			$request->addApiParam('reason_id','15');
			$request->addApiParam('order_item_id', $order_id);
			return $c->execute($request, $accessToken);
		}

		public function ReallyToShip_Laz($accessToken, $appkey, $appsecret, $ItemID){
			$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
			$request = new LazopRequest('/order/rts');
			$request->addApiParam('delivery_type','dropship');
			$request->addApiParam('order_item_ids','['.$ItemID.']');
			return $c->execute($request, $accessToken);
		}

		public function Get_Document_Laz($accessToken, $appkey, $appsecret, $ItemID){
			$c = new LazopClient('https://api.lazada.vn/rest',$appkey,$appsecret);
			$request = new LazopRequest('/order/document/get','GET');
			$request->addApiParam('doc_type','shippingLabel');
			$request->addApiParam('order_item_ids','['.$ItemID.']');
			//return $c->execute($request, $accessToken);
			$res = json_decode($c->execute($request, $accessToken), TRUE);
			return base64_decode($res['data']['document']['file']);
		}

		public function Get_Live_Order_Laz($accessToken, $status, $seller_id, $appkey, $appsecret){
			$array = array();
			$c = new LazopClient('https://api.lazada.vn/rest', $appkey, $appsecret);
			$request = new LazopRequest('/orders/get','GET');
			$request->addApiParam('created_after','2018-08-01T09:00:00+08:00');
			$request->addApiParam('status','pending');
			$request->addApiParam('sort_direction','ASC');
			$request->addApiParam('limit','500');
			//$request->addApiParam('created_before','2018-02-10T16:00:00+08:00');
			//$request->addApiParam('update_before','2018-02-10T16:00:00+08:00');
			//$request->addApiParam('offset','0');
			//$request->addApiParam('limit','10');
			//$request->addApiParam('update_after','2017-02-10T09:00:00+08:00');
			//$request->addApiParam('sort_by','updated_at');
			$a = $c->execute($request, $accessToken);
			$b = json_decode($a, TRUE, 512, JSON_BIGINT_AS_STRING);
			for($i=0;$i<count($b['data']['orders']);$i++){
				$array[] = $b['data']['orders'][$i]['order_number'];
					$data = array(
						'order_id' => $b['data']['orders'][$i]['order_number'], 
						'status' => $b['data']['orders'][$i]['statuses'][0], 
						'source' => $seller_id
					);
					$this->db->trans_start(FALSE);
					$this->db->insert('orderid', $data);
					$this->db->trans_complete();
			        $db_error = $this->db->error();
			        if (!empty($db_error)) { 
			        	$data = array('status' => $b['data']['orders'][$i]['statuses'][0]);
			        	$this->db->where('order_id', $b['data']['orders'][$i]['order_number']);
            			$this->db->update('orderid', $data);
            			return TRUE;
            			exit();
			        }else{
			        	return TRUE;
			        	exit();
			        }
					
			}
			return FALSE;
		}

		public function Get_Item_Ids_Laz($orderid, $accessToken, $appkey, $appsecret){
			$d = array();
			$sku = array();
			$img = array();
			$quantity = array();
			$c = new LazopClient('https://api.lazada.vn/rest', $appkey, $appsecret);
			$request = new LazopRequest('/orders/items/get','GET');
			$request->addApiParam('order_ids','['.$orderid.']');
			$a = $c->execute($request, $accessToken);
			$b = json_decode($a, TRUE, 512, JSON_BIGINT_AS_STRING);
			for($i=0;$i<count($b['data'][0]['order_items']);$i++){
				$quantity[$b['data'][0]['order_items'][$i]['sku']] = $quantity[$b['data'][0]['order_items'][$i]['sku']] + 1;
				$img[$b['data'][0]['order_items'][$i]['sku']] = $b['data'][0]['order_items'][$i]['product_main_image'];
				if($b['data'][0]['order_items'][$i]['status'] == 'canceled'){
					$invoid = null;
				}else{
					$invoid = Get_Document_Laz($accessToken, $appkey, $appsecret, $b['data'][0]['order_items'][$i]['order_item_id']);
				}
					$data = array(
						'order_id' => $orderid, 
						'order_item_id' => $b['data'][0]['order_items'][$i]['order_item_id'], 
						'sku' => $b['data'][0]['order_items'][$i]['sku'],
						'quantity' => 1,
						'price' => $b['data'][0]['order_items'][$i]['paid_price'],
						'status' => $b['data'][0]['order_items'][$i]['status'],
						'invoid' => $invoid,
						'source' => $seller_id,
						'info' => $b['data'][0]['order_items'][$i]['product_main_image']
					);
					$this->db->trans_start(FALSE);
					$this->db->insert('orders', $data);
					$this->db->trans_complete();
			        $db_error = $this->db->error();
			        if (!empty($db_error)) {
						if($invoid != null){
							$data = array(
							'status' => $b['data'][0]['order_items'][$i]['status'],
							'invoid' => $invoid
							);
							$this->db->where('order_item_id', $b['data'][0]['order_items'][$i]['order_item_id']);
            				$this->db->update('orders', $data);
						}else{
							$data = array('status' => $b['data'][0]['order_items'][$i]['status']);
							$this->db->where('order_item_id', $b['data'][0]['order_items'][$i]['order_item_id']);
            				$this->db->update('orders', $data);
						}
					}
			}
			$d['quantity'] = $quantity;
			$d['img'] = $img;
			return $d;
				}

	}