<?php
	header('Content-Type:text/html;charset=utf-8');
	require "imageZip.php";

	echo '<pre>';
	//$file=$_FILES['img1'];
	// print_r($file);

	// $up='./';
	$img=$_FILES['img'];
	print_r($img);
	// die();
	$dir  = 'images/';
	if (!empty($img['name'])){
		if($img['type']==('image/jpeg'||'image/gif')&&$img['error']==0){
			$suffix=explode('.',$img['name']);
			$count=count($suffix);
			$newname = date('YmdHis',time()).'.'.$suffix[$count-1];
			move_uploaded_file($img['tmp_name'],$dir.$newname);
			//图片压缩---start
			$source =  $dir.$newname;//原图片名称
			$dst_img = $dir.substr($newname, 0, strrpos($newname, '.')).'_thumb.'.$suffix[$count-1];//压缩后图片的名称

			$percent = 1;  #原图压缩，不缩放，但体积大大降低
			$image = (new imgcompress($source,$percent))->compressImg($dst_img);
			//图片压缩---end
			echo "上传成功!";
		}else{
			echo "<script type='text/javascript'>alert('您上传的不是图片,请重新选择!');location.href=document.referrer;</script>";
			return false;
		}
	}else{
		echo "上传失败!";
	}
	
	
?>
	