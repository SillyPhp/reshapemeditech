<?php

namespace app\models\extented;

use app\models\AssignedCameraFeatures;
use app\models\AssignedCameras;
use app\models\AssignedColours;
use app\models\AssignedMediaFiles;
use app\models\AssignedSensors;
use app\models\AssignedWarrantyBenefits;
use app\models\BatteryDetails;
use app\models\Brands;
use app\models\CameraFeatures;
use app\models\Categories;
use app\models\ChargeTypes;
use app\models\Colours;
use app\models\ConnectivityDetails;
use app\models\DesignDetails;
use app\models\DisplayDetails;
use app\models\DisplayResolution;
use app\models\DisplayTypes;
use app\models\ExtraDetails;
use app\models\GeneralDetails;
use app\models\globals\SaveQueries;
use app\models\GpuModels;
use app\models\ItemDetails;
use app\models\MediaFiles;
use app\models\MultimediaDetails;
use app\models\NotchTypes;
use app\models\OperationSystemVersions;
use app\models\Processors;
use app\models\ProductVariants;
use app\models\Sensors;
use app\models\ServiceDetails;
use app\models\TechnicalDetails;
use app\models\WarrantyBenefits;
use Yii;
use yii\base\Security;
use yii\db\Exception;
use yii\helpers\ArrayHelper;

class Products extends \app\models\Products
{
    public $model_name;
    public $product_code;




    public $sim1_type;
    public $sim2_type;
    public $sim1_size;
    public $sim2_size;
    public $has_dual_sim;
    public $dimension_height;
    public $dimension_width;
    public $dimension_depth;
    public $dimension_weight;
    public $display_type;
    public $display_size;
    public $display_resolution;
    public $display_ppi;
    public $display_body_ratio;
    public $display_refresh_rate;
    public $has_touch;
    public $has_notch;
    public $memory_ram;
    public $memory_rom;
    public $price;
    public $sale_price;
    public $card_slot_upto;
    public $gprs;
    public $has_edge;
    public $has_volte;
    public $wifi;
    public $has_wifi_tethering;
    public $bluetooth;
    public $has_bluetooth_tethering;
    public $usb_type;
    public $usb_version;
    public $has_usb_tethering;
    public $battery_type;
    public $battery_size;
    public $battery_quality;
    public $has_fast_charge;
    public $charge_type;
    public $has_email;
    public $has_music;
    public $has_video;
    public $has_fm;
    public $has_doc_reader;
    public $operating_system;
    public $os_version;
    public $cpu;
    public $processor;
    public $processor_type;
    public $gpu;
    public $has_java;
    public $has_browser;
    public $camera_type;
    public $camera_size;
    public $camera_angle;
    public $aperture;
    public $autofocus;
    public $recording_quality;
    public $fps;
    public $camera_features;
    public $has_gps;
    public $gps_mfg;
    public $has_fingerprint;
    public $has_faceunlock;
    public $has_flash_light;
    public $has_nfc;
    public $headphone_jack_size;
    public $is_splash_resistant;
    public $extra_feature;
    public $sensors;
    public $warranty_period;
    public $warranty_benefits;
    public $warranty_type;
    public $return_period;
    public $replacement_period;
    public $image;
    public $colors;
    public $model_number;
    public $has_hybrid_sim_slot;
    public $is_otg_compatible;
    public $display_colors;
    public $scratch_card;
    public $warranty_card;
    public $tempered_glass;
    public $case_cover;
    public $sim_ejector;
    public $booklet;
    public $adapter;
    public $usb_cable;
    public $charger;
    public $headphone;
    public $has_dual_volte;
    public $core_details;
    public $release_date;
    public $blue;
    public $red;

    public $tb_image;
    public $tb_image_location;
    public $path;
    public $recursive_path;
    public $file;

    public $_flag;

    public function formName()
    {
        return '';
    }

