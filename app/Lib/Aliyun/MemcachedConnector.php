<?php
namespace App\Lib\Aliyun;

use Memcached;
use RuntimeException;

class MemcachedConnector {

    /**
     * Create a new Memcached connection.
     *
     * @param  array  $servers
     * @return \Memcached
     *
     * @throws \RuntimeException
     */
    public function connect(array $servers)
    {
        $memcached = $this->getMemcached();
        $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
        foreach ($servers as $server)
        {
            $memcached->addServer(
                $server['host'], $server['port'], $server['weight']
            );

            // 免密码登录则跳过此步骤
            if(isset($server['authname']) && ini_get('memcached.use_sasl')) {
                $memcached->setSaslAuthData($server['authname'], $server['authpass']);
            }
        }

        $memcachedStatus = $memcached->getVersion();

        if ( ! is_array($memcachedStatus))
        {
            throw new RuntimeException("No Memcached servers added.");
        }

        if (in_array('255.255.255', $memcachedStatus) && count(array_unique($memcachedStatus)) === 1)
        {
            // Maybe OCS 会出现无法正确获取getVersion的问题
            //throw new RuntimeException("Could not establish Memcached connection.");
        }

        $memcached->setOption(Memcached::OPT_COMPRESSION, false);
        $memcached->setOption(Memcached::OPT_BINARY_PROTOCOL, true);

        return $memcached;
    }

    /**
     * Get a new Memcached instance.
     *
     * @return \Memcached
     */
    protected function getMemcached()
    {
        return new Memcached;
    }

}