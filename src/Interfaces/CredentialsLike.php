<?php
/**
 * This file is part of the DreamFactory Services Platform(tm) Common Components For PHP
 *
 * Copyright (c) 2012-2014 DreamFactory Software, Inc. <support@dreamfactory.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @copyright 2012-2014 DreamFactory Software, Inc.
 * @license   Apache-2.0 http://opensource.org/licenses/Apache-2.0
 * @version   git: $vector$
 */
namespace DreamFactory\Common\Interfaces;

/**
 * CredentialsLike
 * Identifies an object as a credentials container
 */
interface CredentialsLike
{
	//*************************************************************************
	//* Methods
	//*************************************************************************

	/**
	 * @return string
	 */
	public function getClientId();

	/**
	 * @return string
	 */
	public function getClientSecret();

	/**
	 * @return string
	 */
	public function getAccessToken();
}
