<?php

/**
 * @file
 * Contains \Drupal\knowledge\Controller\TermAutocomplete.
 */

namespace Drupal\knowledge\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class DataHanlder.
 *
 * @package Drupal\knowledge\Controller
 */
class DataHanlder extends ControllerBase {
    /**
     * DataHanlder.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     *   The current request object containing the search string.
     * @return string
     *
     */
    public function getByTitle(Request $request) {
        $keyword = $request->query->get('q');
        $endpoint = \Drupal::config('knowledge.settings')->get('autocomplete_endpoint');
        $client = \Drupal::httpClient();
        $req = $client->request('get',$endpoint,['query' => ['q' => $keyword]]);
        $items =  json_decode($req->getBody()->getContents());
        $matches = array();
        foreach($items as $item){
            $matches[] = ['value' => "$item->title ($item->tid)" , 'label' => "$item->title ($item->tid)" ];
        }
        return JsonResponse::create($matches);

    }

}
