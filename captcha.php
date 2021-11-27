<?php 
	session_start();
	$captcha_code=md5(rand());
	$captcha_len=substr($captcha_code,0,6);
	//echo $captcha_len;
	$_SESSION['CODE']=$captcha_len;
	$imageCaptcha=imagecreatetruecolor(100, 40);
	$captcha_bg=imagecolorallocate($imageCaptcha, 255, 160, 120);
	imagefill($imageCaptcha, 0, 0, $captcha_bg);
	$captcha_text_color=imagecolorallocate($imageCaptcha, 0, 0, 0);
	imagestring($imageCaptcha, 5, 15, 10, $captcha_len, $captcha_text_color);
	header('Content-Type:image/jpeg');
	imagejpeg($imageCaptcha);

?>