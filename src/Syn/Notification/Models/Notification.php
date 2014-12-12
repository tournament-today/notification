<?php namespace Syn\Notification\Models;

use Syn\Framework\Abstracts\Model;

class Notification extends Model
{
	public function getDates() { return ['send_at', 'seen_at', 'require_read_at']; }

	public function sender()
	{
		return $this -> belongsTo('Syn\Gamer\Models\Gamer', 'sender_id');
	}
	public function receiver()
	{
		return $this -> belongsTo('Syn\Gamer\Models\Gamer', 'receiver_id');
	}
	public function clan()
	{
		return $this -> belongsTo('Syn\Clan\Models\Clan');
	}
	public function cup()
	{
		return $this -> belongsTo('Syn\Cup\Models\Cup');
	}
	public function team()
	{
		return $this -> belongsTo('Syn\Cup\Models\Participant\Team', 'team_id');
	}
	public function parent()
	{
		return $this -> belongsTo(__CLASS__);
	}
}