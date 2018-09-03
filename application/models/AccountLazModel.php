<?php
require_once 'API/lazada/LazopSdk.php';
require_once 'API/lazada/PHPExcel.php';
require_once 'API/lazada/PHPExcel/IOFactory.php';
/**
* 
*/
class AccountLazModel extends CI_Model
{
	protect $_num;
	public function Get_Seller_Info($accessToken, $appkey, $appsecret){
		$c = new LazopClient('https://api.lazada.vn/rest', $appkey, $appsecret);
		$request = new LazopRequest('/seller/get','GET');
		$res = json_decode($c->execute($request, $accessToken), TRUE);
		if($res['code'] != 0){
			return FALSE;
		}else{
			return TRUE;
		}
	}

	public function Get_New_Token_Laz($refresh_token, $appkey, $appsecret){
		$c = new LazopClient('https://auth.lazada.com/rest', $appkey, $appsecret);
		$request = new LazopRequest('/auth/token/refresh');
		$request->addApiParam('refresh_token',$refresh_token);
		$res = $c->execute($request);
		$data = json_decode($res, TRUE);
		$this->db->where('seller_id', $data['country_user_info'][0]['short_code']);
		$this->db->from('account');
		$new = $this->db->get();
		$num = $new->num_rows();
		if($data['access_token'] != null){
			try{
				if($num < 1){
				$data = array(
					'seller_id' => $data['country_user_info'][0]['short_code'], 
					'email' => $data['account'],
					'access_token' => $data['access_token'],
					'refresh_token' => $data['refresh_token'],
					'exp' => $data['expires_in'],
					'appkey' => $appkey,
					'appsecret' => $appsecret
					);
				$this->db->insert('account', $data);
				}else{
				$data = array(
					'access_token' => $data['access_token'],
					'refresh_token' => $data['refresh_token']
					);
				$this->db->where('seller_id', $data['country_user_info'][0]['short_code']);
            	$this->db->update('account', $data);

				}
				return TRUE;
			}catch(Exception $e){
				return FALSE;
			}
		}else{
			return FALSE;
		}
	}


	public function Add_New_Account_Laz($code, $appkey, $appsecret){
		$c = new LazopClient('https://auth.lazada.com/rest', $appkey, $appsecret);
		$request = new LazopRequest('/auth/token/create');
		$request->addApiParam('code',$code);
		$res = $c->execute($request);
		$data = json_decode($res, TRUE);
		$this->db->where('seller_id', $data['country_user_info'][0]['short_code']);
		$this->db->from('account');
		$new = $this->db->get();
		$num = $new->num_rows();
		if($data['access_token'] != null){
			try{
				if($new < 1){
						$data = array(
							'seller_id' => $data['country_user_info'][0]['short_code'], 
							'email' => $data['account'],
							'access_token' => $data['access_token'],
							'refresh_token' => $data['refresh_token'],
							'exp' => $data['expires_in'],
							'appkey' => $appkey,
							'appsecret' => $appsecret
							);
						$this->db->insert('account', $data);
						return TRUE;
					}else{
						$data = array(
							'access_token' => $data['access_token'],
							'refresh_token' => $data['refresh_token']
							);
						$this->db->where('seller_id', $data['country_user_info'][0]['short_code']);
		            	$this->db->update('account', $data);
		            	return TRUE;
					}
			
			}catch(Exception $e){
				#code ....
				return FALSE;
			}
		}
	}
	



}