<?php

/**
 * Copyright 2012 Klarna AB
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * File containing the PHPUnit Klarna_HTTP_RequestTest test case
 *
 * PHP version 5.2
 *
 * @category   Payment
 * @package    Payment_Klarna
 * @subpackage Unit_Tests
 * @author     Klarna <support@klarna.com>
 * @copyright  2012 Klarna AB
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache license v2.0
 * @link       http://integration.klarna.com/
 */

/**
 * PHPUnit test case for the HTTP Response object.
 *
 * @category   Payment
 * @package    Payment_Klarna
 * @subpackage Unit_Tests
 * @author     Klarna <support@klarna.com>
 * @copyright  2012 Klarna AB
 * @license    http://www.apache.org/licenses/LICENSE-2.0 Apache license v2.0
 * @link       http://integration.klarna.com/
 */
class Klarna_Checkout_HTTP_RequestTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Klarna_Checkout_HTTP_Request
     */
    protected $request;

    /**
     * Set up resources used for each test.
     *
     * @return void
     */
    protected function setUp()
    {
        $this->request = new Klarna_Checkout_HTTP_Request('url');
    }

    /**
     * Clears the resources used between tests.
     *
     * @return void
     */
    protected function tearDown()
    {
        $this->request = null;
    }

    /**
     * Make sure that the initial state is correct.
     *
     * @return void
     */
    public function testConstructor()
    {
        $request = new Klarna_Checkout_HTTP_Request('url');

        $this->assertEquals('url', $request->getURL());
        $this->assertEquals('GET', $request->getMethod());

        $data = $request->getData();
        $this->assertInternalType('string', $data);
        $this->assertEmpty($request->getData());

        $this->assertEquals(0, count($request->getHeaders()));
    }

    /**
     * Make sure that setting HTTP method works as intended.
     *
     * @return void
     */
    public function testSetGetMethod()
    {
        $this->request->setMethod('POST');

        $this->assertEquals('POST', $this->request->getMethod());
    }

    /**
     * Make sure that setting request data works as intended.
     *
     * @return void
     */
    public function testSetGetData()
    {
        $this->request->setData('testing');

        $this->assertEquals('testing', $this->request->getData());
    }

    /**
     * Make sure that getting and setting headers work as intended.
     *
     * @return void
     */
    public function testSetGetHeader()
    {
        $this->assertEquals(0, count($this->request->getHeaders()));

        $this->request->setHeader('test', 'value');

        $this->assertEquals(1, count($this->request->getHeaders()));
        $this->assertEquals('value', $this->request->getHeader('test'));
        $this->assertEquals(
            array('test' => 'value'), $this->request->getHeaders()
        );

        $this->assertEquals(null, $this->request->getHeader('undefined'));
    }
}
