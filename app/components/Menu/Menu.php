<?php

namespace App\Components;

use	Model,
	Nette\Application\UI\Control;

class Menu extends Control
{
	public function __construct()
	{
		parent::__construct(); # vždy je potřeba volat rodičovský konstruktor
	}

	public function render()
	{
		$this->template->setFile(__DIR__ . '/Menu.latte');
		$this->template->render();
	}

}
