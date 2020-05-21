<?php
    class pokeAPI
    {

        // Obtenir la decription des attack
        public function getAttackDescription($attack)
        {
            $data = $this->useCache("move/$attack/", true);
            $data = $data->flavor_text_entries[2]->flavor_text;

            return $data;
        }

        // Crée un tableau avec tout les noms des pokémons classés alphabétiquemnt
        public function getDataAlphabeticIndex($limit, $letterActive)
        {
            $sortAlphabeticName =[];
            $data = $this->useCache("pokemon?limit=$limit/", true);
            $dataArray = [];

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

        // Obtiens toute la data d'un objet, que ça soit un pokemon, un item ou autre selon les paramètres
        public function getDataObject($type, $object)
        {
            $data = $this->useCache("$type/$object/", true);
            return $data;
        }

        // Appel l'API avec en paramettre ce que l'on veut recuperer
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

        // Crée un systeme de cache en envoyant les fichier dans un dossier nommé "cache" et retourne la data déjà passé par json_decode, utlise aussi la function callAPI pour ne pas avoir à appeler les deux fonctions à chaque fois
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