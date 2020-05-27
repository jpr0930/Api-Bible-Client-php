<?php

namespace ApiBibleClient\Api\Resource;

use ApiBibleClient\Api\Collection\BibleCollection;

class BiblesResource extends ResourceBase {
    public const URI = '/bibles';

    public function get() {
        $content = $this->client->request(self::BASE_URI . self::URI)->getContent();

        return BibleCollection::createFromArray($content['data']);
    }
}