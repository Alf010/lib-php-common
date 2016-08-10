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
namespace DreamFactory\Common\Services\Graylog;

use DreamFactory\Common\Interfaces\Graylog;
use Kisma\Core\SeedBag;
use Kisma\Core\Utility\Log;

/**
 * GelfLogger
 */
class GelfLogger extends SeedBag implements Graylog
{
	//*************************************************************************
	//* Members
	//*************************************************************************

	/**
	 * @var string
	 */
	protected static $_host = self::DefaultHost;
	/**
	 * @var int
	 */
	protected static $_port = self::DefaultPort;

	//*************************************************************************
	//* Methods
	//*************************************************************************

	/**
	 * Call this to send a GELF message to graylog2
	 *
	 * @param array|\DreamFactory\Common\Services\Graylog\Message $message The GELF message (or array of data) to log
	 *
	 * @return bool
	 */
	public static function logMessage( $message )
	{
		if ( !( $message instanceof Message ) )
		{
			$_message = new Message( $message );
			$_data = $_message->getData();
		}
		else
		{
			$_data = $message->getData();
		}

		$_toSend = static::_prepareData( $_data );

		if ( !$_toSend )
		{
			return false;
		}

		$_url = 'udp://' . static::$_host . ':' . static::$_port;

		if ( false === ( $_sock = @stream_socket_client( $_url, $_errorCode, $_errorMessage ) ) )
		{
			Log::error( 'Error opening client socket: [' . $_errorCode . '] ' . $_errorMessage );

			return false;
		}

		foreach ( $_toSend as $_buf )
		{
			if ( !fwrite( $_sock, $_buf ) )
			{
				return false;
			}
		}

		return true;
	}

	/**
	 * @param string $host
	 */
	public static function setHost( $host )
	{
		static::$_host = $host;
	}

	/**
	 * @return string
	 */
	public static function getHost()
	{
		return static::$_host;
	}

	/**
	 * @param int $port
	 *
	 * @return GelfLogger
	 */
	public function setPort( $port )
	{
		static::$_port = $port;

		return $this;
	}

	/**
	 * @return int
	 */
	public function getPort()
	{
		return static::$_port;
	}

	/**
	 * Static method for preparing GELF data to be written to UDP socket
	 *
	 * @param array $data
	 *
	 * @return array
	 */
	protected static function _prepareData( $data )
	{
		if ( false === ( $_jsonData = json_encode( $data ) ) )
		{
			return false;
		}

		$_gzJsonData = gzcompress( $_jsonData );

		if ( $_gzJsonData === false )
		{
			return false;
		}

		if ( strlen( $_gzJsonData ) <= static::MaximumChunkSize )
		{
			return array( $_gzJsonData );
		}

		$_prepared = array();

		$_chunks = str_split( $_gzJsonData, static::MaximumChunkSize );
		$_numChunks = count( $_chunks );

		if ( $_numChunks > static::MaximumChunksAllowed )
		{
			return false;
		}

		$_msgId = hash( 'sha256', microtime( true ) . rand( 10000, 99999 ), true );
		$_seqNum = 0;

		foreach ( $_chunks as $_chunk )
		{
			$_prepared[] = static::_prepareChunk( $_chunk, $_msgId, $_seqNum, $_numChunks );
		}

		return $_prepared;
	}

	/**
	 * Static method for packing a chunk of GELF data
	 *
	 * @param string  $chunk  The chunk of gzipped JSON GELF data to prepare
	 * @param string  $msgId  The 8-byte message id, same for entire chunk set
	 * @param integer $seqNum The sequence number of the chunk (0-$seqCnt)
	 * @param integer $seqCnt The total number of chunks in the sequence
	 *
	 * @return string A packed chunk ready to write to the UDP socket
	 */
	protected static function _prepareChunk( $chunk, $msgId, $seqNum, $seqCnt )
	{
		$_gelfId = pack( 'CC', 30, 15 );
		$_seqInfo = pack( 'nn', $seqNum, $seqCnt );

		return $_gelfId . $msgId . $_seqInfo . $chunk;
	}
}
