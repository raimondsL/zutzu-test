<?php declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class ZutzuTest extends TestCase
{
    public function testSuccessCacheScalarAttribute()
    {
        $cache = new CacheService;
        $this->assertFalse(!$cache->set("attribute_1", "value", 300));
    }

    public function testSuccessCacheArrayAttribute()
    {
        $cache = new CacheService;
        $this->assertFalse(!$cache->set("attribute_2", [1,2,3,4,5], 300));
    }

    public function testSuccessCacheScalarAttributeNoDuration()
    {
        $cache = new CacheService;
        $this->assertFalse(!$cache->set("attribute_3", "value", 0));
    }

    public function testFailureCacheScalarAttribute()
    {
        $cache = new CacheService;
        $this->assertFalse($cache->set("attribute_1\\123", "value", 300));
    }

    public function testFailureCacheArrayAttribute()
    {
        $cache = new CacheService;
        $this->assertFalse($cache->set("attribute_2\\123", [1,2,3,4,5], 300));
    }

    public function testFailureReadScalarAttributeNoDuration()
    {
        $cache = new CacheService;
        $this->assertNull($cache->get("attribute_3"));
    }

    public function testSuccessFileExists()
    {
        $cache = new CacheService;
        $this->assertTrue($cache->exists("attribute_3"));
    }

    public function testFileDeleteSuccess()
    {
        $cache = new CacheService;
        $cache->delete("attribute_3");
        $this->assertFalse($cache->exists("attribute_3"));
    }

    // public function testOutput()
    // {
        // $cache = new CacheService;
        // $git = new GitService;
        // var_dump($git->GetMore());
        // $files = array_diff(scandir($cache->filepath), array('..', '.'));
        // var_dump($files);
        // $files = glob($cache->filepath . "organizations-*");
        // var_dump($files);
        // $this->assertTrue(true);
    // }

    public function testCacheClearSuccess()
    {
        $cache = new CacheService;
        $cache->clear();
        $this->assertFalse($cache->exists("attribute_1"));
    }

    public function testGetOrganizations()
    {
        $git = new GitService;
        $cache = new CacheService;
        $git->GetOrganizations(0);
        $this->assertTrue($cache->exists("organizations-0"));
    }
}