<?php
namespace LeoGalleguillos\BitlyTest\Model\Table;

use LeoGalleguillos\Bitly\Model\Table as BitlyTable;
use LeoGalleguillos\BitlyTest\TableTestCase;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class UrlTest extends TableTestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/url/';

    protected function setUp()
    {
        $configArray    = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray    = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter  = new Adapter($configArray);
        $this->urlTable = new BitlyTable\Url(
            $this->adapter
        );

        $this->dropTable();
        $this->createTable();
    }

    protected function dropTable()
    {
        $sql = file_get_contents($this->sqlPath . 'drop.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    protected function createTable()
    {
        $sql = file_get_contents($this->sqlPath . 'create.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            BitlyTable\Url::class,
            $this->urlTable
        );
    }
}
