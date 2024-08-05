<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest as FormRequestBase;
abstract class FormRequest extends FormRequestBase
{
    public final const MAXIMUM_LENGTH_OF_TEXT_COLUMN = 65_535;

    public final const MIN_LENGTH_RULE = 'min_length';
    public final const MAX_LENGTH_RULE = 'max_length';
    public final const ALLOWED_TAGS_RULE = 'allowed_tags_rule';

}
