<?php

namespace frontend\models;

use common\models\Contact;
use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $email;
    public $subject;
    public $body;
    public $verifyCode;
    public $dealer;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            [['dealer'], 'safe'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
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
    public function FormName()
    {
        return '';
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
        $model = new Contact();
        $model->name = $this->name;
        $model->email = $this->email;
        $model->subject = $this->subject;
        $model->body = $this->body;
        if($this->dealer == 'Yes'){
            $model->dealer = 1;
        } else {
            $model->dealer = 0;
        }
        $model->created_at = date('Y-m-d H:i:s');
        if($model->save()){
            return [
              'status' => 200,
              'title' => 'success',
              'message' => 'Request Submitted'
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
