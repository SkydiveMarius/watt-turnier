<?php
namespace FCT\Watten\Src\Team;

use Assert\Assertion;
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
     * @var Team[]
     */
    private $teams = [];

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
     * @param int $id
     *
     * @return Team
     */
    public function getById(int $id): Team
    {
        if (!isset($this->teams[$id])) {
            $rows = $this->connection->createQueryBuilder()
                ->select('*')->from('teams')
                ->where('team_id = :team_id')
                ->setParameter(':team_id', $id)
                ->execute()->fetchAll();

            Assertion::notEmpty($rows, 'Team not found by id=' . $id);
            $this->teams[$id] = $this->factory->createFromDatabase($rows[0]);
        }

        return $this->teams[$id];
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

        $this->teams[$team->getId()] = $team;
    }

    /**
     * @return Team[]
     */
    public function getAll(): array
    {
        $this->teams = [];
        $rows = $this->connection->createQueryBuilder()
            ->select('*')
            ->from('teams')
            ->orderBy('team_id')
            ->execute()->fetchAll();

        foreach ($rows as $row) {
            $team = $this->factory->createFromDatabase($row);
            $this->teams[$team->getId()] = $team;
        }

        return array_values($this->teams);
    }

    /**
     * @param Team $team
     */
    public function update(Team $team)
    {
        $this->connection->createQueryBuilder()
            ->update('teams')
            ->set('first_player', ':first_player')
            ->set('second_player', ':second_player')
            ->where('team_id = :team_id')
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
    public function getNumberOfTeams(): int
    {
        $rows = $this->connection->createQueryBuilder()
            ->select('count(team_id) as team_count')
            ->from('teams')
            ->execute()
            ->fetchAll();

        return (int) $rows[0]['team_count'];
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

        return is_int($nextId) ? ($nextId + 1) : self::MIN_TEAM_ID;
    }
}