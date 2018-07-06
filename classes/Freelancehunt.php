<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Freelancehunt extends Parser
{
	public $domain = 'https://freelancehunt.com';
	public $anchor = '#projects-html tr[data-published]';
	public $targets = [
		'/projects',
		'/projects?page=2'
	];
	public $update_time = 20; // сек

	public function parseItem($anchor)
	{
		$timestamp = pq($anchor)->attr('data-published');
		$published = date("Y-m-d H:i:s",$timestamp);
		$a = pq($anchor)->find("a.visitable");
		$title = $a->elements[0]->nodeValue;
		$href = $this->domain.$a->attr('href');

		return [
			'domain' => 'freelancehunt',
			'url' => $href,
			'title' => $title,
			'published' => $published,
			'founded' => date("Y-m-d H:i:s",time()),
			'description' => ''
		];
	}
}