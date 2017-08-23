<?php
namespace FCT\Watten\Src\Team;

use Doctrine\DBAL\Connection;
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
     * @var TeamFactory
     */
    private $factory;

    /**
     * TeamRepository constructor.
     *
     * @param null             $connection
     * @param TeamFactory|null $factory
     */
    public function __construct($connection = null, TeamFactory $factory = null)
    {
        parent::__construct($connection);
        $this->factory = $factory ?: new TeamFactory();
    }

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
     * @return Team[]
     */
    public function getAll(): array
    {
        $rows = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('teams')
            ->orderBy('team_id')
            ->execute()->fetchAll();

        $teams = [];
        foreach ($rows as $row) {
            $teams[] = $this->factory->createFromDatabase($row);
        }

        return $teams;
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