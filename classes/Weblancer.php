<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Weblancer extends Parser
{
	public $domain = 'https://www.weblancer.net';
	public $anchor = 'h2 > a.text-bold.show_visited';

	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		pq($anchor)->attr('href', $href);
		pq($anchor)->attr('target',"_blank");
		$id = (int)substr($href,-7,6);
		$title = $anchor->nodeValue;

		$timestamp = pq($anchor)->parent()->parent()->parent()->find('[data-timestamp]')->attr('data-timestamp');
		$timestamp += $this->timeZoneOffset * 60 * 60;

		return [
			'id' => $id,
			'title' => $title,
			'href' => $href,
			'time' => $timestamp,
			'description' => ''
		];
	}
}