    public function rules()
    {
        return [
//            [['brand_id', 'model_name', 'has_dual_sim', 'sim1_type',
//                'dimension_height', 'dimension_width', 'dimension_depth',
//                'usb_cable',
//                'headphone',
//                'charger',
//                'adapter',
//                'booklet',
//                'sim_ejector',
//                'case_cover',
//                'tempered_glass',
//                'scratch_card',
//                'warranty_card',
//                'dimension_weight',
//                'display_type',
//                'has_touch',
//                'display_size',
//                'display_resolution',
//                'has_notch',
//                'memory_ram',
//                'memory_rom',
//                'gprs',
//                'has_edge',
//                'has_volte',
//                'wifi',
//                'has_wifi_tethering',
//                'bluetooth',
//                'has_bluetooth_tethering',
//                'usb_type',
//                'usb_version',
//                'has_usb_tethering',
//                'battery_type',
//                'battery_size',
//                'battery_quality',
//                'has_fast_charge',
//                'has_email',
//                'has_music',
//                'has_video',
//                'has_fm',
//                'has_doc_reader',
//                'operating_system',
//                'processor',
//                'processor_type',
//                'gpu',
//                'has_java',
//                'has_browser',
//                'camera_type',
//                'camera_size',
//                'camera_angle',
//                'autofocus',
//                'recording_quality',
//                'fps',
//                'has_gps',
//                'gps_mfg',
//                'has_fingerprint',
//                'has_faceunlock',
//                'has_flash_light',
//                'has_nfc',
//                'is_splash_resistant',
//                'warranty_type',
//                'return_period',
//                'replacement_period',
//                'colors',
//                'has_hybrid_sim_slot',
//                'is_otg_compatible',
//                'has_dual_volte',
//                'price',
//                'sale_price',
//            ], 'required'],
            [['sim2_type', 'sim2_size', 'sim1_size', 'charge_type', 'camera_features', 'extra_feature',
                'sensors',
                'warranty_benefits',
                'image',
                'os_version',
                'model_number',
                'aperture',
                'card_slot_upto',
                'core_details',
                'release_date',
                'black',
                'blue',
                'red',
                'colors',
            ], 'safe'],
//            [['dimension_height', 'dimension_width',
//                'dimension_depth', 'dimension_weight',
//                'display_size',
////                'display_body_ratio',
//                'cpu',
//                'headphone_jack_size',
//            ], 'number', 'numberPattern' => '/^\d+(.\d{1,2})?$/'],
//            [['display_ppi', 'display_refresh_rate',
//                'battery_size',
//                'warranty_period',
//                'display_colors',
//            ], 'integer'],
//            [['has_usb_tethering'], 'boolean'],
        ];
    }

