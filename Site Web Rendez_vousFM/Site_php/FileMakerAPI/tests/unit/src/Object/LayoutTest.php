<?php
namespace airmoi\FileMaker\Object;

use airmoi\FileMaker\FileMaker;

/**
 * Generated by PHPUnit_SkeletonGenerator on 2016-09-09 at 19:46:51.
 */
class LayoutTest extends \PHPUnit_Framework_TestCase
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
     * @covers \airmoi\FileMaker\Object\Layout::getName
     * @todo   Implement testGetName().
     */
    public function testGetName()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getDatabase
     * @todo   Implement testGetDatabase().
     */
    public function testGetDatabase()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::listFields
     * @todo   Implement testListFields().
     */
    public function testListFields()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getField
     * @todo   Implement testGetField().
     */
    public function testGetField()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getFields
     * @todo   Implement testGetFields().
     */
    public function testGetFields()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::listRelatedSets
     * @todo   Implement testListRelatedSets().
     */
    public function testListRelatedSets()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getRelatedSet
     * @todo   Implement testGetRelatedSet().
     */
    public function testGetRelatedSet()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::hasRelatedSet
     * @todo   Implement testHasRelatedSet().
     */
    public function testHasRelatedSet()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getRelatedSets
     * @todo   Implement testGetRelatedSets().
     */
    public function testGetRelatedSets()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::listValueLists
     * @todo   Implement testListValueLists().
     */
    public function testListValueLists()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getValueList
     * @todo   Implement testGetValueList().
     */
    public function testGetValueList()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getValueListTwoFields
     * @todo   Implement testGetValueListTwoFields().
     */
    public function testGetValueListTwoFields()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getValueLists
     * @todo   Implement testGetValueLists().
     */
    public function testGetValueLists()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::getValueListsTwoFields
     * @todo   Implement testGetValueListsTwoFields().
     */
    public function testGetValueListsTwoFields()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

    /**
     * @covers \airmoi\FileMaker\Object\Layout::loadExtendedInfo
     * @todo   Implement testLoadExtendedInfo().
     */
    public function testLoadExtendedInfo()
    {
        // Remove the following lines when you implement this test.
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }
}