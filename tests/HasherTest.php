<?php

declare(strict_types=1);

namespace Snailweb\Utils\Hasher\Tests;

use PHPUnit\Framework\TestCase;
use Snailweb\Utils\Hasher;

/**
 * @internal
 * @coversNothing
 */
class HasherTest extends TestCase
{
    use AccessProtectedTrait;
    protected $hasher;

    public function setUp(): void
    {
        $this->hasher = new Hasher('s3cr3t', 'pr3f1x', 'suff1x');
    }

    public function testAlterData()
    {
        $data = 'data';
        $alteredData = $this->invokeMethod($this->hasher, 'alterData', [$data]);
        $this->assertNotSame($alteredData, $data);
    }

    /**
     * @dataProvider validHashes
     *
     * @param mixed $data
     * @param mixed $hash
     */
    public function testHash($data, $hash)
    {
        $hash_test = $this->hasher->hash($data);
        $this->assertSame($hash, $hash_test);
    }

    /**
     * @dataProvider validHashes
     *
     * @param mixed $data
     * @param mixed $hash
     */
    public function testCheckSumTrue($data, $hash)
    {
        $checkSum = $this->hasher->checkSum($hash, $data);
        $this->assertTrue($checkSum);
    }

    /**
     * @dataProvider invalidHashes
     *
     * @param mixed $data
     * @param mixed $hash
     */
    public function testCheckSumFalse($data, $hash)
    {
        $checkSum = $this->hasher->checkSum($hash, $data);
        $this->assertFalse($checkSum);
    }

    public function validHashes()
    {
        return [
            ['data', 'db2ab69f8e7e8dcdc3f3584749a45ba3b685540536c63b5b15ce685deeb91578'],
            ['This is a sentence', '99e02d1b513d3ff392ba07d25388e237c18136378cc4cdb8024c0c9ff15142ad'],
            ['{"This is": "JSON"}', '0495a45fd9fdf753fb3097db18c7883fee32f703314595613aa6e72082ada981'],
        ];
    }

    public function invalidHashes()
    {
        return [
            ['data', 'db2ab69f8e7e8dcdc3f3584749a45ba3b685540536c63b5b15ce685deeb91579'],
            ['This is a sentence', '09e02d1b513d3ff392ba07d25388e237c18136378cc4cdb8024c0c9ff15142ad'],
            ['{"This is": "JSON"}', '0495a45fd9fdf753fb3097db18c7883cee32f703314595613aa6e72082ada981'],
        ];
    }
}
