<?php

namespace App\Components;

use	Model,
	Nette\Application\UI\Control;

class Menu extends Control
{

    public function render()
	{
		$this->template->setFile(__DIR__ . '/Menu.latte');
		$this->template->render();
	}

}
