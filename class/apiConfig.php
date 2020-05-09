<?php

    class pokeAPI
    {

        public function getDataAlphabeticIndex($limit, $letterActive)
        {
            $sortAlphabeticName =[];
            $data = $this->callAPI("pokemon?limit=$limit/");
            foreach($data->results as $key => $result)
            {
                if(substr($result->name, 0, 1) == $letterActive)
                {
                    array_push($sortAlphabeticName, $result->name);
                }
                asort($sortAlphabeticName);
            }
            return $sortAlphabeticName;
        }

        public function getDataObject($type, $object)
        {
            $data = $this->callAPI("$type/$object/");
            return $data;
        }

        private function callAPI($type)
        {
            $curl = curl_init();
            curl_setopt_array($curl, 
            [
                CURLOPT_URL => "https://pokeapi.co/api/v2/$type",
                CURLOPT_RETURNTRANSFER => true,
            ]);

            $data = curl_exec($curl);
            if($data === null || curl_getinfo($curl, CURLINFO_HTTP_CODE !== 200))
            {
                return 'Aucun résultat';
            }
            return json_decode($data);
        }
    }