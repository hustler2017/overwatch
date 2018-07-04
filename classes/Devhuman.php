<?php

/**
 * Created by Averin Ilya.
 * Date: 27.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Devhuman extends Parser
{
	public $domain = 'http://devhuman.com/';
	public $anchor = '.ln_detail_href';


	public function parseItem($anchor)
	{
		$href = $this->domain.pq($anchor)->attr('href');
		$title =  $anchor->nodeValue;

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