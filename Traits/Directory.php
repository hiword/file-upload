<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 2016/9/18
 * Time: 17:30
 */

namespace Simon\FileUpload\Traits;


trait Directory
{

    protected $hashDirLayer = 2;

    /**
     * 设置hash目录
     * @param string $name
     * @param integer $hashDirLayer
     * @author simon
     */
    public function getHashDir(string $name) : string
    {
        $dirs = '';

        if ($this->hashDirLayer > 0)
        {
            $name = sha1($name);
            $length = strlen($name);

            for($i=0;$i<$length;$i++)
            {
                if ($i+1 > $this->hashDirLayer)
                {
                    break;
                }
                $dirs .= substr($name, $i,1).'/';
            }
        }

        return $dirs;
    }

    /**
     * 创建目录
     * @param string $dir
     * @param number $mode
     * @return boolean
     */
    public function mkDir(string $dir, int $mode = 0755) : bool
    {
        if (is_dir($dir) || @mkdir($dir, $mode)) return true;
        if (!@$this->mkDir(dirname($dir), $mode)) return false;
        return mkdir($dir, $mode);
    }

}