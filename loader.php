<?php
		function generateRandomString($length = 10) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
		}
		$fileDir = '/home/name/public_html';
		require($fileDir . '/src/XF.php');
		XF::start($fileDir);
		$app = \XF::setupApp('XF\Pub\App');
		$s = $app->session();
		$visitor = \XF::visitor();
		$uid = $s->get('userId');
		//echo $uid;
		//echo $havepemission;
		if ($uid){
			$finder = \XF::finder('XF:User');
			$user = $finder->where('user_id', $uid)->fetchOne();
			$havepemission = $user->isMemberOf(5);
			//print_r($havepemission);
			if($havepemission)
			{
				//echo "YAH";//A GOOD USER
				// Path to the file
				$path = 'https://www.dropbox.com/s/***************/**********.exe?dl=1';
				// This is based on file type of $path, but not always needed    
				$mm_type = "application/vnd.microsoft.portable-executable";
				//Set headers
				header("Pragma: public");
				header("Expires: 0");
				header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
				header("Cache-Control: public");
				header("Content-Description: File Transfer");
				header("Content-Type: " . $mm_type);
				//header('Content-Length: ' . filesize($path));
				header('Content-Disposition: attachment; filename="'.generateRandomString().'.exe"');
				header("Content-Transfer-Encoding: binary\n");
				
				// Outputs the content of the file
				readfile($path); 
				
				exit();
			}
			if(!$havepemission)
			{
				//echo "NAH";//NOT A GOOD USER
				echo "You don't have permissions";//NO PERMISSIONS
			}
		}
		else{
			//echo 'guest';
			echo "You don't have permissions";//NO PERMISSIONS
		}
?>
