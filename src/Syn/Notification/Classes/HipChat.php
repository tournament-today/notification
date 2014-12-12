<?php namespace Syn\Notification\Classes;

use Config;
use GorkaLaucirica\HipchatAPIv2Client\Auth\OAuth2;
use GorkaLaucirica\HipchatAPIv2Client\Client;
use GorkaLaucirica\HipchatAPIv2Client\API\RoomAPI;
use GorkaLaucirica\HipchatAPIv2Client\Model\Message;
use Syn\Framework\Exceptions\MissingConfigurationException;

class HipChat
{
	private static $_client;
	private static $_room;

	/**
	 * Instantiates HipChat client object
	 * @return mixed
	 */
	private static function getInstance()
	{
		if(empty(static::$_client))
		{
			if(empty(Config::get('notification::hip-chat.token')))
				throw new MissingConfigurationException('No HipChat token available, disable calls or add token');

			$auth = new OAuth2(Config::get('notification::hip-chat.token'));

			static::$_client = new Client($auth);
		}

		return static::$_client;
	}

	/**
	 * Sends message to room or default room
	 * @param       $message
	 * @param array $rooms
	 */
	public static function messageRoom($message, $critical = false, $rooms = [])
	{
		$api = new RoomAPI(static::getInstance());

		$msg = new Message();
		$msg -> setMessage(sprintf("%s%s", Config::get('notification::hip-chat.message-prefix') , $message));
		$msg -> setColor(Message::COLOR_YELLOW);
		$msg -> setNotify($critical);

		if(empty($rooms))
			$rooms[] = Config::get('notification::hip-chat.log-room');

		foreach($rooms as $room)
			$api -> sendRoomNotification($room, $msg);
	}

	/**
	 * Gets all rooms
	 * @return mixed
	 */
	public static function rooms()
	{
		$api = new RoomAPI(static::getInstance());
		return $api->getRooms();
	}
}