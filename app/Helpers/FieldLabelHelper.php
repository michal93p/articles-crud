<?php
declare(strict_types=1);

namespace App\Helpers;

final class FieldLabelHelper
{
    public static function getTransLabelName(string $modelNamespace, string $columnName): string
    {
        $modelName = ClassHelper::getClassNameWithoutNamespace($modelNamespace);

        return trans('labels/'.$modelName.'.'.$columnName);
    }

    public static function getTransLabelsName(string $modelNamespace): array
    {
        $modelName = ClassHelper::getClassNameWithoutNamespace($modelNamespace);

        return trans('labels/'.$modelName);
    }


}
