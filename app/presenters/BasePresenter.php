<?php

namespace App\Presenters;

use Model,
	Nette,
	Nette\Utils\DateTime,
	Nette\Utils\Json,
	App\Components,
	App\Forms,
	IPub\VisualPaginator\Components as VisualPaginator;


/**
 * Base presenter for all application presenters.
 */
abstract class BasePresenter extends Nette\Application\UI\Presenter
{

	/** @var Model\LogManager @inject */
	public $logManager;

	/** @var Nette\Http\Request @inject */
	public $httpRequest;

	/** @var Model\SetupManager */
	public $config;


	public function __construct(Model\SetupManager $setup)
	{
		$this->config = $setup;
	}
	
	public function beforeRender()
	{
		$this->template->copy = $this->config->web['copy'];
	}

    /**
     * Create main menu
     *
     * @return Components\Menu
     */
	public function createComponentMenu()
	{
		$menu = new Components\Menu();
		return $menu;
	}

    /**
     * Create calendar navigation component
     *
     * @return Components\Navigation
     */
	public function createComponentNavigation()
	{
		$navigation = new Components\Navigation();
		return $navigation;
	}

    /**
     * Create visual paginator component
     *
     * @return VisualPaginator
     */
	public function createComponentVp($name)
	{
		$visualPaginator = new VisualPaginator\Control;
        $visualPaginator->disableAjax();
		$visualPaginator->setTemplateFile('bootstrap.latte');
		$visualPaginator->getPaginator()->itemsPerPage = $this->config->paging;
		return $visualPaginator;
	}

	public function handleSignOut()
	{
		$this->getUser()->logout();
		$this->flashMessage('Odhlášení proběhlo v pořádku.', 'success');
		if($this->isAjax())
			$this->redrawControl();
		else
			$this->redirect('Sign:In');
	}

}
