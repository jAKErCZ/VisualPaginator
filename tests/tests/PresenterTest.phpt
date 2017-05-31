<?php

/**
 * This file is part of the AlesWita\Components\VisualPaginator
 * Copyright (c) 2015 Ales Wita (aleswita+github@gmail.com)
 *
 * @phpVersion 7.1.0
 * @testCase
 */

declare(strict_types=1);

namespace AlesWita\Components\VisualPaginator\Tests;

use AlesWita;
use Nette;
use Tester;

require_once __DIR__ . "/../bootstrap.php";
require_once __DIR__ . "/../app/TestPresenter.php";
require_once __DIR__ . "/../app/Router.php";


final class PresenterTest extends Tester\TestCase
{
	/** @var Nette\Application\IPresenterFactory */
	private $presenterFactory;

	/** @var \SystemContainer|\Nette\DI\Container */
	private $container;

	/**
	 * @return void
	 */
	public function setUp(): void {
		parent::setUp();
		$this->container = $this->createContainer();
		$this->presenterFactory = $this->container->getByType("Nette\\Application\\IPresenterFactory");
	}

	/**
	 * @return void
	 */
	public function tearDown(): void {
		parent::tearDown();
	}

	/**
	 * @return Nette\DI\Container
	 */
	private function createContainer(): Nette\DI\Container {
		$configurator = new Nette\Configurator();

		$configurator->setDebugMode(TRUE);
		$configurator->setTempDirectory(TEMP_DIR);
		$configurator->addConfig(__DIR__ . "/../app/config/config.neon");

		return $configurator->createContainer();
	}

	/**
	 * @return Nette\Application\IPresenter
	 */
	private function createPresenter(): Nette\Application\IPresenter {
		$presenter = $this->presenterFactory->createPresenter("Test");
		$presenter->autoCanonicalize = FALSE;
		return $presenter;
	}

	/**
	 * @return void
	 */
	public function testOne(): void {
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request("Test", "GET", ["action" => "templateOne"]);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$source = Nette\Utils\Strings::normalize((string) $response->getSource());
		$template = Nette\Utils\Strings::normalize('<em>&laquo;</em>

 <strong><a href="/test/template-one?paginatorOne-page=1&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">1</a></strong>

 <strong><a href="/test/template-one?paginatorOne-page=2&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">2</a></strong>

 <strong><a href="/test/template-one?paginatorOne-page=3&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">3</a></strong>

 <strong><a href="/test/template-one?paginatorOne-page=4&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">4</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=251&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">251</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=501&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">501</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=750&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">750</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=1000&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">1000</a></strong>


<a href="/test/template-one?paginatorOne-page=2&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">&raquo;</a>');

		Tester\Assert::same($template, $source);
	}

	/**
	 * @return void
	 */
	public function testTwo(): void {
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request("Test", "GET", ["action" => "templateTwo"]);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$source = Nette\Utils\Strings::normalize((string) $response->getSource());
		$template = Nette\Utils\Strings::normalize('<em>&laquo;</em>

 <strong><a href="/test/template-two?paginatorTwo-page=1&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">1</a></strong>

 <strong><a href="/test/template-two?paginatorTwo-page=2&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">2</a></strong>

 <strong><a href="/test/template-two?paginatorTwo-page=3&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">3</a></strong>

 <strong><a href="/test/template-two?paginatorTwo-page=4&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">4</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=251&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">251</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=501&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">501</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=750&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">750</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=1000&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">1000</a></strong>


<a href="/test/template-two?paginatorTwo-page=2&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">&raquo;</a>
 <form action="/test/template-two" method="post" id="frm-paginatorTwo-itemsPerPage">
  <table>
   <tr>
    <td><label for="frm-paginatorTwo-itemsPerPage-itemsPerPage">Items per page</label></td><td><select name="itemsPerPage" id="frm-paginatorTwo-itemsPerPage-itemsPerPage" required data-nette-rules=\'[{"op":":filled","msg":"This field is required."}]\'><option value="10" selected>10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="100">100</option></select></td><td><input type="submit" name="send" value="Send"></td>
   </tr>
  </table>
 <input type="hidden" name="_do" value="paginatorTwo-itemsPerPage-submit"><!--[if IE]><input type=IEbug disabled style="display:none"><![endif]-->
</form>');

		Tester\Assert::same($template, $source);
	}

	/**
	 * @return void
	 */
	public function testThree(): void {
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request("Test", "GET", ["action" => "templateOne"]);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$source = Nette\Utils\Strings::normalize((string) $response->getSource());
		$template = Nette\Utils\Strings::normalize('<em>&laquo;</em>

 <strong><a href="/test/template-one?paginatorOne-page=1&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">1</a></strong>

 <strong><a href="/test/template-one?paginatorOne-page=2&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">2</a></strong>

 <strong><a href="/test/template-one?paginatorOne-page=3&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">3</a></strong>

 <strong><a href="/test/template-one?paginatorOne-page=4&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">4</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=251&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">251</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=501&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">501</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=750&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">750</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-one?paginatorOne-page=1000&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">1000</a></strong>


<a href="/test/template-one?paginatorOne-page=2&amp;paginatorOne-itemsPerPage=10&amp;do=paginatorOne-paginate">&raquo;</a>');

		Tester\Assert::same($template, $source);
	}

	/**
	 * @return void
	 */
	public function testFour(): void {
		$presenter = $this->createPresenter();
		$request = new Nette\Application\Request("Test", "GET", ["action" => "templateTwo"]);
		$response = $presenter->run($request);

		Tester\Assert::true($response instanceof Nette\Application\Responses\TextResponse);

		$source = Nette\Utils\Strings::normalize((string) $response->getSource());
		$template = Nette\Utils\Strings::normalize('<em>&laquo;</em>

 <strong><a href="/test/template-two?paginatorTwo-page=1&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">1</a></strong>

 <strong><a href="/test/template-two?paginatorTwo-page=2&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">2</a></strong>

 <strong><a href="/test/template-two?paginatorTwo-page=3&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">3</a></strong>

 <strong><a href="/test/template-two?paginatorTwo-page=4&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">4</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=251&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">251</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=501&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">501</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=750&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">750</a></strong>
 <em>&hellip;</em>
 <strong><a href="/test/template-two?paginatorTwo-page=1000&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">1000</a></strong>


<a href="/test/template-two?paginatorTwo-page=2&amp;paginatorTwo-itemsPerPage=10&amp;do=paginatorTwo-paginate">&raquo;</a>
 <form action="/test/template-two" method="post" id="frm-paginatorTwo-itemsPerPage">
  <table>
   <tr>
    <td><label for="frm-paginatorTwo-itemsPerPage-itemsPerPage">Items per page</label></td><td><select name="itemsPerPage" id="frm-paginatorTwo-itemsPerPage-itemsPerPage" required data-nette-rules=\'[{"op":":filled","msg":"This field is required."}]\'><option value="10" selected>10</option><option value="20">20</option><option value="30">30</option><option value="40">40</option><option value="50">50</option><option value="100">100</option></select></td><td><input type="submit" name="send" value="Send"></td>
   </tr>
  </table>
 <input type="hidden" name="_do" value="paginatorTwo-itemsPerPage-submit"><!--[if IE]><input type=IEbug disabled style="display:none"><![endif]-->
</form>');

		Tester\Assert::same($template, $source);
	}
}


$test = new PresenterTest;
$test->run();