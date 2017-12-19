<?php

namespace hermes\entities;

use hermes\IEntity;
use hermes\IUser;

interface IAccount extends IEntity {
	const alias = 'account';
	const FLAG_ACTIVE = 1;
	const FLAG_ADMIN = 2;

	function getPassword(): string;

	function getUser(): IUser;

	function getUsername(): string;

	function activate(): void;

	function isActivated(): bool;
}