<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\PerfilesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\PerfilesTable Test Case
 */
class PerfilesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\PerfilesTable
     */
    protected $Perfiles;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Perfiles',
        'app.Users',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Perfiles') ? [] : ['className' => PerfilesTable::class];
        $this->Perfiles = TableRegistry::getTableLocator()->get('Perfiles', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Perfiles);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
