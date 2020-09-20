<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class ProcessRequest
{
    /**
     * @param Request $request
     *
     * @return array
     */
    private function processRequest(Request $request)
    {
        $filter = $request->query->all();
        $order = array_key_exists('sort', $filter) ? $filter['sort'] : null;
        unset($filter['sort']);

        $page = array_key_exists('page', $filter) ? $filter['page'] : 1;
        unset($filter['page']);

        $itemPage = array_key_exists('item-page', $filter) ? $filter['item-page'] : 3;
        unset($filter['item-page']);

        return [$order,$filter,$page,$itemPage];
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getOrder(Request $request)
    {
        [$order,,,] = $this->processRequest($request);
        return $order;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getFilter(Request $request)
    {
        [,$filter,,] = $this->processRequest($request);
        return $filter;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getPage(Request $request)
    {
        [,,$page,] = $this->processRequest($request);
        return $page;
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getItemPage(Request $request)
    {
        [,,,$itemPage] = $this->processRequest($request);
        return $itemPage;
    }
}
