<?php

namespace App\Forms;

use Nette\Application\UI\Form,
	Nextras\Forms\Rendering\Bs3FormRenderer;

class CodeForm extends Form {
	
	public function __construct($parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);

		$this->buildForm();
	}
	
	protected function buildForm()
	{
		$this->addText('name', 'Jméno');
		$this->addText('id', 'Přístupový kód')
			->setHtmlType('number');
		$this->addSubmit('save',  'uložit');
		$this->setRenderer(new Bs3FormRenderer());
	}
	
}

