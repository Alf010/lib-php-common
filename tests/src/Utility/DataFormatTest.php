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
namespace DreamFactory\Common\Utility;

/**
 * DataFormatTest
 *
 * @package DreamFactory\Common\Utility
 */
class DataFormatTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @covers   DreamFactory\Common\Utility\DataFormat::xmlToArray
	 * @covers   DreamFactory\Common\Utility\DataFormat::xmlToJson
	 * @covers   DreamFactory\Common\Utility\DataFormat::xmlToCsv
	 * @covers   DreamFactory\Common\Utility\DataFormat::xmlToObject
	 * @covers   DreamFactory\Common\Utility\DataFormat::jsonToXml
	 * @covers   DreamFactory\Common\Utility\DataFormat::csvToXml
	 * @covers   DreamFactory\Common\Utility\DataFormat::simpleArrayToXml
	 * @covers   DreamFactory\Common\Utility\DataFormat::arrayToXml
	 * @covers   DreamFactory\Common\Utility\DataFormat::reformatData
	 * @covers   DreamFactory\Common\Utility\DataFormat::jsonToArray
	 * @covers   DreamFactory\Common\Utility\DataFormat::jsonToCsv
	 * @covers   DreamFactory\Common\Utility\DataFormat::csvToArray
	 * @covers   DreamFactory\Common\Utility\DataFormat::csvToJson
	 * @covers   DreamFactory\Common\Utility\DataFormat::arrayToJson
	 * @covers   DreamFactory\Common\Utility\DataFormat::arrayToCsv
	 * @covers   DreamFactory\Common\Utility\DataFormat::jsonEncode
	 */
	public function testReformatData()
	{
		$_sourceData = array(
			0 => array(
				'item_1' => 'value_1',
				'item_2' => 'value_2',
				'item_3' => 'value_3',
			)
		);

		//	Data in all formats
		$_data = array(
			DataFormat::CSV       => "item_1,item_2,item_3\nvalue_1,value_2,value_3\n",
			//"\"item_1\",\"item_2\",\"item_3\"\n\"value_1\",\"value_2\",\"value_3\"\n",
			DataFormat::PHP_ARRAY => $_sourceData,
			DataFormat::JSON      => json_encode( $_sourceData ),
			DataFormat::XML       => "\t\t<item_1>value_1</item_1>\n\t\t<item_2>value_2</item_2>\n\t\t<item_3>value_3</item_3>",
		);

		$_sourceXml
			= <<<XML
<row><item_1>value_1</item_1><item_2>value_2</item_2><item_3>value_3</item_3></row>
XML;

		//	Make the CSV data

		foreach ( array_keys( $_data ) as $_format )
		{
			if ( DataFormat::XML == $_format )
			{
				continue;
			}

			foreach ( array_keys( $_data ) as $_targetFormat )
			{
				if ( $_format == $_targetFormat || DataFormat::XML == $_targetFormat )
				{
					//	Skip tests...
					continue;
				}

				$_sourceData = $_data[$_format];
				$_targetData = DataFormat::reformatData( $_sourceData, $_format, $_targetFormat );
				$_expectedData = $_data[$_targetFormat];

				if ( $_targetFormat == DataFormat::XML )
				{
					$_expectedData .= "\n";
				}

				$this->assertTrue(
					 serialize( $_targetData ) ==
					 serialize( $_expectedData ),
					 'Format "' .
					 $_format .
					 '" failed to convert properly to "' .
					 $_targetFormat .
					 '"' .
					 PHP_EOL .
					 'Format result:' .
					 PHP_EOL .
					 print_r( $_targetData, true ) .
					 PHP_EOL .
					 'Expected result:' .
					 PHP_EOL .
					 print_r( $_expectedData, true )
				);
			}
		}

	}
}
