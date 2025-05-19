<?php

namespace App\Services;

use Rats\Zkteco\Lib\ZKTeco;
use Exception;

class ZKTecoService
{
    protected $zk;
    protected $isOnline = false;

    public function __construct()
    {
        $deviceIp = '192.168.100.125';
        $devicePort = 4370;

        try {
            if ($this->isDeviceOnline($deviceIp, $devicePort)) {
                $this->zk = new ZKTeco($deviceIp, $devicePort);
                $this->isOnline = true;
            } else {
                throw new Exception('Device is offline.');
            }
        } catch (Exception $e) {
            // Log error or handle as needed
            $this->isOnline = false;
            $this->zk = null;
        }
    }

    public function connect()
    {
        if (!$this->isOnline || !$this->zk) {
            return false;
        }

        return $this->zk->connect();
    }

    public function isDeviceOnline($ip, $port = 4370, $timeout = 2)
    {
        $connection = @fsockopen($ip, $port, $errno, $errstr, $timeout);

        if ($connection) {
            fclose($connection);
            return true;
        }

        return false;
    }

    public function getAttendanceLogs()
    {
        return $this->zk?->getAttendance() ?? [];
    }

    public function clearAttendance()
    {
        return $this->zk?->clearAttendance() ?? false;
    }

    public function getUsers()
    {
        return $this->zk?->getUser() ?? [];
    }

    public function disconnect()
    {
        if ($this->zk) {
            $this->zk->disconnect();
        }
    }
}
