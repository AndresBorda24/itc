<?php
declare(strict_types=1);
namespace App\Services;

use App\Models\MeetingSession;
use App\Services\MeetingSessionService;


class ManageMeetingService
{
	private int $espId;
	private ?MeetingSession $mSession;
	private MeetingSessionService $sessionService;

	public function __construct(int $espId)
	{
		$this->espId = $espId;
		$this->mSession = (new MeetingSession)->exists($this->espId);
		$this->sessionService = new MeetingSessionService($this->espId);

		if (null === $this->mSession) {
			try {
				$this->mSession = $this->sessionService->createSession();
			} catch(\Throwable $t) {
				throw $t;
			}
		}
	}

	public function getSessionId(): string
	{
		return $this->mSession->session_id;
	}

	public function getToken(): string
	{
		return $this->sessionService->getToken(
			$this->mSession->session_id
		);
	}
}