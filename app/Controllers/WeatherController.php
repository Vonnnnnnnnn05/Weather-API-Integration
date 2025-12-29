<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CityModel;
use App\Libraries\WttrWeather;

class WeatherController extends BaseController
{
    // List all cities with live weather
    public function index()
    {
        $cityModel    = new CityModel();
        $weatherLib   = new WttrWeather();

        // Get all cities from DB
        $cities = $cityModel->orderBy('id', 'DESC')->findAll();

        // Attach weather info to each city
        foreach ($cities as &$city) {
            $w = $weatherLib->currentByCity($city['city_name'], $city['country'] ?? null);

            $city['weather_ok']  = $w['ok'];
            $city['weather']     = $w['ok'] ? $w['data'] : null;
            $city['weather_err'] = $w['ok'] ? null : $w['error'];
        }

        return view('dashboard', [
            'cities' => $cities,
        ]);
    }

    // Show create form
    public function create()
    {
        return view('create');
    }
    // Show analytics page
    public function analytics()
    {
        $cityModel    = new CityModel();
        $weatherLib   = new WttrWeather();

        // Get all cities from DB
        $cities = $cityModel->findAll();

        // Count stats
        $totalCities = count($cities);
        $withWeather = 0;
        $failedWeather = 0;
        $countries = [];

        foreach ($cities as $city) {
            $w = $weatherLib->currentByCity($city['city_name'], $city['country'] ?? null);
            
            if ($w['ok']) {
                $withWeather++;
            } else {
                $failedWeather++;
            }

            if (!empty($city['country'])) {
                $countries[$city['country']] = true;
            }
        }

        return view('analytics', [
            'totalCities'      => $totalCities,
            'withWeather'      => $withWeather,
            'failedWeather'    => $failedWeather,
            'uniqueCountries'  => count($countries),
        ]);
    }

    // Handle create (store new city)
    public function store()
    {
        $cityModel = new CityModel();

        $data = [
            'city_name' => $this->request->getPost('city_name'),
            'country'   => $this->request->getPost('country'), // optional
        ];

        if (!$cityModel->save($data)) {
            return redirect()->back()
                ->withInput()
                ->with('errors', $cityModel->errors());
        }

        return redirect()->to('/weather')->with('message', 'City added!');
    }

    // Show edit form
    public function edit($id)
    {
        $cityModel = new CityModel();
        $city      = $cityModel->find($id);

        if (!$city) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound('City not found');
        }

        return view('edit', [
            'city' => $city,
        ]);
    }

    // Handle update
    public function update($id)
    {
        $cityModel = new CityModel();

        $data = [
            'id'        => $id,
            'city_name' => $this->request->getPost('city_name'),
            'country'   => $this->request->getPost('country'),
        ];

        if (!$cityModel->save($data)) { // save with id = update
            return redirect()->back()
                ->withInput()
                ->with('errors', $cityModel->errors());
        }

        return redirect()->to('/weather')->with('message', 'City updated!');
    }

    // Delete city
    public function delete($id)
    {
        $cityModel = new CityModel();
        $cityModel->delete($id);

        return redirect()->to('/weather')->with('message', 'City deleted!');
    }
}
