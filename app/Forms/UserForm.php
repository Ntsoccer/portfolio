<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use App\Rules\Birthday;
use App\User;

// $BIRTH_MONTH_CHOICES = [];
// foreach (range(1, 12) as $month) {
//     $BIRTH_MONTH_CHOICES[$month] = $month;
// }

// $BIRTH_DAY_CHOICES = [];
// foreach (range(1, 31) as $day) {
//     $BIRTH_DAY_CHOICES[$day] = $day;
// }

// define('BIRTH_MONTH_CHOICES', $BIRTH_MONTH_CHOICES);
// define('BIRTH_DAY_CHOICES', $BIRTH_DAY_CHOICES);


class UserForm extends Form
{
    public function buildForm()
    {
        // Add fields here...
        $this
        ->add('name','text',[
            'rules' => 'required',
            'label' => '名前'
        ]);

        // ->add('address','text',[
        //     'rules' => 'required',
        //     'label' => '住所'
        // ])

        // ->add('birth_month','select',[
        //     'rules' => 'required',
        //     'attr' => ['class' => 'form-control rounded-pill'],
        //     'choices' => BIRTH_MONTH_CHOICES,
        //     'empty_value' => '--'
        // ])

        // ->add('birth_day','select',[
        //     'rules' => 'required',
        //     'attr' => ['class' => 'form-control rounded-pill'],
        //     'choices' => BIRTH_DAY_CHOICES,
        //     'empty_value' => '--'
        // ]);

        // $this->addBirthYear();
        // $this->addPhoneNumber();
      }

    //   public function addBirthYear()
    // {
    //     $currentYear = date('Y');

    //     $birthYearChoices = [];

    //     foreach (range($currentYear, $currentYear - 100) as $year) {
    //         $birthYearChoices[$year] = $year;
    //     }

    //     $this
    //         ->add('birth_year', 'select', [
    //             'attr' => ['class' => 'form-control rounded-pill'],
    //             'rules' => ['required', new Birthday($this->request->all())],
    //             'choices' => $birthYearChoices,
    //             'empty_value' => '----',
    //         ]);
    // }

    // public function addPhoneNumber()
    // {
    //     $placeholder = ['090', '1234', '5678'];

    //     for ($i = 1; $i <= 3; $i += 1) {
    //         $this
    //             ->add("phone_number$i", 'number',[
    //                 'attr' => [
    //                     'class' => 'form-control rounded-pill',
    //                     'placeholder' => $placeholder[$i - 1]
    //                 ],
    //                 'rules' => 'required',
    //             ]);
    //     }

    // }

    public function getFieldValues($with_nulls = true)
    {
        $values = parent::getFieldValues($with_nulls);


        // $birthdayValues = [];

        // foreach (['year', 'month', 'day'] as $birth) {
        //     $birthdayValues[] = $values["birth_$birth"];
        // }

        // $values['birthday'] = sprintf("%04d-%02d-%02d", ...$birthdayValues);


        // $phoneNumberValues = [];

        // for ($i = 1; $i <= 3; $i += 1) {
        //     $phoneNumberValues[] = $values["phone_number$i"];
        // }

        // $values['phone_number'] = join('-', $phoneNumberValues);

        // for ($i = 1; $i <= 3; $i += 1) {
        //     unset($values["phone_number$i"]);
        // }


        return $values;


    }

    public function check()
    {
      $values = $this->getFieldValues();

      $user = new User();

      $user->name = $values['name'];
      // $user->address = $values['address'];
      // $user->phone_number = $values['phone_number'];
      // $user->birthday = $values['birthday'];
 
        return $user;

    }
}