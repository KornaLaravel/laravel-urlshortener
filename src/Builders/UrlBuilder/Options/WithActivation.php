<?php

namespace YorCreative\UrlShortener\Builders\UrlBuilder\Options;

use Illuminate\Support\Collection;
use YorCreative\UrlShortener\Builders\UrlBuilder\UrlBuilderOptionInterface;
use YorCreative\UrlShortener\Exceptions\UrlRepositoryException;
use YorCreative\UrlShortener\Repositories\UrlRepository;

class WithActivation implements UrlBuilderOptionInterface
{
    /**
     * @param  Collection  $shortUrlCollection
     *
     * @throws UrlRepositoryException
     */
    public function resolve(Collection &$shortUrlCollection): void
    {
        UrlRepository::updateShortUrl(
            $shortUrlCollection->get('identifier'),
            ['activation' => $shortUrlCollection->get('activation')]
        );
    }
}
