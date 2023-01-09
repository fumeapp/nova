<?php

namespace App\Services;

use Exception;
use Aws\S3\S3Client;

class FileService
{
    public static array $types = [
        'image/jpeg' => 'jpg',
        'image/png' => 'png',
        'image/apng' => 'apng',
        'image/gif' => 'gif',
        'image/svg+xml' => 'svg',
        'image/webp' => 'webp',
    ];

    /**
     * Return acceptable image types as Validation rules
     *
     * @return string
     */
    public static function rules(): string
    {
        return 'required|string|in:' . join(',', array_keys(self::$types));
    }

    /**
     * Return a V4 UUID with a file extension based on an image type
     *
     * @throws Exception
     */
    public static function uuidFile(string $type): string
    {
        self::checkType($type);
        return self::uuid() . '.' . self::$types[$type];
    }

    /**
     * Check if an image type is supported
     *
     * @throws Exception
     */
    public static function checkType(string $type): void
    {
        if (!isset(self::$types[$type])) {
            throw new Exception('Invalid file tile: ' . $type);
        }
    }

    /**
     * UUID V4
     *
     * @return string
     */
    public static function uuid(): string
    {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            // 32 bits for "time_low"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            // 16 bits for "time_mid"
            mt_rand(0, 0xffff),
            // 16 bits for "time_hi_and_version",
            // four most significant bits holds version number 4
            mt_rand(0, 0x0fff) | 0x4000,
            // 16 bits, 8 bits for "clk_seq_hi_res",
            // 8 bits for "clk_seq_low",
            // two most significant bits holds zero and one for variant DCE1.1
            mt_rand(0, 0x3fff) | 0x8000,
            // 48 bits for "node"
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }


    /**
     * Return an S3Client based on filesystems config
     * @return S3Client
     */
    public static function s3Client(): S3Client
    {
        return new S3Client([
            'version' => 'latest',
            'region' => config('filesystems.disks.s3.region'),
            'credentials' => [
                'key' => config('filesystems.disks.s3.key'),
                'secret' => config('filesystems.disks.s3.secret'),
            ],
        ]);
    }

    /**
     * Return a full signed request
     *
     * @param string $type
     * @return array
     * @throws Exception
     */
    public static function signedRequest(string $type): array
    {
        $key = self::uuidFile($type);
        $s3Client = self::s3Client();
        return [
            'signed' => $s3Client->createPresignedRequest(
                $s3Client->getCommand('putObject', [
                    'Bucket' => config('filesystems.disks.s3.bucket'),
                    'Key' => $key,
                    'ACL' => 'public-read',
                    'ContentType' => $type,
                ]),
                sprintf('+%s minutes', 5)
            )->getUri(),
            'key' => $key,
            'url' => 'https://' . config('filesystems.disks.s3.bucket') . '.s3.amazonaws.com/' . $key,
        ];
    }

    /**
     * Store an image from a URL
     * @throws Exception
     */
    public static function store(string $url, string $type): string
    {
        self::checkType($type);
        $s3Client = self::s3Client();
        $file = self::uuidFile($type);
        $s3Client->putObject([
            'Bucket' => config('filesystems.disks.s3.bucket'),
            'Key' => $file,
            'Body' => file_get_contents($url),
            'ACL' => 'public-read',
            'ContentType' => $type,
        ]);
        return 'https://' . config('filesystems.disks.s3.bucket') . '.s3.amazonaws.com/' . $file;
    }
}
