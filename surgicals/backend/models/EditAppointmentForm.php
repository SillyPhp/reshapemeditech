<?php

namespace app\models;

use yii\base\Model;

class EditAppointmentForm extends Model
{
    public $prev_appointment;
    public $gender;
    public $email;


    public function formName()
    {
        return '';
    }
    public function rules()
    {
        return [
            [['gender'], 'required'],
            [['prev_appointment','email'], 'safe'],
        ];
    }
    public function update($id){
        $model = Appointment::findOne(['_id' => $id]);
        $model->previous_appointment = $this->prev_appointment;
        $model->email = $this->email;
        $model->gender = $this->gender;
        if($model->save()){
            return [
              'status' => 200,
              'title' => 'Success',
              'message' => 'Updated Successfully'
            ];
        } else {
            return [
              'status' => 201,
              'title' => 'Oops!!',
              'message' => 'Something went wrong..'
            ];
        }
    }
}