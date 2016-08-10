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

use DreamFactory\Common\Enums\GelfLevels;

/**
 * Graylog
 *
 * @deprecated in 1.4.0, to be removed in 2.0. Use Graylog handler for Monolog
 */
interface Graylog
{
	//**************************************************************************
	//* Constants
	//**************************************************************************

	/**
	 * @var string Hostname of graylog2 server
	 */
	const DefaultHost = 'graylog.fabric.dreamfactory.com';
	/**
	 * @const integer Port that graylog2 server listens on
	 */
	const DefaultPort = 12201;
	/**
	 * @const integer Maximum message size before splitting into chunks
	 */
	const MaximumChunkSize = 8154;
	/**
	 * @const integer Maximum message size before splitting into chunks
	 */
	const MaximumChunkSizeWan = 1420;
	/**
	 * @const integer Maximum number of chunks allowed by GELF
	 */
	const MaximumChunksAllowed = 128;
	/**
	 * @const string GELF version
	 */
	const GelfVersion = '1.0';
	/**
	 * @const integer Default GELF message level
	 */
	const DefaultLevel = GelfLevels::Alert;
	/**
	 * @const string Default facility value for messages
	 */
	const DefaultFacility = 'fabric';
}
