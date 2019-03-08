<?php

declare(strict_types=1);

namespace Kata\Models;

class Player
{
    private const POINTS_SCORE_MAP = [
        0 => 'Love',
        1 => 'Fifteen',
        2 => 'Thirty',
        3 => 'Forty',
    ];

    /** @var string */
    private $name;

    /** @var int */
    private $points;

    /**
     * Player constructor.
     *
     * @param string $name
     * @param int $points
     */
    public function __construct(string $name, int $points = 0)
    {
        $this->name = $name;
        $this->points = $points;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getPoints(): int
    {
        return $this->points;
    }

    /**
     * @return string|null
     */
    public function getScore(): ?string
    {
        return self::POINTS_SCORE_MAP[$this->points] ?? null;
    }

    public function incPoints(): void
    {
        ++$this->points;
    }
}
