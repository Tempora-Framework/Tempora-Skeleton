<?php
	use App\Enums\Path;
	use Tempora\Utils\Lang;
?>

<div class="reset_password_container">
	<h1><?= Lang::translate(key: "RESET_TITLE") ?></h1>

	<?php
		$oldPassword = false;
		include Path::COMPONENT_FORMS->value . "/update_password_form.php";
	?>
</div>
