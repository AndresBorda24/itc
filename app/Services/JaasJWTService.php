<?php
declare(strict_types=1);

namespace App\Services;
use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;

class JaasJWTService 
{
	public function generate(string $especialidad, bool $isEsp): string
	{
		$payload = [
			'iss' => 'chat',
		    'aud' => 'jitsi',
		    'exp' => time() + 60 * 30,
		    'nbf' => time(),
		    'room'=> '*',
		    'sub' => \App\App::config('jaas')['APP_ID'],
		    'context' => [
		        'user' => [
		            'moderator' => "false",
		            'name' => $isEsp ? "Especialista {$especialidad}" : "Urgencias",
		        ],
		        'features' => [
		            'recording' => "false",
		            'livestreaming' => "true",
		            'transcription' => "false",
		            'outbound-call' => "false"
		        ]
		    ]
	    ];
	    // ----------------------------------------
	    $header = [
			"alg" => "RS256",
			"kid" => \App\App::config('jaas')["API_KEY"],
			"typ" => "JWT"
	    ];

	    try {
		    $tokenDecoded = new TokenDecoded($payload, $header);
		    if (! $privateKey = file_get_contents(__DIR__ . '/../../jaas.key')) {
		    	throw new \RuntimeException("No se ha podido encontrar la credencial.") ;
		    }
		    if (! $publickey = file_get_contents(__dir__ . '/../../jaasauth.key.pub')) {
		    	throw new \RuntimeException("No se ha podido encontrar la credencial publica.") ;
		    }

		    $tokenencoded = $tokenDecoded->encode( $privateKey, JWT::ALGORITHM_RS256);

		    $tokenencoded->validate($publickey, JWT::ALGORITHM_RS256);
		    return $tokenencoded->tostring();
		} catch(\exception $e) {
			throw $e;
		}
	}
}