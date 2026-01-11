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
				implode(
					separator: " ",
					array: [
						"Content-Security-Policy: default-src 'self' https://cdn.jsdelivr.net/ https://fonts.googleapis.com/ https://fonts.gstatic.com/;",
						"frame-ancestors 'none';",
						"base-uri 'self';",
						"form-action 'self';"
					]
				)
			])
			->setStyles(styles: [
				"/assets/styles/main.css",
				ASSET_REMIXICON_CSS,
				ASSET_INTER_FONT
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
