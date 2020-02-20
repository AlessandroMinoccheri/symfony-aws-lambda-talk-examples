<?php

declare(strict_types=1);

namespace App\Object;

use AppBundle\Exception\UndefinedContentTypeException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ContentType
{
    const PARAM_EXTENSION = 'ext';

    const EXTENSION_DOC_PDF = 'pdf';

    const EXTENSION_DOC_DOC = 'doc';

    const EXTENSION_DOC_DOCX = 'docx';

    const EXTENSION_DOC_TXT = 'txt';

    const EXTENSION_DOC_XLS = 'xls';

    const EXTENSION_DOC_XLSX = 'xlsx';

    const EXTENSION_IMG_GIF = 'gif';

    const EXTENSION_IMG_PNG = 'png';

    const EXTENSION_IMG_JPG = 'jpg';

    private static $documentExtensionsMap = [
        ContentType::EXTENSION_DOC_DOC,
        ContentType::EXTENSION_DOC_DOCX,
        ContentType::EXTENSION_DOC_PDF,
        ContentType::EXTENSION_DOC_TXT,
        ContentType::EXTENSION_DOC_XLS,
        ContentType::EXTENSION_DOC_XLSX,
    ];

    private static $imageExtensionsMap = [
        ContentType::EXTENSION_IMG_GIF,
        ContentType::EXTENSION_IMG_JPG,
        ContentType::EXTENSION_IMG_PNG,
    ];

    private static $extensionToContentTypeMap = [
        ContentType::EXTENSION_DOC_DOC => 'application/msword',
        ContentType::EXTENSION_DOC_DOCX => 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ContentType::EXTENSION_DOC_PDF => 'application/pdf',
        ContentType::EXTENSION_DOC_TXT => 'text/plain',
        ContentType::EXTENSION_DOC_XLS => 'application/vnd.ms-excel',
        ContentType::EXTENSION_DOC_XLSX => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ContentType::EXTENSION_IMG_GIF => 'image/gif',
        ContentType::EXTENSION_IMG_JPG => 'image/jpg',
        ContentType::EXTENSION_IMG_PNG => 'image/png',
    ];

    private $extension;

    private function __construct(array $params)
    {
        $this->params = $params;
    }

    public static function buildFromExtension(string $extension) : ContentType
    {
        ContentType::assertExtensionIsValid($extension);

        return new ContentType([
            ContentType::PARAM_EXTENSION => $extension
        ]);
    }

    public function getContentType() : string
    {
        return static::$extensionToContentTypeMap[$this->getExtension()];
    }

    public static function assertExtensionIsValid($extension) : bool
    {
        $validExtensions = array_merge(
            static::$documentExtensionsMap,
            static::$imageExtensionsMap
        );

        if (!in_array($extension, $validExtensions)) {
            throw new \Exception(
                'Oops! Undefined extension `.' . $extension . '`.'
            );
        }

        return true;
    }

    public static function assertValidImageExtension(UploadedFile $file) : bool
    {
        return ContentType::assertRightExtension($file, ContentType::$imageExtensionsMap);
    }

    public static function assertValidDocumentExtension(UploadedFile $file) : bool
    {
        return ContentType::assertRightExtension($file, ContentType::$documentExtensionsMap);
    }

    public function getExtension() : string
    {
        $extensionParam = ContentType::PARAM_EXTENSION;

        return $this->params[$extensionParam];
    }

    private static function assertRightExtension(UploadedFile $file, array $validExtensions) : bool
    {
        $rawExtension = $file->getClientOriginalExtension();
        $extension = strtolower($rawExtension);
        if (!in_array($extension, $validExtensions)) {
            throw new \Exception(
                'Oops! Invalid ' . $extension . ' file format'
            );
        }

        return true;
    }
}
