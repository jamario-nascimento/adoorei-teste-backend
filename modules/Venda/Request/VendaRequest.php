<?php

namespace Modules\Venda\Request;

use Modules\Venda\Rule\ExcludeVendaRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Venda\Services\Interfaces\VendaServiceInterface;

class VendaRequest extends FormRequest
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(VendaServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function prepareForValidation(): void
    {
        // Remove caracteres especiais dos campos, deixando somente números.
        $value = str_replace('.','',$this['amount']);
        $value = str_replace(',','.',$value);
        $this['amount'] = $value;
    }

    /**
     * Rules
     */
    public function rules()
    {
        // Inicializa variável.
        $rules_default = array();
        $rules_update = array();
        $rules_destroy = array();

        // Regras de criação e edição
        $rules_default = [
            'amount' => [
                'required',
                'min:1',
            ],
            'sales_id' => [
                'required',
                'min:0',
            ],
        ];

        // create
        if ($this->route()->getActionMethod() == 'create') {
            return $rules_default;
        }
        // update
        elseif ($this->route()->getActionMethod() == 'update') {
            $rules_update = [
                'id' => [
                    'required',
                    'unique:venda,id,' . $this->id . ',id',
                    'exists:venda,id',
                    'max:11'
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeVendaRule(),
            ];

            return $rules_destroy;
        }

        // merg.
        return array_merge($rules_default, $rules_update, $rules_destroy);
    }
    // Fim do método rules.

    /**
     * Validate
     */
    public function validated(): array
    {
        $attributes = parent::validated();
        return $attributes;
    }

    /**
     * Return the friendly field name.
     *
     * @return array
     */
    public function attributes()
    {
        $result = [
            'sales_id'  => 'Identificador',
            'amount'    => 'Quantidade'
        ];

        return $result;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'sales_id.required'            => 'O campo Identificador é obrigatório',
            'sales_id.exists'              => 'O Identificador não foi encontrado',
            'amount.required'          => 'O campo amount é obrigatório',
        ];
    }
}
