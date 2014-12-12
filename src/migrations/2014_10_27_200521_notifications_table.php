<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NotificationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('notifications', function($table)
		{
			$table->bigIncrements('id');

			$table->bigInteger('receiver_id')->unsigned()->nullable();
			$table -> index('receiver_id');
			$table -> foreign('receiver_id') -> references('id') -> on('gamers');

			$table->bigInteger('sender_id')->unsigned()->nullable();
			$table -> index('sender_id');
			$table -> foreign('sender_id') -> references('id') -> on('gamers');

			$table->bigInteger('clan_id')->unsigned()->nullable();
			$table -> index('clan_id');
			$table -> foreign('clan_id') -> references('id') -> on('clans');

			$table->bigInteger('cup_id')->unsigned()->nullable();
			$table -> index('cup_id');
			$table -> foreign('cup_id') -> references('id') -> on('cups');

			$table->bigInteger('match_id')->unsigned()->nullable();
			$table -> index('match_id');
			$table -> foreign('match_id') -> references('id') -> on('matches');

			$table->bigInteger('team_id')->unsigned()->nullable();
			$table -> index('team_id');
			$table -> foreign('team_id') -> references('id') -> on('participant_teams');

			$table -> string('action_view_url')->nullable();

			$table -> text('title')->nullable();
			$table -> text('summary')->nullable();
			$table -> text('body')->nullable();

			$table -> bigInteger('notification_id') -> unsigned() -> nullable();

			$table -> timestamp('seen_at') -> nullable();
			$table -> timestamp('send_at') -> nullable();

			$table -> timestamp('require_read_at') -> nullable();

			$table -> timestamps();
			$table -> softDeletes();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
