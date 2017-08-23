<?php
namespace FCT\Watten\Src\Team;

use FCT\Watten\Src\Persistence\Repository;

/**
 * Class TeamRepository
 *
 * @package FCT\Watten\Src\Team
 */
class TeamRepository extends Repository
{
    /**
     * @param Team $team
     */
    public function add(Team $team)
    {

    }

    /**
     * @return int
     */
    private function getNextId(): int
    {
        $rows = $this->connection->
    }
}