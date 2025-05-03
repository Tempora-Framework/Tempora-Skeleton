<?php

namespace App\Models\Repositories;

use Tempora\Enums\Table;
use App\Models\Entities\User;
use Tempora\Utils\ApplicationData;
use Tempora\Utils\System;
use Tempora\Traits\UserTrait;
use Exception;
use PDO;

class UserRepository extends User {

	use UserTrait;

	/**
	 * Create user
	 *
	 * @return Exception | string
	 */
	public function create(): Exception | string {
		$this->setUid(uid: System::uidGen(size: 16, table: Table::USERS->value));
		$passwordHash = password_hash(password: $this->getPassword(), algo: PASSWORD_BCRYPT);

		try {
			ApplicationData::request(
				query: "INSERT INTO " . Table::USERS->value . " (uid, name, surname, email, password, to_modify) VALUES (:uid, :name, :surname, :email, :password, :toModify)",
				data: [
					"uid" => $this->getUid(),
					"name" => $this->getName(),
					"surname" => $this->getSurname(),
					"email" => $this->getEmail(),
					"password" => $passwordHash,
					"toModify" => (int)$this->isToModify()
				]
			);
		} catch (Exception $exception) {
			return $exception;
		}

		return $this->getUid();
	}

	/**
	 * Set password
	 *
	 * @return void
	 */
	public function savePassword(): void {
		$passwordHash = password_hash(password: $this->getPassword(), algo: PASSWORD_BCRYPT);

		ApplicationData::request(
			query: "UPDATE " . Table::USERS->value . " SET password = :password, to_modify = false WHERE uid = :uid",
			data: [
				"uid" => $this->getUid(),
				"password" => $passwordHash
			]
		);
	}

	/**
	 * Verify user password
	 *
	 * @return Exception | string
	 */
	public function verifyPassword(): Exception | string {
		$userData = ApplicationData::request(
			query: "SELECT uid, password FROM " . Table::USERS->value . " WHERE email = :email",
			data: [
				"email" => $this->getEmail()
			],
			returnType: PDO::FETCH_ASSOC,
			singleValue: true
		);

		if ($userData != null) {
			if (password_verify(password: $this->getPassword(), hash: $userData["password"])) {
				return $userData["uid"];
			} else {
				return new Exception(message: "Wrong password");
			}
		}

		return new Exception(message: "Unknown user");
	}

	/**
	 * Get uid with email
	 *
	 * @param string $email
	 *
	 * @return null | string
	 */
	public static function getUidByEmail(string $email): null | string {
		return ApplicationData::request(
			query: "SELECT uid FROM " . Table::USERS->value . " WHERE email = :email",
			data: [
				"email" => $email
			],
			returnType: PDO::FETCH_COLUMN,
			singleValue: true
		);
	}
}
