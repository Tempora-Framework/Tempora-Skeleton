<?php

namespace App\Factories;

use App\Enums\Role;
use Tempora\Utils\Cache\Route;
use Tempora\Utils\Navbar;

class NavbarFactory extends Navbar {
	public function __construct() {
		parent::add(
			title: "NAVBAR_HOME",
			url: Route::getPath(name: "app_home_get"),
			icon: "ri-home-2-line",
			class: "button button_secondary"
		);

		parent::add(
			title: "NAVBAR_LOGIN",
			url: Route::getPath(name: "app_account_login_get"),
			class: "button",
			needLoginToBe: false,
		);
		parent::add(
			title: "NAVBAR_REGISTER",
			url: Route::getPath(name: "app_account_register_get"),
			class: "button",
			needLoginToBe: false,
		);

		parent::add(
			title: "NAVBAR_DASHBOARD",
			url: Route::getPath(name: "app_dashboard_get"),
			icon: "ri-speed-up-line",
			class: "button",
			needLoginToBe: true,
			accessRoles: [
				Role::ADMINISTRATOR->value,
			]
		);

		parent::add(
			title: "",
			url: Route::getPath(name: "app_account_disconnect_get"),
			icon: "ri-logout-box-line",
			class: "button",
			needLoginToBe: true,
		);
	}
}
