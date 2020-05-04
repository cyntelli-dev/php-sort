<?php

namespace Cyntelli\Sort;

use Exception;

/**
 * Merge sort.
 * 
 * @author Leo Wang <leo.wang@adgeek.com.tw>
 * @since 1.0.0
 * @version 1.0.0
 */
class MergeSort
{
    /**
     * Execute list sort.
     * 
     * @param array $data
     * @param string $sort
     * 
     * @return array
     */
    public function executeList(array $list, string $sort='ASC'): array
    {
        $result = [];

        $sortList = $this->mergeRec($list);

        /** sort */
        if ($sort == 'DESC') {
            while ($rowData = array_pop($sortList)) {
                $result[] = $rowData;
            }
        } else {
            $result = $sortList;
        }

        return $result;
    }

    /**
     * Execute dataset sort.
     * 
     * @param array $dataset
     * @param string $sortField
     * @param string $sort
     * 
     * @return array
     */
    public function executeDataset(array $dataset, string $sortField, string $sort='ASC'): array
    {
        $result = [];

        /** build */
        $fieldList = [];
        $origDatasetMaps = [];

        foreach ($dataset as $rowData) {
            if (!isset($rowData[$sortField])) {
                throw new Exception("Not found $sortField field, please check dataset content.", 400);
            }

            $fieldValue = $rowData[$sortField];

            // process list
            $fieldList[] = $fieldValue;

            // original map
            $hash = base64_encode(serialize($rowData));

            if (empty($origDatasetMaps[$fieldValue])) {
                $origDatasetMaps[$fieldValue] = [];
            }

            $origDatasetMaps[$fieldValue][] = $hash;
        }

        /** sort list */
        $sortList = $this->mergeRec($fieldList);

        /** regroup */
        $sortDataset = [];
        foreach ($sortList as $value) {
            $origins = $origDatasetMaps[$value];

            foreach ($origins as $origin) {
                $sortDataset[] = unserialize(base64_decode($origin));
            }
        }

        /** sort */
        if ($sort == 'DESC') {
            while ($rowData = array_pop($sortDataset)) {
                $result[] = $rowData;
            }
        } else {
            $result = $sortDataset;
        }

        return $result;
    }

    /**
     * Merge recursive. (Divide)
     * 
     * @param array $list
     * 
     * @return array
     */
    public function mergeRec(array $list): array
    {
        if(sizeof($list) == 1) {
            return $list; 
        }

        $middle = sizeof($list) / 2;

        $leftList = $this->mergeRec(array_slice($list, 0, $middle));
	    $rightList = $this->mergeRec(array_slice($list, $middle));

        return $this->merge($leftList, $rightList);
    }

    /**
     *  Merge. (Conquer)
     * 
     * @param array $leftList
     * @param array $rightList
     * 
     * @return array
     */
    public function merge(array $leftList, array $rightList): array
    {
        $result = [];

        while (sizeof($rightList) > 0 && sizeof($leftList) > 0) {
            if($leftList[0] > $rightList[0]) {
                array_push($result, array_shift($rightList));
            }
            else {
                array_push($result, array_shift($leftList));
            }
        }

        while(sizeof($rightList) > 0) {
            array_push($result, array_shift($rightList));
        }

        while(sizeof($leftList) > 0) {
            array_push($result, array_shift($leftList));
        }

        return $result;
    }
}