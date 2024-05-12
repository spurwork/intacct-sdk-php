<?php

/**
 * Copyright 2021 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions;

use InvalidArgumentException;

/**
 * @coversDefaultClass \Intacct\Functions\AbstractFunction
 */
class AbstractFunctionTest extends \PHPUnit\Framework\TestCase
{

    /** @var AbstractFunction */
    protected $object;

    protected function setUp(): void
    {
        $this->object = $this->getMockForAbstractClass(AbstractFunction::class);
    }

    public function testValidControlId(): void
    {
        $controlId = "unittest";
        $this->object->setControlId($controlId);

        $this->assertEquals($controlId, $this->object->getControlId());
    }

    public function testNoControlId(): void
    {
        $this->object->setControlId();

        $this->assertNotNull($this->object->getControlId());
    }

    public function testMinimalLengthControlId(): void
    {
        $controlId = "";
        $this->object->setControlId($controlId);

        $this->assertNotNull($this->object->getControlId());
    }

    public function testMaximumLengthControlId(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("Function Control ID must be between 1 and 256 characters in length");

        $controlId = "12345678901234567890123456789012345678901234567890"
            . "123456789012345678901234567890123456789012345678901234567890"
            . "123456789012345678901234567890123456789012345678901234567890"
            . "123456789012345678901234567890123456789012345678901234567890"
            . "123456789012345678901234567";
        $this->object->setControlId($controlId);
    }
}
