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
		$id = "";// там нет id (
		$title =  $anchor->nodeValue;

		return [
			'id' => $id,
			'title' => $title,
			'href' => $href,
			'time' => '',
			'description' => ''
		];
	}
}