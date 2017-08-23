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
    const MIN_TEAM_ID = 100;

    /**
     * @param Team $team
     */
    public function add(Team $team)
    {
        $team->setId($this->getNextId());

        $this->connection->createQueryBuilder()
            ->insert('teams')
            ->values([
                'team_id'       => ':team_id',
                'first_player'  => ':first_player',
                'second_player' => ':second_player'
            ])
            ->setParameters([
                ':team_id'       => $team->getId(),
                ':first_player'  => $team->getFirstPlayer(),
                ':second_player' => $team->getSecondPlayer()
            ])
            ->execute();
    }

    /**
     * @return int
     */
    private function getNextId(): int
    {
        $rows = $this->connection->createQueryBuilder()
            ->select('max(team_id) as max_team_id')
            ->from('teams')
            ->execute()
            ->fetchAll();

        $nextId = $rows[0]['max_team_id'];

        return is_int($nextId) ? $nextId : self::MIN_TEAM_ID;
    }
}