<?php

namespace YorCreative\UrlShortener\Strategies\FilterClicks\Filters;

use Illuminate\Database\Eloquent\Model;
use YorCreative\UrlShortener\Builders\ClickQueryBuilder\ClickQueryBuilder;
use YorCreative\UrlShortener\Exceptions\FilterClicksStrategyException;

class OwnershipFilter extends AbstractFilter
{
    /**
     * @param  array  $filter
     * @return bool
     */
    public function canProcess(array $filter): bool
    {
        $this->filter = $filter;

        return isset($filter['ownership']) && is_array($filter['ownership']);
    }

    /**
     * @return array
     */
    public function getAvailableFilterOptions(): array
    {
        return [];
    }

    /**
     * @param  ClickQueryBuilder  $clickQueryBuilder
     *
     * @throws FilterClicksStrategyException
     */
    public function handle(ClickQueryBuilder &$clickQueryBuilder): void
    {
        foreach ($this->filter['ownership'] as $ownership) {
            if ($ownership instanceof Model) {
                $clickQueryBuilder->whereOwnership($ownership);
            } else {
                throw new FilterClicksStrategyException('Ownership must be an instance of a model.');
            }
        }
    }
}
