<?php

/**
 * Базовый класс для всех парсеров.
 */
class Parser
{
	public $domain = '';
	public $anchor = '';
	public $targets = [];
	public $tick;
	public $last_update;
	public $update_time = 60; // сек


	/**
	 * Parser constructor.
	 * Принимает массив значений свойств создаваемого экземпляра.
	 *
	 * @param $options
	 */
	public function __construct($options)
	{
		foreach($options as $param => $value) {
			if(property_exists($this, $param)){
				$this->$param = $value;
			}
		}
	}


	/**
	 * Сохраняет свою запись в БД.
	 *
	 * @return mixed
	 */
	public function save(){
		return DB::query("UPDATE tbl_overwatch_parsers SET last_update='{$this->last_update}', tick={$this->tick} WHERE classname='".strtolower(get_class($this))."'");
	}


	/**
	 * Получает HTML указанного в запросе ресурса
	 *
	 * @param $query  Url относительно домена парсера
	 *
	 * @return string
	 */
	public function get($query)
	{
		$html = file_get_contents($this->domain.$query);
		return $html;
	}

	/**
	 * Выполняет "тик" парсера. Обращается к ресурсу, парсит его и возвращает все найденные записи
	 *
	 * @return array
	 */
	public function tick(){

		if(empty($this->targets))
			return [];

		if($this->tick >= count($this->targets)){
			$this->tick = 0;
		}

		$target_url = $this->targets[$this->tick];

		$html = $this->get($target_url);
		$tasks = $this->parse($html);

		$this->tick++;

		return $tasks;
	}

	/**
	 *
	 * @param $anchor
	 *
	 * @return array
	 */
	public function parseItem($anchor)
	{
		return [];
	}


	/**
	 * Выполняет парсинг документа
	 *
	 * @param $html
	 *
	 * @return array
	 */
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