<?php

namespace hermes\internal\entities;

use hermes\entities\AbstractEntity;
use hermes\entities\IAccount;
use hermes\IEntity;
use hermes\IUser;

class Account extends AbstractEntity implements IAccount {
	/**
	 *
	 * @var string
	 */
	private $key;
	/**
	 *
	 * @var string
	 */
	private $username;
	private $password;
	private $flags;
	protected $repo;
	private $real;

	public function __construct( $id, $username = '', $password = '', $flags = 0, $repo = null ) {
		parent::__construct();
		$this->key = $id;
		$this->username = $username;
		$this->password = $password;
		$this->flags = $flags;
		$this->repo = $repo;
	}

	public function bind( IEntity $entity ) {
		$this->real = $entity;
	}

	public function hydrate( array $data ) {
		$this->key = $data['id'];
		$this->username = $data['username'];
		$this->password = $data['password'];
		$this->flags = $data['flags'];
	}

	public function getKey(): string {
		if ( $this->real ) {
			return $this->real->getKey();
		}
		return $this->key;
	}

	public function getPassword(): string {
		if ( $this->real ) {
			return $this->real->getPassword();
		}
		return $this->password;
	}

	public function getUser(): IUser {
		//FIXME
		$user = Entity::create( IUser::TYPE, $this->id );
	}

	/**
	 *
	 * {@inheritdoc}
	 *
	 * @see \hermes\entities\IAccount::getUsername()
	 */
	public function getUsername(): string {
		return $this->username;
	}

	public function setUsername( string $username ): void {
		$this->setProperty( 'username', $username );
	}

	protected function setProperty( $property, $value ) {
		if ( $this->real ) {
			$this->real->setProperty( $property, $value );
		}

		if ( $this->$property !== $value ) {
			$this->$property = $value;
			if ( $this->repo ) {
				$this->repo->save( $this );
			}
		}
	}

	public function activate(): void {
		if ( $this->real ) {
			$this->real->activate();
		}
		$this->flags = $this->flags | IAccount::FLAG_ACTIVE;
	}

	public function isActivated(): bool {
		if ( $this->real ) {
			return $this->real->isActive();
		}
		return ( ( $this->flags & IAccount::FLAG_ACTIVE ) === IAccount::FLAG_ACTIVE );
	}
}