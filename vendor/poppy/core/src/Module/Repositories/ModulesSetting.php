<?php namespace Poppy\Core\Module\Repositories;

use Illuminate\Support\Collection;
use Poppy\Framework\Support\Abstracts\Repository;

/**
 * Setting Modules
 */
class ModulesSetting extends Repository
{

    const CACHE_NAME = 'module.repo.setting';

    /**
     * Initialize.
     * @param Collection $data 集合
     */
    public function initialize(Collection $data)
    {
        $this->items = sys_cache('py-core')->rememberForever(
            self::CACHE_NAME,
            function () use ($data) {
                $collection = collect();
                $data->each(function ($items, $slug) use ($collection) {
                    $items = collect($items);
                    $items->count() && $items->each(function ($items, $entry) use ($collection, $slug) {
                        $collection->put($entry, $items);
                    });
                });

                return $collection->all();
            }
        );
    }
}
