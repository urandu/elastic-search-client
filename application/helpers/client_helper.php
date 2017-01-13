<?php
/**
 * Created by IntelliJ IDEA.
 * User: urandu
 * Date: 1/12/17
 * Time: 4:59 PM
 */
if(!defined('JSON_PRESERVE_ZERO_FRACTION'))
{
    define('JSON_PRESERVE_ZERO_FRACTION', 1024);
}
require 'vendor/autoload.php';

use Elasticsearch\ClientBuilder;

function test()
{


}

function index_publication($params)
{
    $client = ClientBuilder::create()->build();


    $response = $client->index($params);
    print_r($response);


}

function delete_publication_index($index)
{
    $client = ClientBuilder::create()->build();
    $params = ['index' => $index];
    $response = $client->indices()->delete($params);
    echo("<pre>");
    print_r($response);
    echo("</pre>");
}


function search_publications()
{
    $client = ClientBuilder::create()->build();

    $params = [
        'index' => 'publications',
        'type' => 'publications',
        'body' => [
            'query' => [
                'match' => [
                    'title' => 'marine status'
                ]
            ]
        ]
    ];

    $results = $client->search($params);
    echo("<pre>");
    print_r($results);
    echo("</pre>");

}

function create_publication_index()
{

    $client = ClientBuilder::create()->build();
    $params = [
        'index' => 'publications',
        'body' => [
            'settings' => [
                'number_of_shards' => 2,
                'number_of_replicas' => 0
            ],
            'mappings' => [
                'publications' => [
                    '_source' => [
                        'enabled' => true
                    ],
                    'properties' => [
                        'title' => [
                            'type' => 'string',
                           
                        ],'description' => [
                            'type' => 'string',
                            
                        ],'author' => [
                            'type' => 'string',
                            
                        ],'division_office' => [
                            'type' => 'string',
                            
                        ],'type' => [
                            'type' => 'string',
                           
                        ],'date' => [
                            'type' => 'string',
                           
                        ],'uneplive_publication' => [
                            'type' => 'string',
                           
                        ],'free_keywords' => [
                            'type' => 'string',
                           
                        ],'coverage' => [
                            'type' => 'string',
                           
                        ],'subject' => [
                            'type' => 'string',
                           
                        ],'language' => [
                            'type' => 'string',
                           
                        ],'downloads' => [
                            'type' => 'string',
                           
                        ],'thumbnail' => [
                            'type' => 'string',
                           
                        ]
                    ]
                ]
            ]
        ]
    ];

// Create the index with mappings and settings now
    $response = $client->indices()->create($params);

    echo("<pre>");
    print_r($response);
    echo("</pre>");




}