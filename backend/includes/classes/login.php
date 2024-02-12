<?php
class login extends MySqliDriver 
{
	
		/***********************************************************
			************************Login Function**********************
        ***********************************************************/
	function userLogin($userName,$password,$captcha)
	{
		global $log;
		if(!isset($_SESSION))
		{
		  session_start();
		}
		$response = array();
		$response['msg_code'] = '';
		$userName=trim($userName);			 
		$password = $this->encode($password);
		$login=sprintf("select * from ".PERSON." where (email='%s' OR mobile = '%s' OR login_id = '%s') and password='%s'", $this->escape($userName) , $this->escape($userName) , $this->escape($userName) ,$this->escape($password));
		$res=$this->executeQry($login);
		$log['login_query'] = $login.' ('.date('Y-m-d h:i:s').')';

		$total=$this->getTotalRow($res); 
		if ($total>0)
		{
			$log['login_type'] = 'Login ('.date('Y-m-d h:i:s').')';
			$row=$this->fetch_array($res);
				$dashboard = "";
				if($row['active']== '1')
				{
					
					$_SESSION['user_id']= $row['id'];
					$_SESSION['login_id']= $row['email'];                                                       
					$_SESSION['name'] = $row['name'];                                                       
					$_SESSION['profile_pic'] = $row['profile_pic'];                                                       
					$_SESSION['user_type']= $row['type']; 
					if($row['type'] == 'SUPER_ADMIN')
					{						
						$stat = $this->encode("stat=admin_dashboard");                            
					}
					else
					{
						$stat = $this->encode("stat=user_dashboard");                            
					}
					$dashboard = "index.php?".$stat;
					$response['msg_code'] = "00";
					$response['msg'] = "Login Successfull.";
					$response['redirect'] = $dashboard;
					$_SESSION['dashboard']= $dashboard;
				}
				else
				{
					$response['msg_code'] = "01";
					$response['msg'] = "Account Deactivated!!! Kindly Contact To Your Admin.";
					$response['redirect'] = '';
				}
		}
		else
		{
			$response['msg_code'] = "011";
			$response['msg'] = "Invalid login credentials.";
		}			
		if($response['msg_code'] == '00')
		{
			$log['login_history'] = 'Added ('.date('Y-m-d h:i:s').')';

			$sql_history = "Insert into tbl_login_history SET login_id = '".$row['email']."', signIn = now(), ip = '".$this->get_user_ip()."', session_id = '".session_id()."', user_type = '".$_SESSION['user_type']."'";
			$res_history = $this->executeQry($sql_history); 
			
			
		}
		$log['login_response'] = 'Sent ('.date('Y-m-d h:i:s').')';
		return $response;            
	}
}
