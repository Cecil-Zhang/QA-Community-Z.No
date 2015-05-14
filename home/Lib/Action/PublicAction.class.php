<?php 
	class PublicAction extends Action{
		public function verify(){
			import('ORG.Util.Image');
			Image::buildImageVerify(4,1,'png',100,32,'verify');
		}
	}
?>
