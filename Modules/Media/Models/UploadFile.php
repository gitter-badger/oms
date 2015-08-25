<?php
namespace Modules\Media\Models;

/**
 * Upload.
 *
 * PHP Version 7.0
 *
 * @category   Modules
 * @package    Modules\Media
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  2013
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class UploadFile
{
    /**
     * Upload max size.
     *
     * @var int
     * @since 1.0.0
     */
    private $maxSize = 100000;

    /**
     * Allowed mime types.
     *
     * @var array
     * @since 1.0.0
     */
    private $allowedTypes = ['text/plain', 'text/csv'];

    /**
     * Output directory.
     *
     * @var string
     * @since 1.0.0
     */
    private $outputDir = '/Modules/Media/Files';

    /**
     * Output file name.
     *
     * @var string
     * @since 1.0.0
     */
    private $fileName = '';

    /**
     * Upload file to server.
     *
     * @param array $file File data ($_FILE)
     *
     * @return \Modules\Media\Models\UploadStatus
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function upload($file)
    {
        if (is_array($file['upfile']['error'])) {
            $files = $this->arrayFile($file);
        } else {
            $files = [$file];
        }

        foreach ($files as $f) {
            if (!isset($f['upfile']['error'])) {
                // TODO: handle wrong parameters
                return \Modules\Media\Models\UploadStatus::WRONG_PARAMETERS;
            }

            switch ($f['upfile']['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    // TODO: no file sent
                    return -2;
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    // too large
                    return -3;
                default:
                    return -4;
            }

            if ($f['upfile']['size'] > $this->maxSize) {
                // too large2
                return -5;
            }

            // TODO: do I need pecl fileinfo?
            if (false === $ext = array_search($f['upfile']['type'], $this->allowedTypes, true)) {
                // wrong file format
                return -6;
            }

            if (!$this->fileName || empty($this->fileName)) {
                $sha = sha1_file($f['upfile']['tmp_name']) . '.' . explode('.', $file['upfile']['name'])[1];

                if ($sha === false) {
                    return -7;
                }

                $this->fileName = $sha;
            }

            $path = realpath(__DIR__ . '/../../..' . $this->outputDir);

            if (!is_dir($path)) {
                \mkdir($path, '0655', true);
            }

            if (!move_uploaded_file($f['upfile']['tmp_name'], $path . '/' . $this->fileName)) {
                // couldn't move
                return -6;
            }
        }

        return 0;
    }

    public function arrayFile($file)
    {
        $files      = [];
        $file_count = count($file['name']);
        $file_keys  = array_keys($file);

        for ($i = 0; $i < $file_count; $i++) {
            foreach ($file_keys as $key) {
                $files[$i][$key] = $file[$key][$i];
            }
        }

        return $files;
    }

    /**
     * @return int
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getMaxSize()
    {
        return $this->maxSize;
    }

    /**
     * @param int $maxSize
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setMaxSize($maxSize)
    {
        $this->maxSize = $maxSize;
    }

    /**
     * @return array
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getAllowedTypes()
    {
        return $this->allowedTypes;
    }

    /**
     * @param array $allowedTypes
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setAllowedTypes($allowedTypes)
    {
        $this->allowedTypes = $allowedTypes;
    }

    /**
     * @param array $allowedTypes
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function addAllowedTypes($allowedTypes)
    {
        $this->allowedTypes[] = $allowedTypes;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getOutputDir()
    {
        return $this->outputDir;
    }

    /**
     * @param string $outputDir
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setOutputDir($outputDir)
    {
        $this->outputDir = $outputDir;
    }

    /**
     * @return string
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function getFileName()
    {
        return $this->fileName;
    }

    /**
     * @param string|false $fileName
     *
     * @since  1.0.0
     * @author Dennis Eichhorn <d.eichhorn@oms.com>
     */
    public function setFileName($fileName)
    {
        $this->fileName = $fileName;
    }
}
