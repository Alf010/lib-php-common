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
namespace DreamFactory\Common\Components;

use Kisma\Core\Utility\Hasher;
use Kisma\Core\Utility\Log;
use Kisma\Core\Utility\Option;
use Kisma\Core\Utility\Storage;

/**
 * DataCache
 * Dead-simple file cacher
 *
 * @deprecated in v1.5.0, to be removed in v2.0.0 {@see \Kisma\Core\Components\Flexistore}
 */
class DataCache
{
    //*************************************************************************
    //	Constants
    //*************************************************************************

    /**
     * @var string
     */
    const CACHE_PATH = '/tmp';
    /**
     * @var string
     */
    const SALTY_GOODNESS = '/%S9DE,h4|e0O70v)K-[;,_bA4sC<shV4wd3qX!T-bW~WasVRjCLt(chb9mVp$7f';
    /**
     * @var int Number of seconds to keep data cached...
     */
    const CACHE_TTL = 300;
    /**
     * @type string The default prefix for cache file names
     */
    const DEFAULT_FILE_PREFIX = '.dfcc-';
    /**
     * @type string The persistent storage key for session keys
     */
    const PERSISTENT_STORAGE_KEY = 'dfcc.session_key';

    //*************************************************************************
    //* Methods
    //*************************************************************************

    /**
     * @param string $key  The cache key
     * @param mixed  $data The default data
     *
     * @return array|bool
     */
    public static function load( $key, $data = null )
    {
        $key = $key ? : static::getKey();

        if ( file_exists( $_fileName = static::_getCacheFileName( $key ) ) )
        {
            if ( ( ( time() - filemtime( $_fileName ) ) > static::CACHE_TTL ) )
            {
                static::flush( $key );
            }
            else
            {
                $_encryptedData = file_get_contents( $_fileName );
                $_data = Storage::defrost( Hasher::decryptString( $_encryptedData, static::SALTY_GOODNESS ) );
                @touch( $_fileName );

                return $_data;
            }
        }

        if ( !empty( $data ) )
        {
            return static::store( $key, $data );
        }

        return false;
    }

    /**
     * @param string $key
     * @param mixed  $data
     *
     * @return bool
     */
    public static function store( $key, $data )
    {
        $key = $key ? : static::getKey();

        static::flush( $key );

        //  Freeze then encrypt
        $_encrypted = Hasher::encryptString( Storage::freeze( $data ), static::SALTY_GOODNESS );

        return @\file_put_contents( static::_getCacheFileName( $key ), $_encrypted );
    }

    /**
     * Removes any cached data for the specified key
     *
     * @param string $key
     *
     * @return bool True if cache was flushed, false if no cache existed to flush
     */
    public static function flush( $key )
    {
        if ( file_exists( $_fileName = static::_getCacheFileName( $key ) ) )
        {
            if ( false === @\unlink( $_fileName ) )
            {
                Log::error( 'File system error removing cache file "' . $_fileName . '"' );
            }

            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    public static function getKey()
    {
        if ( null === ( $_key = \Kisma::get( static::PERSISTENT_STORAGE_KEY ) ) )
        {
            $_key =
                PHP_SAPI . '.' .
                Option::server( 'REMOTE_ADDR', gethostname() ) . '.' .
                Option::server( 'HTTP_HOST', gethostname() );

            \Kisma::set( static::PERSISTENT_STORAGE_KEY, $_key );
        }

        return $_key;
    }

    /**
     * @param string $key
     *
     * @return void
     */
    public static function setKey( $key )
    {
        \Kisma::set( static::PERSISTENT_STORAGE_KEY, $key );
    }

    /**
     * @param string $key
     *
     * @return string
     */
    protected static function _getCacheFileName( $key )
    {
        return static::CACHE_PATH . '/.dfcc-' . sha1( $key );
    }
}