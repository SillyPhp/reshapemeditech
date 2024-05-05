<?php

namespace backend\models\globals;

use Yii;
use yii\base\Model;

class SaveQueries extends Model
{
    // image save function
    public function saveFile($object, $data, $transaction, $loc)
    {
        $image = $data->tb_image;
        $object->$image = Yii::$app->security->generateRandomString(15) . '.' . $data->file->extension;
        if ($loc) {
            $base_path = $data->path . $loc;
            $destination_path = preg_filter('/$/', $loc, $data->recursive_path);
            if (!is_dir($base_path)) {
                if (!mkdir($base_path, 0755, true)) {
                    return false;
                }
            }
            $source_path = $base_path . '/' . $object->$image;
            if (!$data->file->saveAs($source_path)) {
                if (!empty($transaction)) {
                    $transaction->rollBack();
                }
                return false;
            }
            foreach ($destination_path as $d_path) {
                if (!self::recurseCopy($source_path, $d_path, $object->$image)) {
                    if (!empty($transaction)) {
                        $transaction->rollBack();
                    }
                    return false;
                }
            }
            return true;
        } else {
            return false;
        }
    }

    public function saveBase64File($object, $data, $transaction, $loc)
    {
        $image = $data->tb_image;
        $image_parts = explode(";base64,", $data->file);
        $image_base64 = base64_decode($image_parts[1]);
        $base_path = $data->path . $loc;
        $encrypted_string = Yii::$app->getSecurity()->generateRandomString(15);
        if (substr($encrypted_string, -1) == '.') {
            $encrypted_string = substr($encrypted_string, 0, -1);
        }
        $object->$image = $encrypted_string . '.png';
        if (!is_dir($base_path)) {
            if (!mkdir($base_path, 0755, true)) {
                return false;
            }
        }
        $source_path = $base_path . DIRECTORY_SEPARATOR . $object->$image;
        $destinationPath = $data->recursive_path[0] . $loc;
        if (file_put_contents($source_path, $image_base64) && self::recurseCopy($source_path, $destinationPath, $object->$image)) {
            return true;
        } else {
            if (!empty($transaction)) {
                $transaction->rollBack();
            }
            return false;
        }
    }

    public function saveBase64FileDirect($path, $recursive_path, $tb_image, $file, $transaction, $loc)
    {
        $image = $tb_image;
        $image_parts = explode(";base64,", $file);
        $image_base64 = base64_decode($image_parts[1]);
        $base_path = $path . $loc;
        $encrypted_string = Yii::$app->getSecurity()->generateRandomString(15);
        if (substr($encrypted_string, -1) == '.') {
            $encrypted_string = substr($encrypted_string, 0, -1);
        }
        $enc_image = $encrypted_string . '.png';
        if (!is_dir($base_path)) {
            if (!mkdir($base_path, 0755, true)) {
                return false;
            }
        }
        $source_path = $base_path . DIRECTORY_SEPARATOR . $enc_image;
        $destinationPath = $recursive_path[0] . $loc;
        if (file_put_contents($source_path, $image_base64) && self::recurseCopy($source_path, $destinationPath, $enc_image)) {
            return [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Image Uploaded',
                'uid' => $loc,
                'enc_image' => $enc_image
            ];
        } else {
            if (!empty($transaction)) {
                $transaction->rollBack();
            }
            return [
                'status' => 201,
                'title' => 'Oops',
                'message' => 'Image Not Uploaded',
                'uid' => $loc,
                'enc_image' => $enc_image
            ];
        }
    }

    public function recurseCopy($source, $destination, $file)
    {
        if (!is_dir($destination)) {
            if (!mkdir($destination, 0755, true)) {
                return false;
            }
        }
        if (copy($source, $destination . DIRECTORY_SEPARATOR . $file)) {
            return true;
        }

        return false;
    }

}
