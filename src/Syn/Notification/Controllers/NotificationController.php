<?php namespace Syn\Notification\Controllers;

use Input, Request;
use Syn\Framework\Abstracts\Controller;

class NotificationController extends Controller
{
	public function ajax($gamer, $name)
	{
		if(!Request::ajax())
			return $this -> notAllowed('Load notifications', 'Not ajax');

		$sender_id = Input::get('sender_id');

		if(!preg_match("/^(<type>[a-z]+):(<id>[0-9]+)$/i", $sender_id, $m))
			return [];

		$type	= array_get('type', $m, 'gamer');
		$id = array_get('id', $m);

		if($type == "gamer")
			$type = "sender";

		$visitor = $this -> getVisitor();

		return $visitor -> notifications() -> where("{$type}_id", $id) -> get();
	}
}