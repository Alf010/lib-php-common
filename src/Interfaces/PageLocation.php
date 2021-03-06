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
 * PageLocation
 * The various places within a web page
 */
interface PageLocation
{
	//**************************************************************************
	//* Constants
	//**************************************************************************

	/**
	 * @var int Within the <HEAD> section
	 */
	const HEAD = 0;
	/**
	 * @var int After the <BODY> tag
	 */
	const BODY_BEGIN = 1;
	/**
	 * @var int Before the </BODY> tag
	 */
	const BODY_END = 2;
	/**
	 * @var int The window's "onload" function
	 */
	const ON_LOAD = 3;
	/**
	 * @var int Inside the jQuery doc-ready function
	 */
	const DOCUMENT_READY = 4;

	/**
	 * @var int Within the <HEAD> section
	 * @deprecated in 1.4.0, to be removed in 2.0. Use upper-case, underscored version.
	 */
	const Head = 0;
	/**
	 * @var int After the <BODY> tag
	 * @deprecated in 1.4.0, to be removed in 2.0. Use upper-case, underscored version.
	 */
	const Begin = 1;
	/**
	 * @var int Before the </BODY> tag
	 * @deprecated in 1.4.0, to be removed in 2.0. Use upper-case, underscored version.
	 */
	const End = 2;
	/**
	 * @var int The window's "onload" function
	 * @deprecated in 1.4.0, to be removed in 2.0. Use upper-case, underscored version.
	 */
	const Load = 3;
	/**
	 * @var int Inside the jQuery doc-ready function
	 * @deprecated in 1.4.0, to be removed in 2.0. Use upper-case, underscored version.
	 */
	const DocReady = 4;

}
