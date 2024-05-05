<?php

namespace app\models;

use app\models\globals\SaveQueries;
use Yii;
use yii\base\Security;
use yii\base\Model;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class AddProductForm extends Model
{
    public $name;
    public $category;
    public $tax_present;
    public $short_desc;
    public $product_combination_titles;
    public $product_combination_purchase_price;
    public $product_combination_sell_price;
    public $product_labels;
    public $product_value;
    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
            [['name', 'category','tax_present','product_combination_titles','product_combination_purchase_price','product_combination_sell_price'], 'required'],
            [['short_desc','product_labels','product_value'], 'safe'],
            [['name','product_combination_titles'], 'string', 'max' => 100],
            [['product_combination_purchase_price', 'product_combination_sell_price','tax_present'], 'number'],
        ];
    }

    public function save(){
        $transaction = Yii::$app->db->beginTransaction();
        try {
            $tax = TaxPresets::findOne(['short_description' => $this->tax_present]);
            if (!$tax) {
                $tax = new TaxPresets();
                $tax->_uid = Yii::$app->security->generateRandomString(18);
                $tax->created_at = date('Y-m-d H:i:s');
                $tax->status = 1;
                $tax->title = 'GST ' . $this->tax_present . ' %';
                $tax->short_description = $this->tax_present;
                if (!$tax->save()) {
                    $this->_flag = false;
                    $transaction->rollBack();
                    return [
                        'status' => 201,
                        'title' => 'Oops!!',
                        'message' => 'Something went wrong'
                    ];
                }
            }
            $product = new Products();
            $product->_uid = Yii::$app->security->generateRandomString(18);
            $product->created_at = date('Y-m-d H:i:s');
            $product->eo_uid = date('Y-m-d H:i:s');
            $product->name = $this->name;
            $product->status = 1;
            $product->short_description = $this->short_desc;
            $product->categories__id = $this->category;
            $product->tax_presets__id = $tax->_id;
            if (!$product->save()) {
                $this->_flag = false;
                $transaction->rollBack();
                return [
                    'status' => 201,
                    'title' => 'Oops!!',
                    'message' => $product->getErrors()
                ];
            } else {
                $this->_flag = true;
            }

            if ($this->product_combination_titles && $this->product_combination_purchase_price) {
                for ($i = 0; $i < count($this->product_combination_titles); $i++) {
                    $productCombinations = new ProductCombinations();
                    $productCombinations->_uid = Yii::$app->security->generateRandomString(18);
                    $productCombinations->created_at = date('Y-m-d H:i:s');
                    $productCombinations->products__id = $product->_id;
                    $productCombinations->product_id = Yii::$app->security->generateRandomString(5);
                    $productCombinations->title = $this->product_combination_titles[$i];
                    $productCombinations->price = $this->product_combination_purchase_price[$i];
                    $productCombinations->sale_price = $this->product_combination_sell_price[$i];
                    $productCombinations->status = 1;
                    if (!$productCombinations->save()) {
                        $this->_flag = false;
                        $transaction->rollBack();
                        return [
                            'status' => 201,
                            'title' => 'Oops!!',
                            'message' => $productCombinations->getErrors()
                        ];
                    } else {
                        $this->_flag = true;
                    }
                }
            }
            if($this->_flag){
                $transaction->commit();
                return [
                  'status' => 200,
                    'title' => 'Success',
                    'message' => 'Add Product successfully'
                ];
            } else {
                return [
                  'status' => 201,
                  'title' => 'Oops!!',
                  'message' => 'Something went wrong..'
                ];
            }
        } catch (\Exception $e) {
            $transaction->rollBack();
            return [
              'status' => 201,
              'title' => 'Oops!!',
              'message' => $e->getMessage()
            ];
        }
    }
}