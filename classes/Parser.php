<?php

/**
 * Created by Averin Ilya.
 * Date: 21.05.2018
 * Project: overwatch
 * Skype and email: averin.ilya@inbox.ru
 */
class Parser
{
	public $domain = '';
	public $anchor = '';
	public $timeZoneOffset = 0;

	public function get($query)
	{

		$html = file_get_contents($this->domain.$query['query_string']);
		return $html;
	}


	public function parseItem($anchor)
	{
		return [];
	}

	public function parse($html){

		$document = phpQuery::newDocument($html);
		$anchors = $document->find($this->anchor);

		$items = [];
		foreach($anchors as $anchor){
			if($item = $this->parseItem($anchor)){
				$items[] = $item;
			}
		}

		return $items;
	}
}