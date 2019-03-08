<?php

declare(strict_types=1);

namespace Kata;

interface TennisGameInterface
{
    public function wonPoint(string $playerName): void;

    public function getScore(): string;
}
