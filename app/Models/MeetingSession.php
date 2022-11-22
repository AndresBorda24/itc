<?php
declare(strict_types=1);
namespace App\Models;

use App\Database\Model;

/**
 * @property int $esp_id Id de la Especialidad 
 * @property string $session_id Id de la nueva sesion de Opentok
 */ 
class MeetingSession extends Model
{
	/** Nombre de la tabla */
	protected string $table = "itc_meeting_sessions";
	protected array $fillable = [ "esp_id", "session_id" ];
	protected string $types = "is";

	/**
	 *	Retorna la informacion de la sesion SI existe.
	 */
	public function exists(int $espId): ?self
	{
		try {
			$x = $this
				->select()
				->where("esp_id", $espId)
				->limit(1)
				->get();

			if ($x->num_rows === 0) {
				return null;
			}

			return $x->fetch_object(MeetingSession::class);
		} catch(\Throwable $e) {
			throw $e;
		}
	}
}