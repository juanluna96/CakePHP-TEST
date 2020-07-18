<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\EstudiantesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\EstudiantesTable Test Case
 */
class EstudiantesTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\EstudiantesTable
     */
    protected $Estudiantes;

    /**
     * Fixtures
     *
     * @var array
     */
    protected $fixtures = [
        'app.Estudiantes',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();
        $config = TableRegistry::getTableLocator()->exists('Estudiantes') ? [] : ['className' => EstudiantesTable::class];
        $this->Estudiantes = TableRegistry::getTableLocator()->get('Estudiantes', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown(): void
    {
        unset($this->Estudiantes);

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
}
