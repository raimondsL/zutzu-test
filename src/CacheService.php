<?php

class CacheService implements CacheInterface
{
    public $filepath;

    public function __construct()
    {
        $this->filepath = getcwd() . "\\cache\\";
    }

    /**
     * Get cached entry if exists
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key)
    {
        $data = @file_get_contents($this->filepath . $key);

        if ($data) {
            $json = json_decode($data);
            if ($json->timeout > time()) {
                return $json->data;
            }
        }

        return null;
    }

    /**
     * Set cached entry by specifying key and value and duration in ms.
     *
     * @param string $key
     * @param $value
     * @param int $duration
     * @return mixed
     */
    public function set(string $key, $value, int $duration)
    {
        $data = json_encode(
            [
                "timeout" => time() + $duration,
                "data" => $value
            ]
        );

        return @file_put_contents($this->filepath . $key, $data);
    }

    /**
     * Delete cached entry
     *
     * @param string $key
     * @return boolean
     */
    public function delete(string $key)
    {
        $file = $this->filepath . $key;
        if ($this->exists($key))
            unlink($file);
    }

    /**
     * Check if cached entry exists
     *
     * @param string $key
     * @return boolean
     */
    public function exists(string $key)
    {
        return file_exists($this->filepath . $key);
    }

    /**
     * Clear all cached entries
     *
     * @return mixed
     */
    public function clear()
    {
        array_map('unlink', glob($this->filepath . "*"));
    }
   
}