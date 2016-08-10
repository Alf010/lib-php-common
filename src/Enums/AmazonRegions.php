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
 * AmazonRegions
 */
class AmazonRegions extends SeedEnum
{
    //*************************************************************************
    //* Constants
    //*************************************************************************

    /**
     * @type string US East (N. Virginia)
     */
    const US_EAST_1 = 'us-east-1';
    /**
     * @type string US West (Oregon)
     */
    const US_WEST_1 = 'us-west-1';
    /**
     * @type string US West (N. California)
     */
    const US_WEST_2 = 'us-west-2';
    /**
     * @type string EU (Ireland)
     */
    const EU_WEST_1 = 'eu-west-1';
    /**
     * @type string Asia Pacific (Singapore)
     */
    const AP_SOUTHEAST_1 = 'ap-southeast-1';
    /**
     * @type string Asia Pacific (Sydney)
     */
    const AP_SOUTHEAST_2 = 'ap-southeast-2';
    /**
     * @type string Asia Pacific (Tokyo)
     */
    const AP_NORTHEAST_1 = 'ap-northeast-1';
    /**
     * @type string South America (São Paulo)
     */
    const SA_EAST_1 = 'sa-east-1';

    //*************************************************************************
    //	Deprecated Constants
    //*************************************************************************

    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const US_East_1 = 'us-east-1';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const US_West_1 = 'us-west-1';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const US_West_2 = 'us-west-2';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const EU_West_1 = 'eu-west-1';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const AP_Southeast_1 = 'ap-southeast-1';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const AP_Southeast_2 = 'ap-southeast-2';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const AP_Northeast_1 = 'ap-northeast-1';
    /**
     * @var string
     * @deprecated in 1.5.0, to be removed in 2.0.0
     */
    const SA_East_1 = 'sa-east-1';
}
