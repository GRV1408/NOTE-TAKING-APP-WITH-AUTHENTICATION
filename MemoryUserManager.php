<?php
require_once('credentials.php');

class MemoryUserManager implements IUserManager {
	public function passwordIsValid($user) {
		if (array_key_exists(strtolower($user), $valid_users)) {
			return password_verify($password, $valid_users[strtolower($user)]['hash']));
		}
	}

	public function getUserName($user) {
		return $valid_users[strtolower($user)]['name'];
	}
}