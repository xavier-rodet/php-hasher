<?php

declare(strict_types=1);

namespace Snailweb\Utils;

class Hasher
{
    protected $secret;
    protected $algo;
    protected $prefix;
    protected $suffix;

    /**
     * Hasher constructor.
     *
     * @param string $secret : Secret key used to hash data (x bits)
     * @param string $prefix : Prefix data to make secret key unpredictable (x bits)
     * @param string $suffix : Suffix data to make secret key unpredictable (x bits)
     * @param string $algo   : Algorithm used for to hash data
     */
    public function __construct(string $secret, string $prefix, string $suffix, string $algo = 'sha256')
    {
        $this->secret = $secret;
        $this->prefix = $prefix;
        $this->suffix = $suffix;
        $this->algo = $algo;
    }

    /**
     * Hash data.
     *
     * @param string $data
     *
     * @return string
     */
    public function hash(string $data): string
    {
        return hash_hmac($this->algo, $this->alterData($data), $this->secret);
    }

    /**
     * Check data integrity with hash.
     *
     * @param string $hash
     * @param string $data
     *
     * @return bool
     */
    public function checkSum(string $hash, string $data): bool
    {
        return $hash === $this->hash($data);
    }

    /**
     * We alter data to protect application's secret key.
     *
     * @param string $data
     *
     * @return string
     */
    protected function alterData(string $data): string
    {
        return sprintf('_%s_%s_%s_', $this->prefix, $data, $this->suffix);
    }
}
