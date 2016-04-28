<?php
namespace Search\Test\TestCase\Model\Filter;

use Cake\Core\Configure;
use Cake\ORM\Table;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;
use Search\Manager;
use Search\Model\Filter\Value;

class ValueTest extends TestCase
{

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'plugin.Search.Articles'
    ];

    public function testProcess()
    {
        $articles = TableRegistry::get('Articles');

        $manager = new Manager($articles);
        $value = new Value('title', $manager);
        $value->args(['title' => ['Test title one']]);
        $value->query($articles->find());
        $value->process();

        $this->assertEquals(1, $value->query()->count());

        $value = new Value('title', $manager);
        $value->args(['title' => ['Test title one', 'Already the third article!']]);
        $value->query($articles->find());
        $value->process();

        $this->assertEquals(2, $value->query()->count());
    }
}
