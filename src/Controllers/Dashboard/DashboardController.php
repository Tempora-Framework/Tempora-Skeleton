<?php

namespace App\Controllers\Dashboard;

use App\Enums\Path;
use App\Enums\Role;
use App\Factories\NavbarFactory;
use Tempora\Attributes\RouteAttribute;
use Tempora\Controllers\Controller;

class DashboardController extends Controller{
	#[RouteAttribute(
		path: "/dashboard",
		name: "app_dashboard_get",
		method: "GET",
		description: "Dashboard page",
		title: "DASHBOARD_TITLE",
		needLoginToBe: true,
		accessRoles: [
			Role::ADMINISTRATOR
		]
	)]

	public function __invoke(): void {
		$pageData = $this->getPageData();

		$scripts = [
			"/scripts/engine.js",
			"/scripts/theme.js"
		];

		require Path::LAYOUT->value . "/header.php";

		(new NavbarFactory)->render();

		require Path::LAYOUT->value . "/dashboard/index.php";

		include Path::LAYOUT->value . "/footer.php";
	}
}
