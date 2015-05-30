         <?php
        
        if (isset($_FILES['image']['name']))
        {
            $saveto = "membersBackground/$user.jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
            $typeok = TRUE;
            
            switch($_FILES['image']['type'])
            {
                case "image/gif":   $src = imagecreatefromgif($saveto); break;
                case "image/jpeg":  // Both regular and progressive jpegs
                case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
                case "image/png":   $src = imagecreatefrompng($saveto); break;
                default:            $typeok = FALSE; break;
            }
            
            if ($typeok)
            {
                list($w, $h) = getimagesize($saveto);

                $max = 850;
                $tw  = $w;
                $th  = $h;
                
                if ($w > $h && $max < $w)
                {
                    $th = $max / $w * $h;
                    $tw = $max;
                }
                elseif ($h > $w && $max < $h)
                {
                    $tw = $max / $h * $w;
                    $th = $max;
                }
                elseif ($max < $w)
                {
                    $tw = $th = $max;
                }
                
                $tmp = imagecreatetruecolor($tw, $th);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                imageconvolution($tmp, array(array(-1, -1, -1),
                    array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                imagejpeg($tmp, $saveto);
                imagedestroy($tmp);
                imagedestroy($src);
            }

        }

         //Second Image attribute
          if (isset($_FILES['profile']['name']))
        {
            $saveto = "membersPhoto/$user.jpg";
            move_uploaded_file($_FILES['profile']['tmp_name'], $saveto);
            $typeok = TRUE;
            
            switch($_FILES['profile']['type'])
            {
                case "image/gif":   $src = imagecreatefromgif($saveto); break;
                case "image/jpeg":  // Both regular and progressive jpegs
                case "image/pjpeg": $src = imagecreatefromjpeg($saveto); break;
                case "image/png":   $src = imagecreatefrompng($saveto); break;
                default:            $typeok = FALSE; break;
            }
            
            if ($typeok)
            {
                list($w, $h) = getimagesize($saveto);

                $max = 430;
                $tw  = $w;
                $th  = $h;
                
                if ($w > $h && $max < $w)
                {
                    $th = $max / $w * $h;
                    $tw = $max;
                }
                elseif ($h > $w && $max < $h)
                {
                    $tw = $max / $h * $w;
                    $th = $max;
                }
                elseif ($max < $w)
                {
                    $tw = $th = $max;
                }
                
                $tmp = imagecreatetruecolor($tw, $th);
                imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
                imageconvolution($tmp, array(array(-1, -1, -1),
                    array(-1, 16, -1), array(-1, -1, -1)), 8, 0);
                imagejpeg($tmp, $saveto);
                imagedestroy($tmp);
                imagedestroy($src);
            }
        }
            /* end of user profiles */
                if(file_exists("membersBackground/$user.jpg")){
                $saveto = "membersBackground/$user.jpg";
                }
              


        ?>