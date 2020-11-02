<?php

namespace App\Forms;

use Nette\Application\UI\Form;
use Nextras\FormsRendering\Renderers\Bs3FormRenderer;

class SignInForm extends Form {
	
	public function __construct($parent = NULL, $name = NULL)
	{
		parent::__construct($parent, $name);

		$this->buildForm();
	}
	
	protected function buildForm()
	{
        $this->addText('username', 'Uživatelské jméno');
        $this->addPassword('password', 'Heslo');
        $this->addSubmit('login', 'Přihlásit se');
        $this->setRenderer(new Bs3FormRenderer());
	}
	
}

