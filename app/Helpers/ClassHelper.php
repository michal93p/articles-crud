<?php
declare(strict_types=1);

namespace App\Helpers;

use Illuminate\Support\Str;

final class ClassHelper
{
    public static function getClassNameWithoutNamespace(string $classNameWithNamespace): string
    {
        $classNameWithNamespaceParts = explode('\\', $classNameWithNamespace);

        return Str::snake(last($classNameWithNamespaceParts));
    }

}
