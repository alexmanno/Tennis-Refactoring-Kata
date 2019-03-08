<?php

declare(strict_types=1);

namespace Kata;

use Kata\Models\Player;

class TennisGame1 implements TennisGameInterface
{
    private const LIMIT_ADVANTAGE = 4;

    private const DEUCE_SCORE = 'Deuce';

    private const MAP_EQUAL_POINTS = [
        0 => 'Love-All',
        1 => 'Fifteen-All',
        2 => 'Thirty-All',
    ];

    /** @var Player */
    private $player1;

    /** @var Player */
    private $player2;

    public function __construct($player1Name, $player2Name)
    {
        $this->player1 = new Player($player1Name);
        $this->player2 = new Player($player2Name);
    }

    public function wonPoint(string $playerName): void
    {
        if ($this->player1->getName() === $playerName) {
            $this->player1->incPoints();
        } else {
            $this->player2->incPoints();
        }
    }

    public function getScore(): string
    {
        if ($this->player1->getPoints() === $this->player2->getPoints()) {
            return $this->getScoreForEqualPoints();
        }

        if (
            $this->player1->getPoints() < self::LIMIT_ADVANTAGE &&
            $this->player2->getPoints() < self::LIMIT_ADVANTAGE
        ) {
            return sprintf(
                '%s-%s',
                $this->player1->getScore(),
                $this->player2->getScore()
            );
        }

        $winner = $this->getWinnerOrNull();
        if (null === $winner) {
            return $this->getScoreForAdvantage();
        }

        return sprintf('Win for %s', $winner->getName());
    }

    /**
     * @return string
     */
    private function getScoreForEqualPoints(): string
    {
        return self::MAP_EQUAL_POINTS[$this->player1->getPoints()] ?? self::DEUCE_SCORE;
    }

    /**
     * @return string
     */
    private function getScoreForAdvantage(): string
    {
        $minusResult = $this->player1->getPoints() - $this->player2->getPoints();

        $map = [
            1 => $this->player1->getName(),
            -1 => $this->player2->getName(),
        ];

        return sprintf('Advantage %s', $map[$minusResult]);
    }

    private function getWinnerOrNull(): ?Player
    {
        $minusResult = $this->player1->getPoints() - $this->player2->getPoints();

        if (abs($minusResult) >= 2) {
            if ($minusResult >= 2) {
                return $this->player1;
            }

            return $this->player2;
        }

        return null;
    }
}
