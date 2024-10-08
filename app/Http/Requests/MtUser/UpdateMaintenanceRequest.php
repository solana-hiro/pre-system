<?php
namespace App\Http\Requests\MtUser;

use Illuminate\Foundation\Http\FormRequest;

/**
 * リクエストパラメータ
 */
class UpdateMaintenanceRequest extends FormRequest
{
    /**
     * jsonの形
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $rules = array();
        if ($this->has('cancel')) {
            $rules = [
                'cancel' => 'nullable',
            ];
        }
        if ($this->has('prev')) {
            $rules = [
                'prev' => 'nullable',
            ];
        }
        if ($this->has('next')) {
            $rules = [
                'next' => 'nullable',
            ];
        }
        if ($this->has('delete')) {
            $rules = [
                'delete' => 'nullable',
            ];
        }
        if ($this->has('copy')) {
            $rules = [
                'copy' => 'nullable',
            ];
        }
        if ($this->has('password_reset')) {
            $rules = [
                'password_reset' => 'nullable',
            ];
        }

        if ($this->has('update')) {
            $rules = [
                'update' => 'nullable',
                'user_cd' => 'required|numeric|max_digits:4',
                'password' => 'required|confirmed',
                'user_name' => 'required|max:20',
                'user_name_kana' => 'required|max:10',
                'mail' => 'nullable|email|max:256',
                'department_cd' => 'required|numeric|max_digits:4',
                'tab_item' => 'nullable',
                'sub_tab_item' => 'nullable',
                'update_id' => 'nullable'
            ];
            if($this->input('password_mode') === '0') {
                unset($rules['password']);
            }
        }
        return $rules;
    }

    public function attributes()
    {
        return [
            'user_cd' => __('validation.attributes.mt_users.user_cd'),
            'password' => __('validation.attributes.mt_users.password'),
            'user_name' => __('validation.attributes.mt_users.user_name'),
            'user_name_kana' => __('validation.attributes.mt_users.user_name_kana'),
            'mail' => __('validation.attributes.mt_users.mail'),
            'department_cd' => __('validation.attributes.mt_users.department_cd'),
        ];
    }
}
