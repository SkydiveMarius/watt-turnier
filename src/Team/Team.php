<?php
namespace FCT\Watten\Src\Team;

/**
 * Class Team
 *
 * @package FCT\Watten\Src\Team
 */
class Team implements \JsonSerializable
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $firstPlayer;

    /**
     * @var string
     */
    private $secondPlayer;

    /**
     * Team constructor.
     *
     * @param int    $id
     * @param string $firstPlayer
     * @param string $secondPlayer
     */
    public function __construct(int $id, string $firstPlayer, string $secondPlayer)
    {
        $this->id = $id;
        $this->firstPlayer = $firstPlayer;
        $this->secondPlayer = $secondPlayer;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFirstPlayer(): string
    {
        return $this->firstPlayer;
    }

    /**
     * @return string
     */
    public function getSecondPlayer(): string
    {
        return $this->secondPlayer;
    }

    /**
     * @inheritdoc
     */
    function jsonSerialize()
    {
        return [
            'id'           => $this->id,
            'firstPlayer'  => $this->firstPlayer,
            'secondPlayer' => $this->secondPlayer
        ];
    }
}