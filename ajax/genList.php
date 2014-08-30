<?php
	//die("Skipping this for now !");
	set_time_limit(600);
	if(isset($_POST["requestType"])){
	
		if($_POST["requestType"][20] == "M"){
			$temp = explode("pageIndex",$_POST["requestType"]);
			$pageIndex = $temp[1][1];
			$pageSize = 24;
			$handle = @fopen("filenames.txt", "r");
			if($handle){
				$counter = 0;
				$start = $pageIndex*$pageSize;
				$end = $start + $pageSize;
				print('<div class="row-fluid">');
				while (($buffer = fgets($handle, 4096)) !== false) {
					if($counter == $end){
						break;
					}
					if($counter >= $start){
						$buffer = trim($buffer);
						$dest = $buffer;
						$mName = str_replace("_", " ", $buffer);
						//$mName = substr($mName, 4, count($mName)-5);
						$mName = ucfirst($mName);
						if($counter%4 == 0){
							print('</div>');
							print('<div class="row-fluid">');
						}
						print("<div class='col-sm-4 col-xs-6 byResult' destination='$dest' mName='$mName'>");
							$thumbnailUrl = "img/thumb/".$buffer;
							print("<img src='".$thumbnailUrl."' /><br>");
						print("</div>");
					}
					$counter++;
				}
				print('</div>');
				fclose($handle);
			}
		}
		else{
			$json = file_get_contents('http://version1.api.memegenerator.net/'.$_POST["requestType"]);
			if($json == false){
				die("Unable to contact server, pleas try again later");
			}
			$counter = 0;
			$json = json_decode($json, true);
			print('<div class="row-fluid">');
			foreach($json["result"] as $result){
				$dest = explode("/", $result["imageUrl"]);
				$dest = $dest[count($dest) - 1];
				$mName = $result["displayName"];			
				if($counter%4 == 0){
					print('</div>');
					print('<div class="row-fluid">');
				}				
				print("<div class='col-sm-3 byResult' destination='$dest' mName='$mName'>");
					$thumbnailUrl = str_replace("400x", "60x60", $result["imageUrl"]);
					print("<img src='".$thumbnailUrl."' /><br>");
				print("</div>");
				$counter++;
			}
			if($counter==0){
				print("<h6>No such meme found</h6>");
			}
			print('</div>');
		}
	}
	else{
		header("Location: http://www.memegur.com");
	}
?>