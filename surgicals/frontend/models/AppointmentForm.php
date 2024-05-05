<?php

namespace frontend\models;

use common\models\Appointment;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class AppointmentForm extends Model
{
    public $name;
    public $gender;
    public $email;
    public $phone_no;
    public $prev_appointment;
    public $description;
    public $date;
    public $verifyCode;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'phone_no','gender', 'prev_appointment','date'], 'required'],
            [['email','description'], 'safe'],
            ['email', 'email'],
            ['verifyCode', 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     *
     * @param string $email the target email address
     * @return bool whether the email was sent
     */
    public function sendEmail($email)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setReplyTo([$this->email => $this->name])
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
    public function emails(){
        return Yii::$app->mailer->compose()
            ->setFrom('noreply@themagicalvastu.com')
            ->setTo($this->email)
            ->setSubject($this->subject)
            ->setTextBody($this->body)
            ->send();
    }
    public function save(){
        $model = new Appointment();
        $model->uid = Yii::$app->security->generateRandomString(15);
        $model->name = $this->name;
        $model->email = $this->email;
        $model->phone = $this->phone_no;
        $model->gender = $this->gender;
        $model->previous_appointment = $this->prev_appointment;
        $model->description = $this->description;
        $model->date = $this->date;
        $model->created_at = date('Y-m-d H:i:s');
        if($model->save()){
            return [
                'status' => 200,
                'title' => 'success',
                'message' => 'Appointment Request Submitted'
            ];
        } else {
            return [
                'status' => 201,
                'title' => 'errors',
                'message' => 'something went wrong...'
            ];
        }
    }
}
