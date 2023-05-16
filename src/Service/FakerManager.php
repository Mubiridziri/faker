<?php

namespace Mubiridziri\Faker\Service;

class FakerManager
{
    private string $language;

    public function __construct(string $language = 'ru')
    {
        $this->language = $language;
    }

    private function getResourceByLanguage(string $filename): string
    {
        return file_get_contents(sprintf(__DIR__ . "/../Resources/strings/%s/%s", $this->language, $filename));
    }

    public function getLastName(string $sex = 'male'): string
    {
        if (!in_array($sex, ['male', 'female'], true)) {
            throw new \InvalidArgumentException('Supported only male or female argument');
        }

        $source = $this->getResourceByLanguage('lastname.json');
        $source = array_filter(json_decode($source, true), function ($item) use ($sex) {
            return $item['sex'] == $sex;
        });
        $element = $this->getRandomElement($source);
        return $element['text'];

    }

    public function getFirstName(string $sex = 'male'): string
    {
        if (!in_array($sex, ['male', 'female'], true)) {
            throw new \InvalidArgumentException('Supported only male or female argument');
        }

        $source = $this->getResourceByLanguage('firstname.json');
        $source = array_filter(json_decode($source, true), function ($item) use ($sex) {
            return $item['sex'] == $sex;
        });
        $element = $this->getRandomElement($source);
        return $element['text'];

    }

    public function getMiddleName(string $sex = 'male'): string
    {
        if (!in_array($sex, ['male', 'female'], true)) {
            throw new \InvalidArgumentException('Supported only male or female argument');
        }

        $source = $this->getResourceByLanguage('middlename.json');
        $source = array_filter(json_decode($source, true), function ($item) use ($sex) {
            return $item['sex'] == $sex;
        });
        $element = $this->getRandomElement($source);
        return $element['text'];

    }

    public function getRandomLetter(): string
    {
        return chr(rand(97, 122));
    }

    public function getNumberBetween(int $a, int $b): int
    {
        return rand($a, $b);
    }

    public function getRandomElement(array $list)
    {
        $index = rand(0, count($list) - 1);
        return array_values($list)[$index];
    }

    public function getRandomFloat()
    {
        return mt_rand() / mt_getrandmax();
    }

    public function getRandomGUID(): string
    {
        if (true === function_exists('com_create_guid')) {
            return trim(com_create_guid(), '{}');
        }

        return sprintf('%04X%04X-%04X-%04X-%04X-%04X%04X%04X',
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(16384, 20479),
            mt_rand(32768, 49151),
            mt_rand(0, 65535),
            mt_rand(0, 65535),
            mt_rand(0, 65535)
        );
    }

    public function getShuffleString(string $string): string
    {
        return str_shuffle($string);
    }

    public function getRandomCompany(): string
    {
        $companyPrefix = $this->getResourceByLanguage('company_prefix.json');
        $companyPrefix = json_decode($companyPrefix, true);
        $companyPrefix = $this->getRandomElement($companyPrefix);

        $companyName = $this->getResourceByLanguage('company.json');
        $companyName = json_decode($companyName, true);
        $companyName = $this->getRandomElement($companyName);

        return sprintf('%s %s', $companyPrefix, $companyName);
    }

    public function getRandomCity(): string
    {
        $city = $this->getResourceByLanguage('city.json');
        $city = json_decode($city, true);
        return $this->getRandomElement($city);
    }

    public function getRandomPhoneNumber(): string
    {
        $ruPrefix = '+7';
        $number = rand(1000000000, 9999999999);
        return $ruPrefix . $number;
    }

    public function getRandomDateTimeThisMonth(): \DateTime
    {
        $date = date('01-m-Y');
        return date_modify(new \DateTime($date), ' + ' . rand(2, 27) . ' days');
    }
}
