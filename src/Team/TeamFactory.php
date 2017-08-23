<?php
namespace FCT\Watten\Src\Team;

use Assert\Assertion;
use Symfony\Component\HttpFoundation\Request;

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

    /**
     * @param Request $request
     *
     * @return Team
     */
    public function createFromRequest(Request $request): Team
    {
        $data = json_decode($request->getContent(), true);
        Assertion::isArray($data);
        $this->validate($data);

        return new Team($data['firstPlayer'], $data['secondPlayer']);
    }

    /**
     * @param array $data
     */
    private function validate(array $data)
    {
       Assertion::keyExists($data, 'firstPlayer');
       Assertion::keyExists($data, 'secondPlayer');
       Assertion::string($data['firstPlayer']);
       Assertion::string($data['secondPlayer']);
    }
}