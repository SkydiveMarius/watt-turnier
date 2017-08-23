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
     * @param string $firstPlayer
     * @param string $secondPlayer
     * @param int    $id
     */
    public function __construct(string $firstPlayer, string $secondPlayer, int $id = null)
    {
        $this->id = $id;
        $this->firstPlayer = $firstPlayer;
        $this->secondPlayer = $secondPlayer;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
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