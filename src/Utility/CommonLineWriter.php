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
namespace DreamFactory\Common\Utility;

use Kisma\Core\Components\LineWriter;
use Kisma\Core\Enums\EscapeStyle;
use Kisma\Core\Exceptions\FileSystemException;

/**
 * Based on the Kisma LineWriter but converts object and array values to json
 */
class CommonLineWriter extends LineWriter
{
    /**
     * @param array $data
     *
     * @throws \Kisma\Core\Exceptions\FileSystemException
     */
    protected function _write( $data )
    {
        if ( null === $this->_handle )
        {
            throw new FileSystemException( 'The file must be open to write data.' );
        }

        $_values = array();

        foreach ( $data as $_value )
        {
            // handle objects and array non-conformist to csv output
            if ( is_array( $_value ) || is_object( $_value ) )
            {
                $_value = json_encode( $_value );
            }

            if ( null === $_value )
            {
                if ( null !== $this->_nullValue )
                {
                    $_values[] = $this->_nullValue;
                    continue;
                }

                $_value = '';
            }

            if ( '' === $_value )
            {
                $_values[] = !$this->_wrapWhitespace ? '' : ( $this->_enclosure . $this->_enclosure );
                continue;
            }

            if ( $this->_lazyWrap && false === strpos( $_value, $this->_separator ) &&
                ( $this->_enclosure === '' || false === strpos( $_value, $this->_enclosure ) )
            )
            {
                $_values[] = $_value;
                continue;
            }

            switch ( $this->_escapeStyle )
            {
                case EscapeStyle::DOUBLED:
                    $_value = str_replace( $this->_enclosure, $this->_enclosure . $this->_enclosure, $_value );
                    break;

                case EscapeStyle::SLASHED:
                    $_value =
                        str_replace(
                            $this->_enclosure,
                            '\\' . $this->_enclosure,
                            str_replace( '\\', '\\\\', $_value )
                        );
                    break;
            }

            $_values[] = $this->_enclosure . $_value . $this->_enclosure;
        }

        $_line = implode( $this->_separator, $_values );

        if ( !$this->_appendEOL )
        {
            $_line .= $this->_lineBreak;
        }
        else if ( $this->_linesOut > 0 )
        {
            $_line = $this->_lineBreak . $_line;
        }

        if ( false === ( $_byteCount = fwrite( $this->_handle, $_line ) ) )
        {
            throw new FileSystemException( 'Error writing to file: ' . $this->_fileName );
        }

        if ( $_byteCount != mb_strlen( $_line ) )
        {
            throw new FileSystemException( 'Failed to write entire buffer to file: ' . $this->_fileName );
        }

        $this->_linesOut++;
    }
}
