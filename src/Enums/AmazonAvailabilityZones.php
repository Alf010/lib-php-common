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
namespace DreamFactory\Common\Enums;

use Kisma\Core\Enums\SeedEnum;

/**
 * AmazonAvailabilityZones
 *
 * Current Amazon EC2 availability zones as of 2014-04-18
 */
class AmazonAvailabilityZones extends SeedEnum
{
    //*************************************************************************
    //	Constants
    //*************************************************************************

    /**
     * @type string
     */
    const US_EAST_1A = 'us-east-1a';
    /**
     * @type string
     */
    const US_EAST_1B = 'us-east-1b';
    /**
     * @type string
     */
    const US_EAST_1D = 'us-east-1d';

    //*************************************************************************
    //	Deprecated Constants
    //*************************************************************************

    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const US_East_1a = 'us-east-1a';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const US_East_1b = 'us-east-1b';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const US_East_1d = 'us-east-1d';

}
