<?php
namespace LeoGalleguillos\Bitly\Model\Table;

use Zend\Db\Adapter\Adapter;

class Url
{
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * @return int Primary key
     */
    public function insert(
        string $url,
        int $statusCode
    ) {
        $sql = '
            INSERT
              INTO `url`
                   (`url`, `http_status_code`)
            VALUES (?, ?)
                 ;
        ';
        $parameters = [
            $url,
            $statusCode,
        ];
        return $this->adapter
                    ->query($sql)
                    ->execute($parameters)
                    ->getGeneratedValue();
    }

    public function selectCount()
    {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `url`
                 ;
        ';
        $row = $this->adapter->query($sql)->execute()->current();
        return (int) $row['count'];
    }

    public function selectCountWhereUrl(
        string $url
    ) : int {
        $sql = '
            SELECT COUNT(*) AS `count`
              FROM `url`
             WHERE `url` = ?
                 ;
        ';
        $parameters = [
            $url,
        ];
        $row = $this->adapter->query($sql)->execute($parameters)->current();
        return (int) $row['count'];
    }
}
