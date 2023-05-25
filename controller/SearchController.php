<?php

class SearchController extends Controller
{

    public function searchResult()
    {

        if (!$_GET) {
            echo self::getRender('homepage.html.twig', []);
        } else {
            $searchRaw = $_GET['search'];
            $searchTrimed = trim($searchRaw);
            $searchTerm = strip_tags($searchTrimed);

            $model = new SearchModel();
            $recipes = $model->getSearchResult($searchTerm);

            if ($recipes) {

                echo self::getRender('searchresult.html.twig', ['recipes' => $recipes]);
            } else {
                $message = 'Oops, nothing to see here.';
                echo self::getRender('searchresult.html.twig', ['message' => $message]);
            }
        }
    }
}
