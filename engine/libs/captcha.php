<?php
class captchaLibrary {
	public $width = 120;
	public $height = 80;
	public $font = 'tahoma.ttf';
	private $code;
	
	function __construct($code = false) { 
        if($code){
            $this->code = $code; 
        }
        else{
            $this->code = substr(md5(mt_rand()), 10, 6); 
        }
	}

	function getCode(){
		return $this->code;
	}

	function showImage() {
		$font = ENGINE_DIR . 'fonts/' . $this->font;
		$img = imagecreatetruecolor($this->width, $this->height);
		
		$width = imagesx($img);
		$height = imagesy($img);
		
		$white = imagecolorallocate($img, mt_rand(130, 255), mt_rand(130, 255), mt_rand(130, 255));
		$grey = imagecolorallocate($img, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150));
		
		$white = imagecolorallocate($img, mt_rand(130, 255), mt_rand(130, 255), mt_rand(130, 255));
		$grey = imagecolorallocate($img, mt_rand(0, 150), mt_rand(0, 150), mt_rand(0, 150));
		imagefill($img, 0, 0, $white);
		
		for($i = 0; $i < 15; $i++) {
			imageline($img, rand(1, $width/2), rand(1, $height), rand($width/2, $width), rand(1, $height), $grey);
		}
		
		imagettftext($img, 18, mt_rand(0, 45), mt_rand(10, 30), mt_rand(60, 75), $grey, $font, $this->code);
		
		header('Content-type: image/jpeg');
		
		imagejpeg($img);
		
		imagedestroy($img);		
	}
}
?>