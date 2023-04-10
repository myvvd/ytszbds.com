<?php





	$extensions = array("jpg","bmp","gif","png","mp4");

	$uploadFilename = $_FILES['upload']['name'];



	$uploadFilesize = $_FILES['upload']['size'];


	// var_dump($uploadFilesize);exit;
	if($uploadFilesize  > 1024*40*1000){

	    echo "<font color=\"red\"size=\"2\">*图片大小不能超过40M</font>";

	    exit;

	}



	$extension = pathInfo($uploadFilename,PATHINFO_EXTENSION);

	if(in_array($extension,$extensions)){

	    $uploadPath = "666/";  

	    if(!file_exists($uploadPath))

	    {

	        mkdir($uploadPath,0777,true);

	    }

	    $uuid = str_replace('.','',uniqid("",TRUE)).".".$extension;   //文件名  

	    var_dump($uuid);die;

	    $desname = $uploadPath.$uuid;

	    // $previewname =  "666/";

	    $tag = move_uploaded_file($_FILES['upload']['tmp_name'],$desname);

	    // $callback = $_REQUEST["ckCsrfToken"];

	     // 返回的数据格式（JSON）

		echo json_encode(["uploaded"=>1,"fileName"=>$uuid,"url"=>$desname]);

	}else{

	    return json(["uploaded"=>0,"error"=>["message"=>"文件格式不正确（必须为.jpg/.gif/.bmp/.png文件）"]]);

	}









?>