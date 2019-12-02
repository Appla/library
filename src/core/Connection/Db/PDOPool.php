<?php
declare(strict_types=1);

namespace Swoole\Connection\Db;

use PDO;
use Swoole\Connection\Pool;

/**
 * @method PDO|PDOProxy get()
 * @method void put(PDO|PDOProxy $connection)
 */
class PDOPool extends Pool
{
    /** @var int */
    protected $size = 64;
    /** @var PDOConfig */
    protected $config;

    public function __construct(PDOConfig $config, int $size = 64)
    {
        $this->config = $config;
        parent::__construct(function () {
            return new PDO(
                "mysql: host={$this->config->getHost()}; dbname={$this->config->getDbname()}; charset={$this->config->getCharset()}",
                $this->config->getUsername(),
                $this->config->getPassword()
            );
        }, $size, PDOProxy::class);
    }
}
