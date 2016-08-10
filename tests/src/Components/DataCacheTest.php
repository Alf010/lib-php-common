<?php
/**
 * This file is part of the DreamFactory Services Platform(tm) (DSP)
 *
 * DreamFactory Services Platform(tm) <http://github.com/dreamfactorysoftware/dsp-core>
 * Copyright 2012-2014 DreamFactory Software, Inc. <support@dreamfactory.com>
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
 */
namespace DreamFactory\Common\Components;

/**
 * DataCacheTest
 *
 * @package DreamFactory\Common\Components
 */
class DataCacheTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers DreamFactory\Common\Components\DataCache::load
     * @covers DreamFactory\Common\Components\DataCache::store
     * @covers DreamFactory\Common\Components\DataCache::_getCacheFileName
     */
    public function testCache()
    {
        $_cacheKey = 'test.cache_key';

        $_testData = array(
            'test.option.1' => 1,
            'test.option.2' => 2,
        );

        //	Flush the cache
        DataCache::flush( $_cacheKey );

        //	Store data and check that there wasn't an error
        $this->assertTrue( false !== ( $_bytes = DataCache::store( $_cacheKey, $_testData ) ), 'File system error creating cache file.' );

        //	Test that there was data written to disk
        $this->assertNotEquals( 0, $_bytes, 'The number of bytes written was 0.' );

        //	Retrieve data
        $_cachedData = DataCache::load( $_cacheKey );

        $this->assertTrue(
            $_testData ===
            $_cachedData,
            'The returned cache data is not what we placed in the cache.' .
            PHP_EOL .
            'TEST DATA====' .
            print_r( $_testData, true ) .
            PHP_EOL .
            'CACHED====' .
            print_r( $_cachedData, true )
        );

    }
}
