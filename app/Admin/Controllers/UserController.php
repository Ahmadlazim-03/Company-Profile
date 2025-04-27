<?php

namespace App\Admin\Controllers;

use OpenAdmin\Admin\Controllers\AdminController;
use OpenAdmin\Admin\Form;
use OpenAdmin\Admin\Grid;
use OpenAdmin\Admin\Show;
use \App\Models\User;
use OpenAdmin\Admin\Admin;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email'));
        $grid->column('email_verified_at', __('Email verified at'));
        $grid->column('password', __('Password'));
        $grid->column('remember_token', __('Remember token'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email'));
        $show->field('email_verified_at', __('Email verified at'));
        $show->field('password', __('Password'));
        $show->field('remember_token', __('Remember token'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new User());

        $form->text('name', __('Name'));
        $form->text('email', __('Email'));
        $form->datetime('email_verified_at', __('Email verified at'))->default(date('Y-m-d H:i:s'));
        $form->password('password', __('New Password'))
        ->rules([
            'nullable',
            'min:8',
            'regex:/^(?=.*[A-Z])(?=.*\d)(?=.*\W).+$/'
        ], [
            'min'   => 'Minimum 8 character.',
            'regex' => 'There must be capital letters, numbers, and symbols.'
        ])
        ->attribute('id', 'password-field');
       Admin::script(<<<'JS'
       $(function() {
   
           var $field = $('#password-field');
           if (!$field.length) {
               $field = $('input[name="password"]');
           }

           function checkPassword(v) {
               $('#req-length').toggle(v.length < 8);
               $('#req-uppercase').toggle(!/[A-Z]/.test(v));
               $('#req-number').toggle(!/\d/.test(v));
               $('#req-symbol').toggle(!/\W/.test(v));
           }

           checkPassword($field.val() || '');

           $field.on('input', function() {
               checkPassword(this.value);
           });
       });
       JS
       );
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}

