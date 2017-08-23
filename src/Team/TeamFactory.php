<?php
namespace FCT\Watten\Src\Team;

/**
 * Class TeamFactory
 *
 * @package FCT\Watten\Src\Team
 */
class TeamFactory
{
    /**
     * @param array $row
     *
     * @return Team
     */
    public function createFromDatabase(array $row): Team
    {
        return new Team($row['first_player'], $row['second_player'], $row['team_id']);
    }
}