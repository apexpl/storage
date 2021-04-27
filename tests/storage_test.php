<?php
declare(strict_types = 1);

use Apex\Storage\Storage;
use League\Flysystem\Filesystem;
use PHPUnit\Framework\TestCase;


/**
 * Storage test
 */
class storage_test extends TestCase
{
    /**
     * Test storage
     */
    public function test_storage()
    {

        // Init
        $dir = __DIR__ . '/tmp';
        if (!is_dir($dir)) { mkdir($dir); }
        if (file_exists("$dir/test.txt")) { unlink("$dir/test.txt"); }

        // Get filesystem
        $fs = Storage::init('local', ['dir' => $dir]);
        $this->assertEquals(FileSystem::class, $fs::class);

        // Save file
        $fs->write('matt.txt', "Matt Dizak");
        $this->assertFileExists("$dir/matt.txt");
        $this->assertTrue(str_contains(file_get_contents("$dir/matt.txt"), 'Matt Dizak'));

        // Delete file
        $fs->delete('matt.txt');
        $this->assertFileDoesNotExist("$dir/matt.txt");

        // Clean up
        if (is_dir($dir)) { rmdir($dir); }
    }

}




