<?php

interface IUserManager {
	public function passwordIsValid($user);
	public function getUserName($user);
}