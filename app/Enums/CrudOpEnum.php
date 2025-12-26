<?php

namespace App\Enums;

enum CrudOpEnum: string
{
    case Created = 'created';
    case Updated = 'updated';
    case Deleted = 'deleted';
    case FileUploaded = 'file_uploaded';
    case FileDeleted = 'file_deleted';

    public function toStr(): string
    {
        return match ($this) {
            CrudOpEnum::Created => trans('settings.crud.op_types.'.CrudOpEnum::Created->value),
            CrudOpEnum::Updated => trans('settings.crud.op_types.'.CrudOpEnum::Updated->value),
            CrudOpEnum::Deleted => trans('settings.crud.op_types.'.CrudOpEnum::Deleted->value),
            CrudOpEnum::FileUploaded => trans('settings.crud.op_types.'.CrudOpEnum::FileUploaded->value),
            CrudOpEnum::FileDeleted => trans('settings.crud.op_types.'.CrudOpEnum::FileDeleted->value),
        };
    }
}
