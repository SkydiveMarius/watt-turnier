<?php
namespace FCT\Watten\Src\Score;

use Assert\Assertion;
use FCT\Watten\Src\Team\TeamRepository;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GameScoreFactory
 *
 * @package FCT\Watten\Src\Score
 */
class GameScoreFactory
{
    /**
     * @var TeamRepository
     */
    private $teamRepository;

    /**
     * GameScoreFactory constructor.
     *
     * @param TeamRepository $teamRepository
     */
    public function __construct(TeamRepository $teamRepository = null)
    {
        $this->teamRepository = $teamRepository ?: new TeamRepository();
    }

    /**
     * @param array $row
     *
     * @return GameScore
     */
    public function createFromDatabase(array $row): GameScore
    {
        $sets = [
            new Set(1, $row['score_a_1'], $row['score_b_1']),
            new Set(2, $row['score_a_2'], $row['score_b_2']),
            new Set(2, $row['score_a_3'], $row['score_b_3'])
        ];

        return new GameScore(
            $row['round_id'],
            $row['table_id'],
            $this->teamRepository->getById($row['team_a']),
            $this->teamRepository->getById($row['team_b']),
            $sets
        );
    }

    /**
     * @param Request $request
     *
     * @return GameScore
     */
    public function createFromRequest(Request $request): GameScore
    {
        $data = json_decode($request->getContent(), true);
        Assertion::isArray($data);
        $this->validate($data);

        return new GameScore(
            $data['round'],
            $data['table'],
            $this->teamRepository->getById($data['teamA']),
            $this->teamRepository->getById($data['teamB']),
            $this->createSets($data)
        );
    }

    /**
     * @param array $data
     *
     * @return Set[]
     */
    private function createSets(array $data): array
    {
        $sets = [];
        foreach ($data['sets'] as $i => $setData) {
            $sets[] = new Set(
                $i + 1,
                $setData['scoreTeamA'],
                $setData['scoreTeamB']
            );
        }

        return $sets;
    }

    /**
     * @param array $data
     */
    private function validate(array $data)
    {
        Assertion::keyExists($data, 'round');
        Assertion::keyExists($data, 'table');
        Assertion::keyExists($data, 'teamA');
        Assertion::keyExists($data, 'teamB');
        Assertion::keyExists($data, 'sets');

        Assertion::integer($data['round']);
        Assertion::integer($data['table']);
        Assertion::integer($data['teamA']);
        Assertion::integer($data['teamB']);
        Assertion::isArray($data['sets']);
        Assertion::count($data['sets'], 3);

        foreach ($data['sets'] as $set) {
            Assertion::isArray($set);
            Assertion::keyExists($set, 'scoreTeamA');
            Assertion::keyExists($set, 'scoreTeamB');
            Assertion::integer($set['scoreTeamA']);
            Assertion::integer($set['scoreTeamB']);
        }
    }
}