<?php

    class pokeAPI
    {

        public function getDataAlphabeticIndex($limit, $letterActive)
        {
            $sortAlphabeticName =[];
            $data = $this->useCache("pokemon?limit=$limit/");
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
            $data = $this->useCache("$type/$object/");
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
            curl_close($curl);
            // return json_decode($data);
            return $data;
        }

        private function useCache($type)
        {
            $cacheKey = md5("https://pokeapi.co/api/v2/$type");
            $path = './cache/'.$cacheKey;
            $fromCache = false;
            $data;
            if(file_exists($path))
            {
                $data = file_get_contents($path);
                $fromCache = true;
            }
            else
            {
                $data = $this->callAPI($type);
                file_put_contents($path, $data);
            }
            return json_decode($data);
        }
    }