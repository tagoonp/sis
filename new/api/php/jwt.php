<?php

class jwt{

	public $secret = "";
	public $alg = "HS256";

	private static $supported_algs = array(
        'HS256' => array('hash_hmac', 'SHA256'),
        'HS512' => array('hash_hmac', 'SHA512'),
        'HS384' => array('hash_hmac', 'SHA384'),
        'RS256' => array('openssl', 'SHA256'),
        'RS384' => array('openssl', 'SHA384'),
        'RS512' => array('openssl', 'SHA512'),
    );

	public function encode($data){

		$header = json_encode([
			'typ' => 'JWT', 
			'alg' => $this->alg,
		]);

		$header = $this->base64Url_encode($header);
		$payload = $this->base64Url_encode($data);

		$signing = $header . "." . $payload;
		$signature = $this->sign($signing);
		if(strlen($signature)==0) return "";

        $signature = $this->base64Url_encode($signature);
		$jwt = $header . "." . $payload . "." . $signature;
		return $jwt;
	}

	public function decode($jwt){

		$tks = explode('.', $jwt);
		if(count($tks) != 3) return "";

		list($header, $payload, $signature) = $tks;
		$signature = $this->base64Url_decode($signature);
		$alg = json_decode($this->base64Url_decode($header))->alg;
		if($alg != $this->alg) {
            return "";
        }

		if(!$this->verify("$header.$payload", $signature)) {
            return "";
        }

		return $this->base64Url_decode($payload);
	}

	private function base64Url_encode($value){
		return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($value));
	}

	private function base64Url_decode($value){
        return base64_decode(str_replace(['-', '_', ''], ['+', '/', '='], $value));
    }

	private function sign($msg){

        list($func, $alg) = static::$supported_algs[$this->alg];

        switch($func) {
            case 'hash_hmac':
                return hash_hmac($alg, $msg, $this->secret, true);
            case 'openssl':
                $signature = '';
                $success = openssl_sign($msg, $signature, $this->secret, $alg);
                if (!$success) {
                    return "";
                } else {
                    return $signature;
                }
        }
    }

    private function verify($msg, $signature){

        list($func, $alg) = static::$supported_algs[$this->alg];

        switch($func) {
            case 'openssl':
                $success = openssl_verify($msg, $signature, $this->secret, $alg);
                if ($success === 1) {
                    return true;
                }
                return false;
            case 'hash_hmac':
            default:
                $hash = hash_hmac($alg, $msg, $this->secret, true);
                if (function_exists('hash_equals')) {
                    return hash_equals($signature, $hash);
                }
                $len = min($this->safeStrlen($signature), $this->safeStrlen($hash));
                $status = 0;
                for ($i = 0; $i < $len; $i++) {
                    $status |= (ord($signature[$i]) ^ ord($hash[$i]));
                }
                $status |= ($this->safeStrlen($signature) ^ $this->safeStrlen($hash));
                return ($status === 0);
        }
    }

    private function safeStrlen($str){
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, '8bit');
        }
        return strlen($str);
    }
	
}

?>