<?php
declare(strict_types=1);

namespace App\Services;
use Nowakowskir\JWT\JWT;
use Nowakowskir\JWT\TokenDecoded;

class JaasJWTService 
{
	public function generate(string $especialidad, bool $isEsp)
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
		            'moderator' => "true",
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
		    	return "sd";
		    }
		    if (! $publicKey = file_get_contents(__DIR__ . '/../../jaasauth.key.pub')) {
		    	return "sd";
		    }

		    $tokenEncoded = $tokenDecoded->encode( $privateKey, JWT::ALGORITHM_RS256);

		    $tokenEncoded->validate($publicKey, JWT::ALGORITHM_RS256);
		    return $tokenEncoded->toString();
		} catch(\Exception $e) {
			throw $e;
		}
	}
}