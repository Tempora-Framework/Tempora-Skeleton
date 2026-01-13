<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;
use Tempora\Utils\Lang;

class LoginController extends Controller {
	#[RouteAttribute(
		path: "/login",
		name: "app_account_login_get",
		method: "GET",
		description: "Login page",
		title: "LOGIN_TITLE",
		translateTitle: true,
		translateFile: "pages/login",
		needLoginToBe: false
	)]

	public function render(): void {
		$pageData = $this->getPageData();
		$pageLang = new Lang(filePath: "pages/login");

		if (isset($pageData["form_email"])) {
			$_SESSION["page_data"] = [
				"form_email" => $pageData["form_email"]
			];
		}

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
				ASSET_ICONS_CSS,
				ASSET_FONT
			])
			->setScripts(scripts: [
				"/assets/scripts/engine.js",
				"/assets/scripts/theme.js"
			])
		;

		require Path::LAYOUT->value . "/header.php";

		require Path::LAYOUT->value . "/login/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
