<?php
declare(strict_types = 1);

namespace Apex\Storage;

use League\Flysystem\Local\LocalFilesystemAdapter;
use League\Flysystem\{Filesystem, FilesystemAdapter};
use League\Flysystem\UnixVisibility\PortableVisibilityConverter;
use Apex\Storage\Exceptions\StorageException;

/**
 * Storage initializer
 */
class Storage
{

    /**
     * Initialize
     */
    public static function init(
        string $adapter = 'local', 
        array $credentials = []
    ):FileSystem { 

        // Check for method
        if (!method_exists(__CLASS__, $adapter)) { 
            throw new StorageException("Invalid storage adapter specified, $adapter");
        }

        // Get and return adapter
        $obj = self::$adapter($credentials);
        return new Filesystem($obj);

    }

    /**
     * local
     */
    private static function local(array $creds):FileSystemAdapter
    {

        $obj = new LocalFilesystemAdapter(
            $creds['dir'], 
            PortableVisibilityConverter::fromArray([
                'file' => ['public' => 0755, 'private' => 0755], 
                'dir' => ['public' => 0755, 'private' => 0755]
            ]),
            LOCK_EX,
            LocalFilesystemAdapter::DISALLOW_LINKS
        );

        // Return
        return $obj;
    }

    /**
     * AWS S3
     */
    private static function aws_s3(array $creds):FileSystemAdapter
    {

        // Connection vars
        $connect_vars = [
            'credentials' => [
                'key' => $creds['aws_key'], 
                'secret' => $creds['aws_secret']
            ], 
            'region' => $creds['aws_region'], 
            'version' => $creds['aws_version']
        ];

        // Get adapter
        $obj = new League\Flysystem\AwsS3V3\AwsS3V3Adapter(
            new Aws\S3\S3Client($connect_vars), 
            $creds['aws_bucket'], 
            $creds['aws_prefix']
        );

        // Return
        return $obj;
    }

}



