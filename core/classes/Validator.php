<?php


class Validator
{
    public $errors = [];
    private $rule_list = ['required', 'min', 'max', 'num'];
    private $message = [
        'required' => 'Поле :field: не может быть пустым',
        'min' => 'Поле :field: должно быть больше или равным :v:',
        'max' => 'Поле :field: должно быть меньше или равным :v:',
        'num' => 'Поле :field: должно быть числом'
    ];


    public function __construct($data = [], $rules = [])
    {
        foreach ($data as $fillable => $fillable_value) {
            if (isset($rules[$fillable])) {
                $this->check([
                    'name' => $fillable,
                    'value' => $fillable_value,
                    'rules' => $rules[$fillable]
                ]);
            }
        }
        return $this;
    }

    public function check($field = [])
    {
        foreach ($field['rules'] as $rule => $rule_value) {
            if (in_array($rule, $this->rule_list)) {
                if (!call_user_func_array([$this, $rule], [$field['value'], $rule_value])) {
                    $this->addError($field['name'], str_replace(
                        [':field:', ':v:'],
                        [$field['name'], $rule_value],
                        $this->message[$rule]
                    ));
                }
            }
        }
    }

    protected function required($value, $rule_value): bool
    {
        return !empty(h($value));
    }
    protected function min($value, $rule_value)
    {
        return mb_strlen($value) >= $rule_value;
    }
    protected function max($value, $rule_value)
    {
        return mb_strlen($value) <= $rule_value;
    }
    protected function num($value, $rule_value)
    {
        return is_numeric($value);
    }

    private function addError($field, $error)
    {
        $this->errors[$field][] = $error;
    }

    public function hasError(): bool
    {
        return !empty($this->errors);
    }
    public function getError()
    {
        return $this->errors;
    }
    public function output($field): string
    {
        $out = '';
        if (!empty($this->errors[$field])) {
            $out .= "<ul class='error__list'>";
            foreach ($this->errors[$field] as $error) {
                $out .= "<li class='error__item'>{$error}</li>";
            }
            $out .= "</ul>";
        }
        return $out;
    }
}
