<?php
    class pokeAPI
    {
        public function getDataAlphabeticIndex($limit, $letterActive)
        {
            $sortAlphabeticName =[];
            $data = $this->callAPI("pokemon?limit=$limit/");
            $data = json_decode($data);
            foreach($data->results as $key => $result)
            {
                if(substr($result->name, 0, 1) == $letterActive)
                {
                    array_push($sortAlphabeticName, $result->name);
                }
                asort($sortAlphabeticName);
            }
            $this->useCache(/* string($sortAlphabeticName) */'test', false);
            return $sortAlphabeticName;
        }

        public function getDataObject($type, $object)
        {
            $data = $this->useCache("$type/$object/", true);
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
            return $data;
        }

        private function useCache($type, $addAllObject)
        {
            $cacheKey = md5("https://pokeapi.co/api/v2/$type");
            $pathOrigin = './cache';
            $path = $pathOrigin.'/'.$cacheKey;
            $data;
            $addAllObject = true;

            if(!is_dir($pathOrigin))
            {
                mkdir($pathOrigin);
            }

            if(file_exists($path))
            {
                $data = file_get_contents($path);
            }
            else
            {
                if($addAllObject === true)
                {
                    $data = $this->callAPI($type);
                }

                if($data !== 'Not Found')
                {
                    file_put_contents($path, $data);
                }
            }

            return json_decode($data);
        }
    }