<?php



namespace app\sysman\controller;



use think\Db;

use think\Request;



class upload extends AdminBase

{

	public function index()

	{	

		

		if($_GET['from'] == "ckeditor"){

		  $extensions = array("jpg","bmp","gif","png","jpeg",'pdf','xlsx','xls','doc','docx','rar','zip');

		  $files = $_FILES;

		  $uploadFilename = $files['upload']['name'];

		  $uploadFilesize = $files['upload']['size'];



          if($uploadFilesize  > 1024*20*1000){

		    echo "<font color=\"red\"size=\"2\">*图片大小不能超过20M</font>";

		    exit;

		 	}



	      $extension = pathInfo($uploadFilename,PATHINFO_EXTENSION);  



		  if(in_array($extension,$extensions)){  

				$uploadPath ="./uploads/image/";  



                $uuid = str_replace('.','',uniqid("",TRUE)).".".$extension;  



                $desname = $uploadPath.$uuid;  



                $previewname = './uploads/image/'.$uuid;  

                

                $tag = move_uploaded_file($files['upload']['tmp_name'],$desname);  



                $pic_path = "/uploads/image/".$uuid;



                echo json_encode(["uploaded"=>1,"fileName"=>"666","url"=>$pic_path]);

                die;



            }else{

            	echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为.jpg/.bmp/.jpeg/.gif/.png/文件）</font>";  

            }



		}elseif($_GET['from'] == "ckeditors"){

			 $files = $_FILES;

            

            $extensions = array("mp4","mkv","avi");  

            $uploadFilename = $files['upload']['name']; 

            $uploadFilesize = $files['upload']['size'];



            if($uploadFilesize  > 1024*20*1000){

                 echo "<font color=\"red\"size=\"2\">*视频大小不能超过20M</font>";  

                 exit;

            }







            $extension = pathInfo($uploadFilename,PATHINFO_EXTENSION);  







            if(in_array($extension,$extensions)){  

                $uploadPath ="./uploads/video/";  



                $uuid = str_replace('.','',uniqid("",TRUE)).".".$extension;  



                $desname = $uploadPath.$uuid;  



                $previewname = './uploads/video/'.$uuid;  



                $tag = move_uploaded_file($files['upload']['tmp_name'],$desname);  

                $pic_path = "/uploads/video/".$uuid;



                echo json_encode(["uploaded"=>1,"fileName"=>"666","url"=>$pic_path]);

                die;





                // // $callback = $_REQUEST["CKEditorFuncNum"];    

                // $pic_path = "https://www.gogetter.cn/Public/Home/default/2556/images/004.mp4";



                // echo json_encode(["uploaded"=>1,"fileName"=>"666","url"=>$pic_path]);



            }else{  

                echo "<font color=\"red\"size=\"2\">*文件格式不正确（必须为.mp4/.mkv/.avi/文件）</font>";  

            }  

		}

		

	}

	



}