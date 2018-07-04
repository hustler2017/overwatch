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
	public $targets = [
		'/jobs/?page=1',
		'/jobs/?page=2',
		'/jobs/?page=3'
	];
	public $update_time = 20; // сек

	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		$title = $anchor->nodeValue;
		$timestamp = pq($anchor)->parent()->parent()->parent()->find('[data-timestamp]')->attr('data-timestamp');
		$published = date("Y-m-d H:i:s", $timestamp);

		return [
			'domain' => 'weblancer',
			'url' => $href,
			'title' => $title,
			'published' => $published,
			'founded' => date("Y-m-d H:i:s", time() ),
			'description' => ''
		];
	}
}