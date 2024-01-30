<?php

namespace Modules\Produto\Request;

use Modules\Produto\Rule\ExcludeProdutoRule;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Produto\Services\Interfaces\ProdutoServiceInterface;

class ProdutoRequest extends FormRequest
{
    protected $service;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(ProdutoServiceInterface $service)
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
        $value = str_replace('.','',$this['price']);
        $value = str_replace(',','.',$value);
        $this['price'] = $value;
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
            'name' => [
                'required',
                'max:40',
            ],
            'price' => [
                'required',
                'min:0',
            ],
            'description' => [
                'max:400',
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
                    'unique:Produtos,id,' . $this->id . ',id',
                    'exists:Produtos,id',
                    'max:11'
                ],
            ];

            return array_merge($rules_default, $rules_update);
        }
        // delete
        elseif ($this->route()->getActionMethod() == 'delete') {
            // Regras de exclusão
            $rules_destroy = [
                'id' => new ExcludeProdutoRule(),
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
            'id'             => 'Identificador',
            'name'           => 'name',
            'price'          => 'price',
            'description'    => 'description',
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
            'id.required'            => 'O campo Identificador é obrigatório',
            'id.exists'              => 'O Identificador não foi encontrado',
            'name.required'          => 'O campo Name é obrigatório',
            'price.required'         => 'O campo Price é obrigatório',
        ];
    }
}
