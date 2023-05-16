<?php

namespace Service;

use Mubiridziri\Faker\Service\FakerManager;
use PHPUnit\Framework\TestCase;
use function PHPUnit\Framework\assertIsString;

class FakerManagerTest extends TestCase
{

    public function testGetLastName()
    {
        $faker = new FakerManager();
        $result = $faker->getLastName();
        self::assertIsString($result);
        $result = $faker->getLastName('female');
        self::assertIsString($result);
    }

    public function testGetNumberBetween()
    {
        $faker = new FakerManager();
        $result = $faker->getNumberBetween(1, 10);
        self::assertIsInt($result);
        self::assertGreaterThan(0, $result);
        self::assertLessThan(11, $result);
    }

    public function testGetRandomFloat()
    {
        $faker = new FakerManager();
        $result = $faker->getRandomFloat();
        self::assertIsFloat($result);
    }

    public function testGetRandomGUID()
    {
        $faker = new FakerManager();
        $result = $faker->getRandomGUID();
        self::assertIsString($result);
    }

    public function testGetShuffleString()
    {
        $faker = new FakerManager();
        $result = $faker->getShuffleString('abc');
        self::assertIsString($result);
    }

    public function testGetRandomLetter()
    {
        $faker = new FakerManager();
        $result = $faker->getRandomLetter();
        self::assertIsString($result);
    }

    public function testGetRandomElement()
    {
        $faker = new FakerManager();
        $array = ['a', 'b', 'c'];
        $result = $faker->getRandomElement($array);
        self::assertIsString($result);
        self::assertTrue(in_array($result, $array, true));
    }

    public function testGetFirstName()
    {
        $faker = new FakerManager();
        $result = $faker->getFirstName();
        self::assertIsString($result);
        $result = $faker->getFirstName('female');
        self::assertIsString($result);
    }

    public function testGetMiddleName()
    {
        $faker = new FakerManager();
        $result = $faker->getMiddleName();
        self::assertIsString($result);
        $result = $faker->getMiddleName('female');
        self::assertIsString($result);
    }
}
