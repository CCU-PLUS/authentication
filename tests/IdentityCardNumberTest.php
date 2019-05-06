<?php

namespace CCUPLUS\Authentication\Tests;

use CCUPLUS\Authentication\Validators\IdentityCardNumber;
use PHPUnit\Framework\TestCase;

class IdentityCardNumberTest extends TestCase
{
    public function test_identify_card_number()
    {
        $icn = new IdentityCardNumber;

        $this->assertTrue($icn->valid('A190135784'));
        $this->assertTrue($icn->valid('B272029375'));
        $this->assertTrue($icn->valid('C187262792'));
        $this->assertTrue($icn->valid('D191900402'));
        $this->assertTrue($icn->valid('E143842829'));
        $this->assertTrue($icn->valid('F111026874'));
        $this->assertTrue($icn->valid('G101342880'));
        $this->assertTrue($icn->valid('H252362820'));
        $this->assertTrue($icn->valid('I228410321'));
        $this->assertTrue($icn->valid('J286304137'));
        $this->assertTrue($icn->valid('K247710156'));
        $this->assertTrue($icn->valid('L221126994'));
        $this->assertTrue($icn->valid('M168156768'));
        $this->assertTrue($icn->valid('N167882911'));
        $this->assertTrue($icn->valid('O153412921'));
        $this->assertTrue($icn->valid('P147589161'));
        $this->assertTrue($icn->valid('Q129646646'));
        $this->assertTrue($icn->valid('R111278135'));
        $this->assertTrue($icn->valid('S109564814'));
        $this->assertTrue($icn->valid('T113706232'));
        $this->assertTrue($icn->valid('U161313557'));
        $this->assertTrue($icn->valid('V126637908'));
        $this->assertTrue($icn->valid('W188980573'));
        $this->assertTrue($icn->valid('X130470948'));
        $this->assertTrue($icn->valid('Y152738299'));
        $this->assertTrue($icn->valid('Z180196623'));

        $this->assertFalse($icn->valid('0123456789'));
        $this->assertFalse($icn->valid('A000000000'));
        $this->assertFalse($icn->valid('A500000000'));
        $this->assertFalse($icn->valid('A186143025'));
        $this->assertFalse($icn->valid('A273154543'));
        $this->assertFalse($icn->valid('B180619063'));
        $this->assertFalse($icn->valid('B261103291'));
    }
}
