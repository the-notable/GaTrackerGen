<?php

namespace Notable\GaTrackerGen\Tools;

/**
 * Creates an alphabet to use within the token and then
 * creates a string of length $length.
 * 
 * @author Scott at stackoverflow.com
 */
class CreateToken
{
	
	/**
	 * @var CryptoRandGen
	 */
	private $numberGenerator;
	
	public function __construct()
	{
		$this->numberGenerator = new CryptoRandGen();
	}

	/**
	 * @param number $length
	 * @return string
     */
	function getToken($length)
	{
		$token = "";
		$codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		$codeAlphabet .= "abcdefghijklmnopqrstuvwxyz";
		$codeAlphabet .= "0123456789";
		
		for($i = 0; $i < $length; $i ++) {
			$token .= $codeAlphabet [$this->numberGenerator->get(0, strlen($codeAlphabet))];
		}
		return $token;
	}

}