    public function add()
    {
        if (!$this->validate()) {
            $error = "";
            $errors = $this->getErrors();
            foreach ($errors as $key => $value) {
                $error .= implode('<br>', $value) . '<br>';
            }
            return [
                'status' => 201,
                'title' => 'Validation Error',
                'message' => $error
            ];
        };
        $transacion = Yii::$app->db->beginTransaction();
        try {
            $query = new SaveQueries();

            $model = new \app\models\Products();
            $model->enc_id = Yii::$app->security->generateRandomString(20);
            $model->category_id = Categories::findOne(['name' => 'Smart Phone'])['enc_id'];

            $itemModel = new ItemDetails();
            $itemModel->enc_id = Yii::$app->security->generateRandomString(10);
            $itemModel->headphone = $this->headphone;
            $itemModel->charger = $this->charger;
            $itemModel->usb_cable = $this->usb_cable;
            $itemModel->adapter = $this->adapter;
            $itemModel->booklet = $this->booklet;
            $itemModel->sim_ejector = $this->sim_ejector;
            $itemModel->case_cover = $this->case_cover;
            $itemModel->tempered_glass = $this->tempered_glass;
            $itemModel->scratch_card = $this->scratch_card;
            $itemModel->warranty_card = $this->warranty_card;
            if (!$itemModel->save() || !$itemModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'itemModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->item_id = $itemModel->enc_id;

            $chkBrand = Brands::findOne(['name' => $this->brand_id]);
            if ($chkBrand) {
                $model->brand_id = $chkBrand->enc_id;
            } else {
                $brandModel = new Brands();
                $brandModel->enc_id = Yii::$app->security->generateRandomString(10);
                $brandModel->name = $this->brand_id;
                $brandModel->created_by = '21200885095';
                if (!$brandModel->save() || !$brandModel->validate()) {
                    $transacion->rollBack();
                    return [
                        'status' => 201,
                        'title' => 'brandModel Error',
                        'message' => 'Something went wrong..',
                    ];
                }
                $model->brand_id = $brandModel->enc_id;
            }
            $model->model_name = $this->model_name;
            if ($this->model_number) {
                $model->model_number = $this->model_number;
                $slug = str_replace(' ', '-', $this->model_name) . '_' . $this->model_number;
            } else {
                $slug = str_replace(' ', '-', $this->model_name);
            }
            $model->slug = $slug;
            $model->product_code = 'nts' . Yii::$app->security->generateRandomKey(9);
            if ($this->release_date) {
                $model->release_date = $this->release_date;
            }
            $generalModel = new GeneralDetails();
            $generalModel->enc_id = Yii::$app->security->generateRandomString(10);
            if ($this->sim1_type && $this->sim2_type) {
                $simType = $this->sim1_type . '+' . $this->sim2_type;
            } else {
                $simType = $this->sim1_type;
            }
            $generalModel->sim_type = $simType;
            if ($this->sim1_size && $this->sim1_size) {
                $simSize = $this->sim1_size . '+' . $this->sim1_size;
            } else {
                $simSize = $this->sim1_size;
            }
            $generalModel->sim_size = $simSize;
            $generalModel->has_dual_sim = $this->has_dual_sim;
            $generalModel->has_dual_volte = $this->has_dual_volte;
            $generalModel->has_hybrid_sim_slot = $this->has_hybrid_sim_slot;
            $generalModel->card_slot_upto = $this->card_slot_upto;
            if (!$generalModel->save() || !$generalModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'generalModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->general_detail_id = $generalModel->enc_id;

            $designModel = new DesignDetails();
            $designModel->enc_id = Yii::$app->security->generateRandomString(10);
            $designModel->dimension_height = $this->dimension_height;
            $designModel->dimension_widht = $this->dimension_width;
            $designModel->dimensions_depth = $this->dimension_depth;
            if ($this->dimension_weight) {
                $designModel->weight = $this->dimension_weight;
            }
            if (!$designModel->save() || !$designModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'designModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->design_detail_id = $designModel->enc_id;

            $displayModel = new DisplayDetails();
            $displayModel->enc_id = Yii::$app->security->generateRandomString(10);
            $displayModel->display_type_id = $this->display_type;
            $displayModel->display_resolution_id = $this->display_resolution;

            if ($this->has_notch != 'No') {
                $displayModel->has_notch = 1;
                $chkNotchType = NotchTypes::findOne(['name' => $this->has_notch]);
                if ($chkNotchType) {
                    $displayModel->notch_type_id = $chkNotchType->enc_id;
                } else {
                    $notchTypeModel = new NotchTypes();
                    $notchTypeModel->enc_id = Yii::$app->security->generateRandomString(10);
                    $notchTypeModel->name = $this->has_notch;
                    $notchTypeModel->created_by = '21200885095';
                    if (!$notchTypeModel->save() || !$notchTypeModel->validate()) {
                        $transacion->rollBack();
                        return [
                            'status' => 201,
                            'title' => 'notchTypeModel Error',
                            'message' => 'Something went wrong..',
                        ];
                    }
                    $displayModel->notch_type_id = $notchTypeModel->enc_id;
                }
            } else {
                $displayModel->has_notch = 0;
            }
            if ($this->display_colors) {
                $displayModel->display_colors = $this->display_colors;
            }
            $displayModel->has_touch = $this->has_touch;
            $displayModel->size = $this->display_size;
            $displayModel->ppi = $this->display_ppi;
            if ($this->display_body_ratio) {
                $displayModel->screen_to_body_ratio = $this->display_body_ratio;
            }
            if ($this->display_refresh_rate) {
                $displayModel->refresh_rate = $this->display_refresh_rate;
            }
            if (!$displayModel->save() || !$displayModel->validate()) {
                $transacion->rollBack();
                $errors = $displayModel->getErrors();
                $error = "";
                foreach ($errors as $key => $value) {
                    $error .= implode('<br>', $value) . '<br>';
                }
                return [
                    'status' => 201,
                    'title' => 'displayModel Error',
                    'message' => $error,
                ];
            }
            $model->display_detail_id = $displayModel->enc_id;

            $connectivityModel = new ConnectivityDetails();
            $connectivityModel->enc_id = Yii::$app->security->generateRandomString(10);
            $connectivityModel->gprs = $this->gprs;
            $connectivityModel->has_edge = $this->has_edge;
            $connectivityModel->has_volte = $this->has_volte;
            $connectivityModel->wifi = $this->wifi;
            $connectivityModel->bluetooth = $this->bluetooth;
            $connectivityModel->usb_type = $this->usb_type;
            $connectivityModel->usb_version = $this->usb_version;
            $connectivityModel->has_usb_tethering = $this->has_usb_tethering;
            $connectivityModel->has_wifi_tethering = $this->has_wifi_tethering;
            $connectivityModel->has_bluetooth_tethering = $this->has_bluetooth_tethering;
            if (!$connectivityModel->save() || !$connectivityModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'connectivityModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->connectivity_detail_id = $connectivityModel->enc_id;

            $extraModel = new ExtraDetails();
            $extraModel->enc_id = Yii::$app->security->generateRandomString(10);
            $extraModel->has_gps = $this->has_gps;
            $extraModel->gps_mfg = $this->gps_mfg;
            $extraModel->has_fingerprint = $this->has_fingerprint;
            $extraModel->has_faceunlock = $this->has_faceunlock;
            $extraModel->has_flash_light = $this->has_flash_light;
            $extraModel->has_nfc = $this->has_nfc;
            $extraModel->headphone_jack_size = $this->headphone_jack_size;
            $extraModel->is_splash_resistant = $this->is_splash_resistant;
            if ($this->extra_feature) {
                $extraModel->extra_feature = $this->extra_feature;
            }
            if (!$extraModel->save() || !$extraModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'extraModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->extra_detail_id = $extraModel->enc_id;

            $technicalModel = new TechnicalDetails();
            $technicalModel->enc_id = Yii::$app->security->generateRandomString(10);
            $technicalModel->operating_system = $this->operating_system;
            $technicalModel->os_version_id = $this->os_version;
            $technicalModel->processor_id = $this->processor;
            $technicalModel->processor_type = $this->processor_type;
            if ($this->core_details) {
                $technicalModel->core_details = $this->core_details;
            }
            $technicalModel->cpu = $this->cpu;
            $chkGpu = GpuModels::findOne(['name' => $this->gpu]);
            if ($chkGpu) {
                $technicalModel->gpu_id = $chkGpu->enc_id;
            } else {
                $gpuModel = new GpuModels();
                $gpuModel->enc_id = Yii::$app->security->generateRandomString(10);
                $gpuModel->name = $this->gpu;
                $gpuModel->created_by = '21200885095';
                if (!$gpuModel->save() || !$gpuModel->validate()) {
                    $transacion->rollBack();
                    return [
                        'status' => 201,
                        'title' => 'gpuModel Error',
                        'message' => 'Something went wrong..',
                    ];
                }
                $technicalModel->gpu_id = $gpuModel->enc_id;
            }
            $technicalModel->has_java = $this->has_java;
            $technicalModel->has_browser = $this->has_browser;
            $technicalModel->is_otg_compatible = $this->is_otg_compatible;
            if (!$technicalModel->save() || !$technicalModel->validate()) {
                $transacion->rollBack();
                $errors = $technicalModel->getErrors();
                $error = "";
                foreach ($errors as $key => $value) {
                    $error .= implode('<br>', $value) . '<br>';
                }
                return [
                    'status' => 201,
                    'title' => 'technicalModel Error',
                    'message' => $error,
                ];
            }
            $model->technical_detail_id = $technicalModel->enc_id;

            $multimediaModel = new MultimediaDetails();
            $multimediaModel->enc_id = Yii::$app->security->generateRandomString(10);
            $multimediaModel->has_email = $this->has_email;
            $multimediaModel->has_music = $this->has_music;
            $multimediaModel->has_video = $this->has_video;
            $multimediaModel->has_fm = $this->has_fm;
            $multimediaModel->has_doc_reader = $this->has_doc_reader;
            if (!$multimediaModel->save() || !$multimediaModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'multimediaModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->multimedia_detail_id = $multimediaModel->enc_id;

            $batteryModel = new BatteryDetails();
            $batteryModel->enc_id = Yii::$app->security->generateRandomString(10);
            $batteryModel->type = $this->battery_type;
            $batteryModel->size = $this->battery_size;
            $batteryModel->quality = $this->battery_quality;
            $batteryModel->has_fast_charge = $this->has_fast_charge;
            $batteryModel->charge_type_id = $this->charge_type;
            if (!$batteryModel->save() || !$batteryModel->validate()) {
                $transacion->rollBack();
                return [
                    'status' => 201,
                    'title' => 'batteryModel Error',
                    'message' => 'Something went wrong..',
                ];
            }
            $model->battery_detail_id = $batteryModel->enc_id;

            $serviceModel = new ServiceDetails();
            $serviceModel->enc_id = Yii::$app->security->generateRandomString(10);
            if ($this->warranty_period) {
                $serviceModel->warranty_period = $this->warranty_period;
            }
            if ($this->warranty_type) {
                $serviceModel->warranty_type = $this->warranty_type;
            }
            if ($this->replacement_period) {
                $serviceModel->replacement_period = $this->replacement_period;
            }
            if ($this->return_period) {
                $serviceModel->return_period = $this->return_period;
            }
            if (!$serviceModel->save() || !$serviceModel->validate()) {
                $transacion->rollBack();
                $errors = $serviceModel->getErrors();
                $error = "";
                foreach ($errors as $key => $value) {
                    $error .= implode('<br>', $value) . '<br>';
                }
                return [
                    'status' => 201,
                    'title' => 'serviceModel Error',
                    'message' => $error,
                ];
            }
            $model->service_detail_id = $serviceModel->enc_id;
            $model->created_by = '21200885095';
            if (!$model->save() || !$model->validate()) {
                $transacion->rollBack();
                $errors = $model->getErrors();
                $error = "";
                foreach ($errors as $key => $value) {
                    $error .= implode('<br>', $value) . '<br>';
                }
                return [
                    'status' => 201,
                    'title' => 'model Error',
                    'message' => $error,
                ];
            }

            foreach ($this->camera_type as $i => $v) {
                $assignedCameraModel = new AssignedCameras();
                $assignedCameraModel->enc_id = Yii::$app->security->generateRandomString(10);
                $assignedCameraModel->product_id = $model->enc_id;
                $assignedCameraModel->aperture = $this->aperture[$i];
                $assignedCameraModel->size = $this->camera_size[$i];
                $assignedCameraModel->type = $v;
                $assignedCameraModel->angle = $this->camera_angle[$i];
                $assignedCameraModel->is_autofocus = $this->autofocus[$i];
                $assignedCameraModel->recording_quality = $this->recording_quality[$i];
                $assignedCameraModel->fps = $this->fps[$i];
                $assignedCameraModel->created_by = '21200885095';
                if (!$assignedCameraModel->save() || !$assignedCameraModel->validate()) {
                    $transacion->rollBack();
                    $errors = $assignedCameraModel->getErrors();
                    $error = "";
                    foreach ($errors as $key => $value) {
                        $error .= implode('<br>', $value) . '<br>';
                    }
                    return [
                        'status' => 201,
                        'title' => 'assignedCameraModel Error',
                        'message' => $error,
                    ];
                }
            }

            if ($this->camera_features) {
                $features = explode(',', $this->camera_features);
                foreach ($features as $feature) {
                    $assignedCameraFeatureModel = new AssignedCameraFeatures();
                    $assignedCameraFeatureModel->enc_id = Yii::$app->security->generateRandomString(10);
                    $assignedCameraFeatureModel->product_id = $model->enc_id;
                    $chkCameraFeature = CameraFeatures::findOne(['name' => $feature]);
                    if ($chkCameraFeature) {
                        $assignedCameraFeatureModel->feature_id = $chkCameraFeature->enc_id;
                    } else {
                        $cameraFeaturesModel = new CameraFeatures();
                        $cameraFeaturesModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $cameraFeaturesModel->name = $feature;
                        $cameraFeaturesModel->created_by = '21200885095';
                        if (!$cameraFeaturesModel->save() || !$cameraFeaturesModel->validate()) {
                            $transacion->rollBack();
                            $errors = $cameraFeaturesModel->getErrors();
                            $error = "";
                            foreach ($errors as $key => $value) {
                                $error .= implode('<br>', $value) . '<br>';
                            }
                            return [
                                'status' => 201,
                                'title' => 'cameraFeaturesModel Error',
                                'message' => $error,
                            ];
                        }
                        $assignedCameraFeatureModel->feature_id = $cameraFeaturesModel->enc_id;
                    }
                    $assignedCameraFeatureModel->created_by = '21200885095';
                    if (!$assignedCameraFeatureModel->save() || !$assignedCameraFeatureModel->validate()) {
                        $transacion->rollBack();
                        $errors = $assignedCameraFeatureModel->getErrors();
                        $error = "";
                        foreach ($errors as $key => $value) {
                            $error .= implode('<br>', $value) . '<br>';
                        }
                        return [
                            'status' => 201,
                            'title' => 'assignedCameraFeatureModel Error',
                            'message' => $error,
                        ];
                    }
                }
            }

            if ($this->image && $this->colors) {
                $colors = explode(',', $this->colors);
                foreach ($colors as $color) {
                    $assignedColourModel = new AssignedColours();
                    $assignedColourModel->enc_id = Yii::$app->security->generateRandomString(10);
                    $assignedColourModel->product_id = $model->enc_id;
                    $chkColour = Colours::findOne(['name' => $color]);
                    if ($chkColour) {
                        $assignedColourModel->colour_id = $chkColour->enc_id;
                    } else {
                        $colourModel = new Colours();
                        $colourModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $colourModel->name = $color;
                        $colourModel->created_by = '21200885095';
                        if (!$colourModel->save() || !$colourModel->validate()) {
                            $transacion->rollBack();
                            $errors = $colourModel->getErrors();
                            $error = "";
                            foreach ($errors as $key => $value) {
                                $error .= implode('<br>', $value) . '<br>';
                            }
                            return [
                                'status' => 201,
                                'title' => 'colourModel Error',
                                'message' => $error,
                            ];
                        }
                        $assignedColourModel->colour_id = $colourModel->enc_id;
                    }
                    $assignedColourModel->created_by = '21200885095';
                    if (!$assignedColourModel->save() || !$assignedColourModel->validate()) {
                        $transacion->rollBack();
                        $errors = $assignedColourModel->getErrors();
                        $error = "";
                        foreach ($errors as $key => $value) {
                            $error .= implode('<br>', $value) . '<br>';
                        }
                        return [
                            'status' => 201,
                            'title' => 'assignedColourModel Error',
                            'message' => $error,
                        ];
                    }
                    $string = strtolower(trim($color));
                    $c = str_replace(" ","_", $string);
                    foreach ($this->image[$c] as $ix => $img) {
                        $mediaFileModel = new MediaFiles();
                        $mediaFileModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $mediaFileModel->file_name = $img->name;
                        $this->path = Yii::$app->params->upload_directories->product->image_path;
                        $this->recursive_path = Yii::$app->params->nagpal_telestore->upload_directories->product->image_path;
                        $this->tb_image = 'enc_name';
                        $this->file = $img;
                        $this->_flag = $query->saveFile($mediaFileModel, $this, $transacion, $model->enc_id);
                        if (!$this->_flag) {
                            $transacion->rollBack();
                            return [
                                'status' => 201,
                                'title' => 'Image Error',
                                'message' => 'Image Saving problem...'
                            ];
                        }
                        $mediaFileModel->created_by = '21200885095';
                        if (!$mediaFileModel->save() || !$mediaFileModel->validate()) {
                            $transacion->rollBack();
                            return [
                                'status' => 201,
                                'title' => 'mediaFileModel Error',
                                'message' => 'Something went wrong..',
                            ];
                        }
                        $assignedMediaModel = new AssignedMediaFiles();
                        $assignedMediaModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $assignedMediaModel->product_id = $model->enc_id;
                        $assignedMediaModel->media_file_id = $mediaFileModel->enc_id;
                        $assignedMediaModel->assigned_colour_id = $assignedColourModel->enc_id;
                        $assignedMediaModel->created_by = '21200885095';
                        if (!$assignedMediaModel->save() || !$assignedMediaModel->validate()) {
                            $transacion->rollBack();
                            return [
                                'status' => 201,
                                'title' => 'assignedMediaModel Error',
                                'message' => 'Something went wrong..',
                            ];
                        }

                    }
                }
            }

            if($this->price || $this->sale_price){
                $productVariantModel = new ProductVariants();
                $productVariantModel->enc_id = Yii::$app->security->generateRandomString(10);
                $productVariantModel->product_id = $model->enc_id;
                $productVariantModel->price = $this->price;
                if($this->sale_price){
                    $productVariantModel->sale_price = $this->sale_price;
                }
                $productVariantModel->ram = $this->memory_ram;
                $productVariantModel->rom = $this->memory_rom;
                if (!$productVariantModel->save() || !$productVariantModel->validate()) {
                    $transacion->rollBack();
                    return [
                        'status' => 201,
                        'title' => 'productVariantModel Error',
                        'message' => 'Something went wrong..',
                    ];
                }
            }

            if ($this->sensors) {
                $sensors = explode(',', $this->sensors);
                foreach ($sensors as $sensor) {
                    $assignedSensorModel = new AssignedSensors();
                    $assignedSensorModel->enc_id = Yii::$app->security->generateRandomString(10);
                    $assignedSensorModel->product_id = $model->enc_id;
                    $chkSensor = Sensors::findOne(['name' => $sensor]);
                    if ($chkSensor) {
                        $assignedSensorModel->sensor_id = $chkSensor->enc_id;
                    } else {
                        $sensorModel = new Sensors();
                        $sensorModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $sensorModel->name = $sensor;
                        $sensorModel->created_by = '21200885095';
                        if (!$sensorModel->save() || !$sensorModel->validate()) {
                            $transacion->rollBack();
                            $errors = $sensorModel->getErrors();
                            $error = "";
                            foreach ($errors as $key => $value) {
                                $error .= implode('<br>', $value) . '<br>';
                            }
                            return [
                                'status' => 201,
                                'title' => 'sensorModel Error',
                                'message' => $error,
                            ];
                        }
                        $assignedSensorModel->sensor_id = $sensorModel->enc_id;
                    }
                    $assignedSensorModel->created_by = '21200885095';
                    if (!$assignedSensorModel->save() || !$assignedSensorModel->validate()) {
                        $transacion->rollBack();
                        $errors = $assignedSensorModel->getErrors();
                        $error = "";
                        foreach ($errors as $key => $value) {
                            $error .= implode('<br>', $value) . '<br>';
                        }
                        return [
                            'status' => 201,
                            'title' => 'assignedSensorModel Error',
                            'message' => $error,
                        ];
                    }
                }
            }

            if ($this->warranty_benefits) {
                $benefits = explode(',', $this->warranty_benefits);
                foreach ($benefits as $benefit) {
                    $assignedWarrantyBenefitModel = new AssignedWarrantyBenefits();
                    $assignedWarrantyBenefitModel->enc_id = Yii::$app->security->generateRandomString(10);
                    $assignedWarrantyBenefitModel->product_id = $model->enc_id;
                    $chkWarrantyBenefit = WarrantyBenefits::findOne(['name' => $benefit]);
                    if ($chkWarrantyBenefit) {
                        $assignedWarrantyBenefitModel->warranty_benefit_id = $chkWarrantyBenefit->enc_id;
                    } else {
                        $warrantyBenefitModel = new WarrantyBenefits();
                        $warrantyBenefitModel->enc_id = Yii::$app->security->generateRandomString(10);
                        $warrantyBenefitModel->name = $benefit;
                        $warrantyBenefitModel->created_by = '21200885095';
                        if (!$warrantyBenefitModel->save() || !$warrantyBenefitModel->validate()) {
                            $transacion->rollBack();
                            $errors = $warrantyBenefitModel->getErrors();
                            $error = "";
                            foreach ($errors as $key => $value) {
                                $error .= implode('<br>', $value) . '<br>';
                            }
                            return [
                                'status' => 201,
                                'title' => 'warrantyBenefitModel Error',
                                'message' => $error,
                            ];
                        }
                        $assignedWarrantyBenefitModel->warranty_benefit_id = $warrantyBenefitModel->enc_id;
                    }
                    $assignedWarrantyBenefitModel->created_by = '21200885095';
                    if (!$assignedWarrantyBenefitModel->save() || !$assignedWarrantyBenefitModel->validate()) {
                        $transacion->rollBack();
                        $errors = $assignedWarrantyBenefitModel->getErrors();
                        $error = "";
                        foreach ($errors as $key => $value) {
                            $error .= implode('<br>', $value) . '<br>';
                        }
                        return [
                            'status' => 201,
                            'title' => '$assignedWarrantyBenefitModel Error',
                            'message' => $error,
                        ];
                    }
                }
            }

            $transacion->commit();
            return [
                'status' => 200,
                'title' => 'Success',
                'message' => 'Data added successfully..',
            ];
        } catch (Exception $e) {
            $transacion->rollback();
            return $e->getMessage();
        }
    }

    public function getDisplayTypes()
    {
        $list = DisplayTypes::find()
            ->asArray()
            ->all();
        $list = ArrayHelper::map($list, 'enc_id', 'name');
        return $list;
    }

    public function getDisplayResolutions()
    {
        $list = DisplayResolution::find()
            ->select(['enc_id', 'CONCAT(height,"x",width," pixels | ",standard) name'])
            ->orderBy(['height' => SORT_ASC])
            ->asArray()
            ->all();
        $list = ArrayHelper::map($list, 'enc_id', 'name');
        return $list;
    }

    public function getProcessorsList()
    {
        $list = Processors::find()
            ->select(['enc_id', 'name'])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $list = ArrayHelper::map($list, 'enc_id', 'name');
        return $list;
    }

    public function getGpuModelsList()
    {
        $list = GpuModels::find()
            ->select(['enc_id', 'name'])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $list = ArrayHelper::map($list, 'name', 'name');
        return $list;
    }

    public function getOsVersionsList($type)
    {
        $list = OperationSystemVersions::find()
            ->select(['enc_id', 'CONCAT(value," | ",name) as name'])
            ->where(['assigned_to' => $type])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $list = ArrayHelper::map($list, 'enc_id', 'name');
        return $list;
    }

    public function getChargeTypesList()
    {
        $list = ChargeTypes::find()
            ->select(['enc_id', 'name'])
            ->orderBy(['name' => SORT_ASC])
            ->asArray()
            ->all();
        $list = ArrayHelper::map($list, 'enc_id', 'name');
        return $list;
    }
}
