<?php
namespace App\Filament\Resources;

use Filament\Resources\Resource as ResourceBase;

abstract class Resource extends ResourceBase
{
    protected const PAGE_LIST_NAME = 'index';
    protected const PAGE_LIST_ROUTE = '/';
    protected const PAGE_CREATE_NAME = 'create';
    protected const PAGE_CREATE_ROUTE = '/create';
    protected const PAGE_EDIT_NAME = 'edit';
    protected const PAGE_EDIT_ROUTE = '/{record}/edit';

    public static function getModelLabel(): string
    {
        return trans('filament/resources.'.get_called_class().'.singular');
    }

    public static function getPluralModelLabel(): string
    {
        return trans('filament/resources.'.get_called_class().'.plural');
    }
}
