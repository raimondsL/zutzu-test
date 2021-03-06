<?php

interface CacheInterface {

    /**
     * Get cached entry if exists
     *
     * @param string $key
     * @return mixed|null
     */
    public function get(string $key);

    /**
     * Set cached entry by specifying key and value and duration in ms.
     *
     * @param string $key
     * @param $value
     * @param int $duration
     * @return mixed
     */
    public function set(string $key, $value, int $duration);

    /**
     * Delete cached entry
     *
     * @param string $key
     * @return boolean
     */
    public function delete(string $key);

    /**
     * Check if cached entry exists
     *
     * @param string $key
     * @return boolean
     */
    public function exists(string $key);

    /**
     * Clear all cached entries
     *
     * @return mixed
     */
    public function clear();
    
}
