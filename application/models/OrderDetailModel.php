<?php
	/**
	* 
	*/
include "API/lazada/LazopSdk.php";
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

		public function cancel_order_Laz($accessToken, $order_id){
			$c = new LazopClient(url,appkey,appSecret);
			$request = new LazopRequest('/order/cancel');
			$request->addApiParam('reason_detail','Out of stock');
			$request->addApiParam('reason_id','15');
			$request->addApiParam('order_item_id', $order_id);
			return $c->execute($request, $accessToken);
		}

		public function ReallyToShip_Laz($accessToken, $ItemID){
			$c = new LazopClient(url,appkey,appSecret);
			$request = new LazopRequest('/order/rts');
			$request->addApiParam('delivery_type','dropship');
			$request->addApiParam('order_item_ids','['.$ItemID.']');
			return $c->execute($request, $accessToken);
		}

		public function Get_Document_Laz($accessToken, $ItemID){
			$c = new LazopClient(url,appkey,appSecret);
			$request = new LazopRequest('/order/document/get','GET');
			$request->addApiParam('doc_type','shippingLabel');
			$request->addApiParam('order_item_ids','['.$ItemID.']');
			return $c->execute($request, $accessToken);
		}

	}