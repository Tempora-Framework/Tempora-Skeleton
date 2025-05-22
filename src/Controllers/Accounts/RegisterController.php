<?php

namespace App\Controllers\Accounts;

use App\Enums\Path;
use App\Factories\NavbarFactory;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class RegisterController extends Controller {
	#[RouteAttribute(
		path: "/register",
		name: "app_account_register_get",
		method: "GET",
		description: "Register page",
		title: "REGISTER_TITLE",
		needLoginToBe: false
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$this->setStyles(styles: [
			"/assets/styles/main.css",
			"/assets/styles/remixicon.css"
		]);

		$this->setScripts(scripts: [
			"/assets/scripts/engine.js",
			"/assets/scripts/theme.js"
		]);

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory)->render();

		require Path::LAYOUT->value . "/register/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
