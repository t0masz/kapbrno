<?php

namespace App\Presenters;

use Nette,
	Nette\Security,
	Nette\Utils\DateTime,
	Nette\Utils\Json,
	App\Forms,
	Model;


/**
 * Sign in/out presenters.
 */
class SignPresenter extends BasePresenter
{

	/** @persistent */
	public $backlink = '';

	/** @var Model\LogManager @inject */
	public $logManager;

	/** @var Nette\Http\Request @inject */
	public $httpRequest;
    
	protected function createComponentSignInForm($name)
	{
		$form = new Forms\SignInForm($this, $name);
		$form->onSuccess[] = [$this, 'signInFormSucceeded'];
		return $form;
	}

	public function signInFormSucceeded(Forms\SignInForm $form)
	{
		$values = $form->getValues();

		$this->user->setExpiration('+60 minutes');

		$log = array(
			'ts' => new DateTime,
			'module' => 'sign',
			'values' => '',
		);
		$logValues = array(
			'user' => $values->username,
			'ip' => $this->httpRequest->getRemoteAddress(),
			'browser' => $this->httpRequest->getHeader('User-Agent'),
			'message' => '',
		);
		try {
			$this->user->login($values->username, $values->password);
			$logValues['message'] = 'SignIn success.';
			$log['values'] = Json::encode($logValues);
			$this->logManager->save($log);
			$this->flashMessage('Přihlášení proběhlo v pořádku.', 'success');
			$this->restoreRequest($this->backlink);
			$this->redirect('Intention:');

		} catch (Security\AuthenticationException $e) {
			$logValues['message'] = $e->getMessage();
			$log['values'] = Json::encode($logValues);
			$this->logManager->save($log);
			$form->addError($e->getMessage());
		}
	}

	public function actionSignOut()
	{
		$this->user->logout();
		$this->flashMessage('Odhlášení proběhlo v pořádku.', 'success');
		$this->redirect('Sign:In');
	}

}
