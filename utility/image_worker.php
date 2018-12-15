<?php
    /* class by vh , vh.biz.ua */
    class image_worker{
       public $image; //картинка
       public $height; //высота
       public $width;  //ширина
       public $mime; //mime тип
       public $filename;
       public function __construct($filename){
          $image_info = getimagesize($filename);
          $this->height = $image_info[1];
          $this->width = $image_info[0];
          $this->mime = $image_info['mime'];
          $this->filename = $filename;
       }
       public function load(){
         switch ($this->mime){
           case 'image/png':
               $this->image = imagecreatefrompng($this->filename);
               $targetImage = imagecreatetruecolor( $this->width, $this->height );
               imagealphablending( $targetImage, false );
               imagesavealpha( $targetImage, true );
               imagecopyresampled( $targetImage,  $this->image,
                    0, 0,
                    0, 0,
                    $this->width, $this->height,
                    $this->width, $this->height );
               $this->image = $targetImage;
             break;
           case 'image/gif':
               $this->image = imagecreatefromgif($this->filename);
             break;
           case 'image/jpeg':
               $this->image = imagecreatefromjpeg($this->filename);
           break;
           default :
                $this->image = imagecreatefromjpeg($this->filename);
                $this->mime = 'image/jpeg';
           break;
         }
       }
       public function resizeToWidth($w){
         $h = (int) ($w*$this->height / $this->width);
         $canvas = imagecreatetruecolor($w,$h);
         imagealphablending( $canvas, false );
         imagesavealpha( $canvas, true );
         imagecopyresampled($canvas,$this->image,0,0,0,0,$w,$h,$this->width,$this->height);
         $this->height = $h;
         $this->width = $w;
         $this->image = $canvas;
       }
       public function resizeToHeight($h){
         $w =  (int) ($h*$this->width / $this->height);
         $canvas = imagecreatetruecolor($w,$h);
         imagealphablending( $canvas, false );
         imagesavealpha( $canvas, true );
         imagecopyresampled($canvas,$this->image,0,0,0,0,$w,$h,$this->width,$this->height);
         $this->height = $h;
         $this->width = $w;
         $this->image = $canvas;
       }
       public function crop($newwidth,$newheight){
          if ($this->height > $newheight && $this->width > $newwidth){
            if ($this->height < $this->width){
                $this->scale($newheight/$this->height);
            }else{
                $this->scale($newwidth/$this->width);
            }
          }
          if ($this->height < $this->width){
            if ($this->width < $newwidth){
              $this->scale($newwidth/$this->width);
            }
            if ($this->height < $newheight){
              $this->scale($newheight/$this->height);
            }

          }else{
            if ($this->height < $newheight){
              $this->scale($newheight/$this->height);
            }
            if ($this->width < $newwidth){
              $this->scale($newwidth/$this->width);
            }
          }

          $x = 0;
          $y = 0;
          if ($this->width > $newwidth){
            $x = (int)(($this->width - $newwidth)/2);
          }
          if ($this->height > $newheight){
            $y = (int)(($this->height - $newheight)/2);
          }
          $canvas = imagecreatetruecolor($newwidth,$newheight);
          imagealphablending( $canvas, false );
          imagesavealpha( $canvas, true );
          imagecopyresampled($canvas,$this->image,0,0,$x,$y,$this->width,$this->height,$this->width,$this->height);
          $this->height = $newheight;
          $this->width = $newwidth;
          $this->image = $canvas;
       }
       public function scale($k){
          $newwidth = $this->width*$k;
          $newheight = $this->height*$k;
          $canvas = imagecreatetruecolor($newwidth,$newheight);
          imagealphablending( $canvas, false );
          imagesavealpha( $canvas, true );
          imagecopyresampled($canvas,$this->image,0,0,0,0,$newwidth,$newheight,$this->width,$this->height);
          $this->height = $newheight;
          $this->width = $newwidth;
          $this->image = $canvas;
       }
       public function save($filename){
         switch ($this->mime){
             case 'image/png':
                 $filename .= '.png';
                 imagepng($this->image,$filename);
               break;
             case 'image/gif':
                 $filename .= '.gif';
                 imagegif($this->image,$filename);
               break;
             case 'image/jpeg':
                 $filename .= '.jpg';
                 imagejpeg($this->image,$filename);
               break;
         }
         return $filename;
       }
       public function rotateLeft(){
          $transColor = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
          $this->image = imagerotate($this->image, 90, $transColor);
          imagesavealpha($this->image, TRUE);
       }
       public function rotateRight(){
         $transColor = imagecolorallocatealpha($this->image, 255, 255, 255, 127);
         $this->image = imagerotate($this->image, -90, $transColor);
         imagesavealpha($this->image, TRUE);
       }
    }
?>
