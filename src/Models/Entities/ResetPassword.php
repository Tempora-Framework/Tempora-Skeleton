<?php

namespace App\Models\Entities;

use PDO;
use Tempora\Enums\Table;
use Tempora\Utils\ApplicationData;

class ResetPassword {
	private ?string $uid = null;
	private ?string $link = null;
	private ?string $email = null;

	/**
	 * Get the value of uid
	 *
	 * @return string | null
	 */
	public function getUid(): string | null {
		return $this->uid;
	}

	/**
	 * Set the value of uid
	 *
	 * @param string $uid
	 *
	 * @return self
	 */
	public function setUid(?string $uid = null): self {
		if ($uid) {
			$this->uid = $uid;
		} else {
			$this->uid = ApplicationData::request(
				query: "SELECT uid_user FROM " . Table::USER_RESET_PASSWORD->value . " WHERE link = :link",
				data: [
					"link" => $this->link
				],
				returnType: PDO::FETCH_COLUMN,
				singleValue: true
			);
		}

		return $this;
	}

	/**
	 * Get the value of link
	 *
	 * @return string | null
	 */
	public function getLink(): string | null {
		return $this->link;
	}

	/**
	 * Set the value of link
	 *
	 * @param string $link
	 *
	 * @return self
	 */
	public function setLink(string $link): self {
		$this->link = $link;

		return $this;
	}

	/**
	 * Get the value of email
	 *
	 * @return string | null
	 */
	public function getEmail(): string | null {
		return $this->email;
	}

	/**
	 * Set the value of email
	 *
	 * @param string $email
	 *
	 * @return self
	 */
	public function setEmail(string $email): self {
		$this->email = $email;

		return $this;
	}
}
