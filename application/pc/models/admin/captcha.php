<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Captcha extends CI_Model
{
	
	public function save_captcha($data)
	{
		$data = array(
			'captcha_time' => $data['time'],
			'ip_address' => $data['ip_address'],
			'word' => $data['word']
		);
		$this->db->insert('captcha',$data);
	}
	
	public function checkCaptcha($word)
	{
		$expiration = time()-7200; // Two hour limit
		$this->db->where('captcha_time <', $expiration);
		$this->db->delete('captcha'); 
		// Then see if a captcha exists:
		
		$this->db->select('*');
		$this->db->where('word',$word);
		$this->db->where('ip_address',$this->input->ip_address());
		$this->db->where('captcha_time > ',$expiration);
		$query  = $this->db->get('captcha');
		$result = $query->result();
		$row 	= $query->num_rows();
		$row   == 0 ? $str=0 : $str=1;
		 
		return $str;
	}
	
	
}
?>