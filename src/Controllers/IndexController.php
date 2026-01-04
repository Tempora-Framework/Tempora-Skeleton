<?php

namespace App\Controllers;

use App\Enums\Path;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Lang;

class IndexController extends Controller {
	#[RouteAttribute(
		path: "",
		name: "app_index_get",
		method: "GET",
		description: "Index page",
	)]

	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "pages/index");

		$this
			->setHeaders(headers: [
				"Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self'; img-src 'self' data:; font-src 'self'; frame-ancestors 'none'; base-uri 'self'; form-action 'self';"
			])
			->setStyles(styles: [
				"/assets/styles/main.css",
				"/assets/styles/remixicon.css"
			])
			->setScripts(scripts: [
				"/assets/scripts/engine.js",
				"/assets/scripts/theme.js"
			])
		;

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/index/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
