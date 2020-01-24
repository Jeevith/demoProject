<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jeevith extends CI_Controller {
	
	public function index()
	{
		$this->load->view('enterLimits');
	}
	
	public function displayLimitedNumbers() {
		
		 if($_REQUEST["startingNumber"] > $_REQUEST["endingNumber"]) {
		 
			 log_message('error', __METHOD__ .":". __LINE__ ." : Message => Enter Valid Limit.");//Log the message		 
			 $data['errorMessage'] = "Enter Valid Limit";
			 $this->load->view('enterLimits', $data);
			 
		 } else {
			 $data['printFrom'] = $_REQUEST["startingNumber"];
			 $data['printTo'] = $_REQUEST["endingNumber"];
			 $res = $this->readyPrintArray($data['printFrom'], $data['printTo']);
			 $data['res'] = $res;
			 $this->load->view("printGivenNumbers", $data );
		 }		 
	}
	
	private function readyPrintArray($start, $end) : array  {
		 $res = array();
		 for($i=$start; $i<=$end; $i++) {
			  switch($i) {
				case (($i%3 == 0) && ($i%5 == 0)) : 
					$ret[] = $this->config->item('MULTIPLEOFBOTH');
					break;
				case ($i%3 == 0):
					$ret[] = $this->config->item('MULTIPLEOF3');
					break;
				case ($i%5 == 0):
					$ret[] = $this->config->item('MULTIPLEOF5');
					break;
				default :
					$ret[] = $i;
			  }
		 }
		 return $ret;		 
	}
	
	
	
}
