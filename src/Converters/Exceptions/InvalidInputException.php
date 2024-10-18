<?php

namespace TijsVerkoyen\ConvertToJUnitXML\Converters\Exceptions;

class InvalidInputException extends \Exception
{
    public static function invalidJSON(): self
    {
        return new self(
            'Invalid input: invalid JSON'
        );
    }
}
