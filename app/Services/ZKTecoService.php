<?php

namespace App\Services;

use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoService
{
    protected $zk;

    public function __construct()
    {
        $deviceIp = '192.168.0.102'; // Change to your device IP
        $devicePort = 4370; // Default ZKTeco port

        $this->zk = new ZKTeco($deviceIp, $devicePort);
    }

    public function connect()
    {
        if ($this->zk->connect()) {
            return true;
        }
        return false;
    }

    public function getAttendanceLogs()
    {
        return $this->zk->getAttendance(); // Fetch logs
    }

    public function disconnect()
    {
        $this->zk->disconnect();
    }
}
