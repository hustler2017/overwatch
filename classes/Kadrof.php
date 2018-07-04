<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Kadrof extends Parser
{
	public $domain = 'http://www.kadrof.ru';
	public $anchor = '.post';
	public $targets = [
		'/work'
	];
	public $update_time = 120; // сек

	public function parseDate($date)
	{

		$date = str_replace(" в", '', $date);

		$date = date_create_from_format("d.m.Y H:i", $date);
		if($date === false) {
			return false;
		}
		return $date->getTimestamp();
	}

	public function parseItem($anchor)
	{

		$title_link = pq($anchor)->find('.project-title a');
		$href = $this->domain.$title_link->attr('href');
		$title = $title_link->html();

		$date = pq($anchor)->find('.date')->html();
		$published = $this->parseDate($date);
		if($published === false) {
			return false;
		}

		return [
			'domain' => 'kadrof',
			'url' => $href,
			'title' => $title,
			'published' => $published,
			'founded' => date("Y-m-d H:i:s", time() ),
			'description' => ''
		];
	}
}