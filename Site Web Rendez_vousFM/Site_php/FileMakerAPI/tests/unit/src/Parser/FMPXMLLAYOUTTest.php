<?php
namespace airmoi\FileMaker\Parser;

use airmoi\FileMaker\FileMaker;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-09 at 19:46:51.
 */
class FMPXMLLAYOUTTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var FileMaker
     */
    protected $fm;

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();
        $fm = new FileMaker($GLOBALS['DB_FILE'], $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
        $fm->newPerformScriptCommand('sample', 'create sample data', 10)->execute();
    }

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->fm = new FileMaker($GLOBALS['DB_FILE'], $GLOBALS['DB_HOST'], $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWD']);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @covers \airmoi\FileMaker\Parser\FMPXMLLAYOUT::parse
     * @todo   Implement testParse().
     */
    public function testParse()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Parser\FMPXMLLAYOUT::setExtendedInfo
     * @todo   Implement testSetExtendedInfo().
     */
    public function testSetExtendedInfo()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Parser\FMPXMLLAYOUT::cdata
     * @todo   Implement test_cdata().
     */
    public function test_cdata()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Parser\FMPXMLLAYOUT::associativeArrayPush
     * @todo   Implement testAssociative_array_push().
     */
    public function testAssociative_array_push()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}
