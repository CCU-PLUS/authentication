<?php

namespace CCUPLUS\Authentication\Validators
{
    use CCUPLUS\Authentication\Tests\StudentIdTest;

    function date(string $format): int
    {
        if ($format === 'Y') {
            return 2019;
        } elseif (1 === StudentIdTest::$semester) {
            return 11;
        }

        return 5;
    }
}

namespace CCUPLUS\Authentication\Tests
{
    use CCUPLUS\Authentication\Validators\StudentId;
    use PHPUnit\Framework\TestCase;

    class StudentIdTest extends TestCase
    {
        public static $semester = 1;

        public function test_first_semester_student_id(): void
        {
            // 108 學年度第一學期，2019 年 11 月
            self::$semester = 1;

            $sid = new StudentId;

            $this->assertTrue($sid->valid('401110001'));
            $this->assertTrue($sid->valid('603510078'));
            $this->assertTrue($sid->valid('800210033'));

            $this->assertFalse($sid->valid('400110001'));
            $this->assertFalse($sid->valid('602510078'));
            $this->assertFalse($sid->valid('899210033'));

            $this->assertFalse($sid->valid('301110001'));
            $this->assertFalse($sid->valid('401999001'));
            $this->assertFalse($sid->valid('401110201'));
        }

        public function test_second_semester_student_id(): void
        {
            // 107 學年度第二學期，2019 年 05 月
            self::$semester = 2;

            $sid = new StudentId;

            $this->assertTrue($sid->valid('400110001'));
            $this->assertTrue($sid->valid('602510078'));
            $this->assertTrue($sid->valid('899210033'));
        }
    }
}
