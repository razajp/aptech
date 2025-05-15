<?php

namespace App\Services;

use Rats\Zkteco\Lib\ZKTeco;

class ZKTecoService
{
    protected $zk;

    public function __construct()
    {
        $deviceIp = '192.168.100.125'; // Change to your device IP

        $this->zk = new ZKTeco($deviceIp);
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

    public function clearAttendance()
    {
        return $this->zk->clearAttendance(); // Fetch logs
    }

    public function getUsers()
    {
        return $this->zk->getUser(); // Fetch logs
    }

    public function disconnect()
    {
        $this->zk->disconnect();
    }
}
