<?php

namespace Laravolt\Avatar\Generator;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class DefaultGenerator implements GeneratorInterface
{
    protected ?string $name;

    public function make(?string $name, int $length = 2, bool $uppercase = false, bool $ascii = false, bool $rtl = false): string
    {
        $this->setName($name, $ascii);

        $words = new Collection(explode(' ', (string)$this->name));

        // if name contains single word, use first N character
        if ($words->count() === 1) {
            $initial = $this->getInitialFromOneWord($words, $length);
        } else {
            $initial = $this->getInitialFromMultipleWords($words, $length);
        }

        if ($uppercase) {
            $initial = strtoupper($initial);
        }

        if ($rtl) {
            $initial = collect(mb_str_split($initial))->reverse()->implode('');
        }

        return $initial;
    }

    protected function setName(?string $name, bool $ascii): void
    {
        if (is_array($name)) {
            throw new \InvalidArgumentException(
                'Passed value cannot be an array'
            );
        }

        if (is_object($name) && !method_exists($name, '__toString')) {
            throw new \InvalidArgumentException(
                'Passed object must have a __toString method'
            );
        }

        if (filter_var($name, FILTER_VALIDATE_EMAIL)) {
            // turn bayu.hendra@gmail.com into "Bayu Hendra"
            $name = str_replace('.', ' ', Str::before($name, '@'));
        }

        if ($ascii) {
            $name = Str::ascii($name);
        }

        $this->name = $name;
    }

    protected function getInitialFromOneWord(Collection $words, int $length): string
    {
        $initial = (string)$words->first();

        if (strlen((string)$this->name) >= $length) {
            $initial = Str::substr($this->name, 0, $length);
        }

        return $initial;
    }

    protected function getInitialFromMultipleWords(Collection $words, int $length): string
    {
        // otherwise, use initial char from each word
        $initials = new Collection();
        $words->each(function (string $word) use ($initials) {
            $initials->push(Str::substr($word, 0, 1));
        });

        return $this->selectInitialFromMultipleInitials($initials, $length);
    }

    protected function selectInitialFromMultipleInitials(Collection $initials, int $length): string
    {
        return $initials->slice(0, $length)->implode('');
    }
}
