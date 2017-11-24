<?php

namespace hermes\service;

interface IServiceRequest {

	public function getServiceName(): string;

	public function getMethodName(): string;
}